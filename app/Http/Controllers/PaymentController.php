<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ColorModel;
use App\Models\NotificationModel;
use App\Models\PaymentSettingModel;
use App\Models\User;
use Stripe\Stripe;
use App\Mail\OrderInvoiceMail;
use Auth;
use Cart;
use Hash;
use Session;
use Mail;

class PaymentController extends Controller
{

    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
        if(!empty($getDiscount))
        {
            $total = Cart::getSubTotal();
            if($getDiscount->type == 'Amount')
            {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total =  $total - $getDiscount->percent_amount;
            }
            else
            {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total =  $total - $discount_amount;
            }
            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";
        }
        else
        {
            $json['status'] = false;
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid";
        }
        echo json_encode($json);
    }

    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();
        $data['getPaymentSetting'] = PaymentSettingModel::getSingle();
        return view('payment.checkout', $data);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart', $data);
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);
        $total = $getProduct->price;
        if(!empty($request->size_id))
        {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle( $size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        }
        else
        {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id,
            )
        ]);

        return redirect()->back()->with('success', "Iteam successfully added to your cart!");
    }

    public function update_cart(Request $request)
    {
        foreach($request->cart as $cart)
        {
            Cart::update($cart['id'], array(
                'quantity' => array(
                'relative' => false,
                'value' => $cart['qty']
                ),
            ));
        }
        return redirect()->back();
    }

    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';
        if(!empty(Auth::check()))
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            if(!empty($request->is_create))
            {
                $checkEmail = User::checkEmail($request->email);
                if(!empty($checkEmail))
                {
                    $message = 'This Email Already Register! Please Choose Another!';
                    $validate = 1;
                }
                else
                {
                    $save = new User;
                    $save->name = trim($request->first_name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();
                    $user_id = $save->id;
                }
            }
            else
            {
                $user_id = '';
            }
        }

        if(empty($validate))
        {
            $getShipping = ShippingChargeModel::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';

            if(!empty($request->discount_code))
            {
                $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
                if(!empty($getDiscount))
                {
                    $discount_code = $request->discount_code;
                    if($getDiscount->type == 'Amount')
                    {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total =  $payable_total - $getDiscount->percent_amount;
                    }
                    else
                    {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total =  $payable_total - $discount_amount;
                    }
                }

            }

            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount =  $payable_total + $shipping_amount;

            $order = new OrderModel;
            if(!empty($user_id))
            {
                $order->user_id = trim($user_id);
            }
            $order->order_number = mt_rand(100000000,999999999);
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);
            $order->discount_amount = trim($discount_amount);
            $order->discount_code = trim($discount_code);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->total_amount = trim($total_amount);
            $order->payment_method = trim($request->payment_method);
            $order->save();

            foreach (Cart::getContent() as $key => $cart)
            {
                $order_item = new OrderItemModel;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                $color_id = $cart->attributes->color_id;
                if(!empty($color_id))
                {
                    $getColor = ColorModel::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;
                if(!empty( $size_id))
                {
                    $getSize = ProductSizeModel::getSingle( $size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }

                $order_item->total_price = $cart->price * $cart->quantity;
                $order_item->save();

            }
            $json['status'] = true;
            $json['message'] = "Success";
            $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));
        }
        else
        {
            $json['status'] = false;
            $json['message'] = $message;
        }

        echo json_encode($json);

    }

    public function checkout_payment(Request $request)
    {
        if(!empty(Cart::getSubTotal()) && !empty($request->order_id))
        {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if(!empty($getOrder))
            {
                $getPaymentSetting = PaymentSettingModel::getSingle();

                if($getOrder->payment_method == 'cash')
                {
                    $getOrder->is_payment = 1;
                    $getOrder->save();

                    try{
                        Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    } catch(\Exception $e) {

                    }
                    //Notification
                    $user_id = 1;
                    $url = url('admin/orders/detail/'.$getOrder->id);
                    $message = "New Order Placed #".$getOrder->order_number;
                    NotificationModel::insertRecord($user_id, $url, $message);

                    Cart::clear();
                    return redirect('cart')->with('success', "Order successfully placed");
                }
                else if($getOrder->payment_method == 'paypal')
                {
                    $query = array();
                    $query['business'] = $getPaymentSetting->paypal_id;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "E-commerce";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $getOrder->id;
                    $query['amount'] = $getOrder->total_amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('checkout');
                    $query['return'] = url('paypal/success-payment');

                    $query_string = http_build_query($query);

                    if($getPaymentSetting->paypal_id == 'live')
                    {
                        header('Location: http://www.paypal.com/cgi-bin/webscr?'. $query_string);

                    }
                    else
                    {
                        header('Location: http://www.sandbox.paypal.com/cgi-bin/webscr?'. $query_string);
                    }

                    exit();
                }
                else if($getOrder->payment_method == 'stripe')
                {
                    Stripe::setApiKey($getPaymentSetting->stripe_secret_key);
                    $finalprice = $getOrder->total_amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'E-commerce',
                                ],
                                'unit_amount' => intval($finalprice),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('stripe/payment-success'),
                        'cancel_url' => url('checkout'),
                    ]);

                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublickey'] = $getPaymentSetting->stripe_public_key;

                    return view('payment.stripe_charge', $data);
                }
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            abort(404);
        }
    }

    public function paypal_success_payment(Request $request)
    {
        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $getOrder = OrderModel::getSingle($request->item_number);
            if(!empty($getOrder))
            {
                $getOrder->is_payment = 1;
                $getOrder->transaction_id = $request->tx;
                $getOrder->payment_data = json_encode($request->all());
                $getOrder->save();

                try{
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                } catch(\Exception $e) {

                }

                //Notification
                $user_id = 1;
                $url = url('admin/orders/detail/'.$getOrder->id);
                $message = "New Order Placed #".$getOrder->order_number;
                NotificationModel::insertRecord($user_id, $url, $message);

                Cart::clear();
                return redirect('cart')->with('success', "Order successfully placed");
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            abort(404);
        }
    }

    public function stripe_success_payment(Request $request)
    {
        $getPaymentSetting = PaymentSettingModel::getSingle();

        $trans_id = Session::get('stripe_session_id');
        \Stripe\Stripe::setApiKey($getPaymentSetting->stripe_secret_key);
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        $getOrder = OrderModel::where('stripe_session_id', '=', $getdata->id)->first();

        if(!empty($getOrder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id)
        {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();

            try{
                Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            } catch(\Exception $e) {

            }

            //Notification
            $user_id = 1;
            $url = url('admin/orders/detail/'.$getOrder->id);
            $message = "New Order Placed #".$getOrder->order_number;
            NotificationModel::insertRecord($user_id, $url, $message);

            Cart::clear();
            return redirect('cart')->with('success', "Order successfully placed");
        }
        else
        {
            return redirect('cart')->with('error', "Due to some error. Please try again!");
        }
    }

}
