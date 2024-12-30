<?php

namespace App\Http\Controllers;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $data['meta_title'] = 'Dashboard';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['TotalOrder'] = OrderModel::getTotalOrderUser(Auth::user()->id);
        $data['TotalTodayOrder'] = OrderModel::getTotalTodayOrderUser(Auth::user()->id);
        $data['TotalAmount'] = OrderModel::getTotalAmountUser(Auth::user()->id);
        $data['TotalTodayAmount'] = OrderModel::getTotalTodayAmountUser(Auth::user()->id);

        $data['TotalPending'] = OrderModel::getTotalStatusUser(Auth::user()->id, 0);
        $data['TotalInprogress'] = OrderModel::getTotalStatusUser(Auth::user()->id, 1);
        // $data['TotalDelivered'] = OrderModel::getTotalStatusUser(Auth::user()->id, 2); ->no need
        $data['TotalCompleted'] = OrderModel::getTotalStatusUser(Auth::user()->id, 3);
        $data['TotalCancelled'] = OrderModel::getTotalStatusUser(Auth::user()->id, 4);


        return view('user.dashboard', $data);
    }

    public function orders()
    {
        $data['getRecord'] = OrderModel::getRecordUser(Auth::user()->id);
        $data['meta_title'] = 'Orders';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.orders', $data);
    }

    public function orders_detail($id)
    {
        $data['getRecord'] = OrderModel::getSingleUser(Auth::user()->id, $id);
        if(!empty($data['getRecord']))
        {
            $data['meta_title'] = 'Order Detail';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';
            return view('user.orders_detail', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function edit_profile()
    {
        $data['meta_title'] = 'Edit Profile';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        return view('user.edit_profile', $data);
    }

    public function update_profile(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        $user->name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->company_name = trim($request->company_name);
        $user->country = trim($request->country);
        $user->address_one = trim($request->address_one);
        $user->address_two = trim($request->address_two);
        $user->city = trim($request->city);
        $user->state = trim($request->state);
        $user->postcode = trim($request->postcode);
        $user->phone = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success', "Profile successfully updated");
    }

    public function change_password()
    {
        $data['meta_title'] = 'Change Password';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.change_password', $data);
    }

}
