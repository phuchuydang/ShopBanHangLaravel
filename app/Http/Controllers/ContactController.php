<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Social;
use App\Models\Customer;
use App\Models\Roles;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();


class ContactController extends Controller
{
    public function contact()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->get();
        return view('pages.contact.contact', compact('cate_product', 'brand_product'));
    }

    public function addContact(){
        return view('admin.contact.add_contact');
    }

    public function saveContact(Request $request){
        $data = $request->all();
        $contact_image = $request->file('contact_image');
        if($contact_image) {
            $new_name = rand(123456789, 923456789) . rand( 0, time() ) . '.' . $contact_image->getClientOriginalExtension(); 
            $contact_image->move(public_path('/uploads/contact'), $new_name);
            $contact = new Contact();
            $contact->contact_info = $data['contact_info'];
            $contact->contact_info_map = $data['contact_map'];
            $contact->contact_fanpage = $data['contact_fanpage'];
            $contact->contact_image = $new_name;
            $contact->save();
            
        } else {
            $contact = new Contact();
            $contact->contact_info = $data['contact_info'];
            $contact->contact_info_map = $data['contact_map'];
            $contact->contact_fanpage = $data['contact_fanpage'];
            $contact->contact_image = '';
            $contact->save();
        }
    }
}
