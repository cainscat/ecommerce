<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageModel;
use App\Models\ContactUsModel;
use App\Models\SystemSettingModel;
use App\Models\HomeSettingModel;
use App\Models\NotificationModel;
use App\Models\SMTPModel;
use Str;

class PageController extends Controller
{
    public function list()
    {
        $data['getRecord'] = PageModel::getRecord();
        $data['header_title'] = "Page";
        return view('admin.page.list', $data);
    }

    public function edit($id)
    {
        $data['getRecord'] = PageModel::getSingle($id);
        $data['header_title'] = "Edit Page";
        return view('admin.page.edit', $data);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
       $page = PageModel::getSingle($id);
       $page->name = trim($request->name);
       $page->title = trim($request->title);
       $page->description = trim($request->description);
       $page->meta_title = trim($request->meta_title);
       $page->meta_description = trim($request->meta_description);
       $page->meta_keywords = trim($request->meta_keywords);
       $page->save();

       if(!empty($request->file('image')))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id.Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/page/', $filename);
            $page->image_name = trim($filename);
            $page->save();
        }

       return redirect('admin/page/list')->with('success', "Page Successfully Updated");

    }

    public function system_setting()
    {
        $data['getRecord'] = SystemSettingModel::getSingle();
        $data['header_title'] = "System Setting";
        return view('admin.setting.system_setting', $data);
    }

    public function update_system_setting(Request $request)
    {
        $save = SystemSettingModel::getSingle();
        $save->website_name = trim($request->website_name);
        $save->footer_description = trim($request->footer_description);
        $save->address = trim($request->address);
        $save->phone = trim($request->phone);
        $save->phone_two = trim($request->phone_two);
        $save->submit_email = trim($request->submit_email);
        $save->email = trim($request->email);
        $save->email_two = trim($request->email_two);
        $save->working_day = trim($request->working_day);
        $save->working_hour = trim($request->working_hour);
        $save->facebook_link = trim($request->facebook_link);
        $save->twitter_link = trim($request->twitter_link);
        $save->instagram_link = trim($request->instagram_link);
        $save->youtube_link = trim($request->youtube_link);
        $save->pinterest_link = trim($request->pinterest_link);

        if(!empty($request->file('logo')))
        {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->logo = trim($filename);
        }

        if(!empty($request->file('footer_logo')))
        {
            $file = $request->file('footer_logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->footer_logo = trim($filename);
        }

        if(!empty($request->file('fevicon')))
        {
            $file = $request->file('fevicon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->fevicon = trim($filename);
        }

        if(!empty($request->file('footer_payment_icon')))
        {
            $file = $request->file('footer_payment_icon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->footer_payment_icon = trim($filename);
        }

        $save->save();

        return redirect()->back()->with('success', "Setting Successfully Updated");
    }

    public function home_setting()
    {
        $data['getRecord'] = HomeSettingModel::getSingle();
        $data['header_title'] = "Home Setting";
        return view('admin.setting.home_setting', $data);
    }

    public function update_home_setting(Request $request)
    {
        $save = HomeSettingModel::getSingle();
        $save->trendy_product_title = trim($request->trendy_product_title);
        $save->shop_category_title = trim($request->shop_category_title);
        $save->recent_arrival_title = trim($request->recent_arrival_title);
        $save->blog_title = trim($request->blog_title);
        $save->payment_delivery_title = trim($request->payment_delivery_title);
        $save->payment_delivery_description = trim($request->payment_delivery_description);
        $save->refund_title = trim($request->refund_title);
        $save->refund_description = trim($request->refund_description);
        $save->support_title = trim($request->support_title);
        $save->support_description = trim($request->support_description);
        $save->signup_title = trim($request->signup_title);
        $save->signup_description = trim($request->signup_description);

        if(!empty($request->file('payment_delivery_image')))
        {
            $file = $request->file('payment_delivery_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->payment_delivery_image = trim($filename);
        }

        if(!empty($request->file('refund_image')))
        {
            $file = $request->file('refund_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->refund_image = trim($filename);
        }

        if(!empty($request->file('support_image')))
        {
            $file = $request->file('support_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->support_image = trim($filename);
        }

        if(!empty($request->file('signup_image')))
        {
            $file = $request->file('signup_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename);
            $save->signup_image = trim($filename);
        }

        $save->save();

        return redirect()->back()->with('success', "Home Setting Successfully Updated");
    }

    public function smtp_setting()
    {
        $data['getRecord'] = SMTPModel::getSingle();
        $data['header_title'] = "SMTP Setting";
        return view('admin.setting.smtp_setting', $data);
    }

    public function update_smtp_setting(Request $request)
    {
        $save = SMTPModel::getSingle();
        $save->name = trim($request->name);
        $save->mail_mailer = trim($request->mail_mailer);
        $save->mail_host = trim($request->mail_host);
        $save->mail_port = trim($request->mail_port);
        $save->mail_username = trim($request->mail_username);
        $save->mail_password = trim($request->mail_password);
        $save->mail_encryption = trim($request->mail_encryption);
        $save->mail_from_address = trim($request->mail_from_address);
        $save->save();

        return redirect()->back()->with('success', "SMTP Setting Successfully Updated");
    }

    public function contact_us()
    {
        $data['getRecord'] = ContactUsModel::getRecord();
        $data['header_title'] = "Contact Us";
        return view('admin.contactus.list', $data);
    }

    public function contact_us_delete($id)
    {
        ContactUsModel::where('id', '=', $id)->delete();

        return redirect()->back()->with('success', "Contact Us successfully deleted");
    }

    public function notification()
    {
        $data['getRecord'] = NotificationModel::getRecord();
        $data['header_title'] = "Notifications";
        return view('admin.notification.list', $data);
    }

}
