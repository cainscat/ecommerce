<?php

namespace App\Http\Controllers;
use App\Models\PageModel;
use App\Models\SystemSettingModel;
use App\Models\ContactUsModel;
use App\Models\SliderModel;
use App\Models\PartnerModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Session;
use Auth;
use Mail;

class HomeController extends Controller
{
    public function home()
    {
        $getPage = PageModel::getSlug('home');
        $data['getPage'] = $getPage;

        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getPartner'] = PartnerModel::getRecordActive();
        $data['getCategory'] = CategoryModel::getRecordActiveHome();
        $data['getProduct'] = ProductModel::getRecentArrival();
        $data['getProductTrendy'] = ProductModel::getProductTrendy();

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('home', $data);
    }

    public function recent_arrival_category_product(Request $request)
    {
        $getProduct = ProductModel::getRecentArrival();
        $getCategory = CategoryModel::getSingle($request->category_id);

        return response()->json([
            "status" => true,
            "success" => view("product._list_recent_arrival",[
                "getProduct" => $getProduct,
                "getCategory" => $getCategory,
            ])->render(),
        ], 200);
    }

    public function contact()
    {
        $first_number = mt_rand(0,9);
        $second_number = mt_rand(0,9);

        $data['first_number'] = $first_number;
        $data['second_number'] = $second_number;

        Session::put('total_sum', $first_number + $second_number);

        $getPage = PageModel::getSlug('contact');
        $data['getPage'] = $getPage;
        $data['getSystemSetting'] = SystemSettingModel::getSingle();

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.contact', $data);
    }

    public function submit_contact(Request $request)
    {
        if(!empty($request->verfication) && !empty(Session::get('total_sum')))
        {
            if(trim(Session::get('total_sum')) == trim($request->verfication))
            {
                $save = new ContactUsModel;
                if(!empty(Auth::check()))
                {
                    $save->user_id = Auth::user()->id;
                }
                $save->name = trim($request->name);
                $save->email = trim($request->email);
                $save->phone = trim($request->phone);
                $save->subject = trim($request->subject);
                $save->message = trim($request->message);
                $save->save();

                $getSystemSetting = SystemSettingModel::getSingle();
                Mail::to($getSystemSetting->submit_email)->send(new ContactUsMail($save));

                return redirect()->back()->with('success', "Your information successfully send!");
            }
            else
            {
                return redirect()->back()->with('error', "Your verfication sum is wrong! Try again!");
            }
        }
        else
        {
            return redirect()->back()->with('error', "Your verfication sum is wrong! Try again!");
        }
    }

    public function about()
    {
        $getPage = PageModel::getSlug('about');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.about', $data);
    }

    public function faq()
    {
        $getPage = PageModel::getSlug('faq');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.faq', $data);
    }

    public function payment_method()
    {
        $getPage = PageModel::getSlug('payment-method');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.payment_method', $data);
    }

    public function money_back_guarantee()
    {
        $getPage = PageModel::getSlug('money-back-guarantee');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.money_back_guarantee', $data);
    }

    public function return()
    {
        $getPage = PageModel::getSlug('returns');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.return', $data);
    }

    public function shipping()
    {
        $getPage = PageModel::getSlug('shipping');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.shipping', $data);
    }

    public function terms_condition()
    {
        $getPage = PageModel::getSlug('terms-condition');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.terms_condition', $data);
    }

    public function privacy_policy()
    {
        $getPage = PageModel::getSlug('privacy-policy');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        return view('page.privacy_policy', $data);
    }

    public function blog()
    {
        $getPage = PageModel::getSlug('blog');
        $data['getPage'] = $getPage;

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_description'] = $getPage->meta_description;
        $data['meta_keywords'] = $getPage->meta_keywords;

        $data['getBlog'] = BlogModel::getBlog();
        $data['getBlogCategory'] = BlogCategoryModel::getRecordActive();

        return view('blog.list', $data);
    }

}
