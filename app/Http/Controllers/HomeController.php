<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'E-Commerce';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('home', $data);
    }

    public function contact()
    {
        $data['meta_title'] = 'Contact Us';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.contact', $data);
    }

    public function about()
    {
        $data['meta_title'] = 'About Us';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.about', $data);
    }

    public function faq()
    {
        $data['meta_title'] = 'FAQ';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.faq', $data);
    }

    public function payment_method()
    {
        $data['meta_title'] = 'Payment Method';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.payment_method', $data);
    }

    public function money_back_guarantee()
    {
        $data['meta_title'] = 'Money Back Guarantee';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.money_back_guarantee', $data);
    }

    public function return()
    {
        $data['meta_title'] = 'Return';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.return', $data);
    }

    public function shipping()
    {
        $data['meta_title'] = 'Shipping';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.shipping', $data);
    }

    public function terms_condition()
    {
        $data['meta_title'] = 'Terms Conditions';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.terms_condition', $data);
    }

    public function privacy_policy()
    {
        $data['meta_title'] = 'Privacy Policy';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('page.privacy_policy', $data);
    }


}
