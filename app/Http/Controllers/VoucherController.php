<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VoucherController extends Controller
{

    public function Authenticate()
    {
        $admin_id = Session::get('name');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function checkVoucher(Request $request)
    {
        $data = $request->all();
        $voucher = Voucher::where('voucher_code', $data['voucher_code'])->first();
        if($voucher){
            $count_voucher = $voucher->count();
            if($count_voucher > 0){
                $voucher_session = Session::get('voucher');
                if($voucher_session==true){
                   $is_available = 0;
                   if($is_available==0){
                        $voucher_arr[] = array(
                            'voucher_code' => $voucher->voucher_code,
                            'voucher_amount' => $voucher->voucher_amount,
                            'voucher_percent_discount' => $voucher->voucher_percent_discount,
                            'voucher_condition' => $voucher->voucher_condition,
                        );
                        Session::put('voucher', $voucher_arr);
                   }
                } else {
                    $voucher_arr[] = array(
                        'voucher_code' => $voucher->voucher_code,
                        'voucher_amount' => $voucher->voucher_amount,
                        'voucher_percent_discount' => $voucher->voucher_percent_discount,
                        'voucher_condition' => $voucher->voucher_condition,
                    );
                    Session::put('voucher', $voucher_arr);
                }
                Session::save();
                return redirect()->back()->with('message', 'Voucher code is available');
            }
            
        } else {
            return redirect()->back()->with('message', 'Voucher code is not available');
        }
    }

    public function addVoucher()
    {
        $this->Authenticate();
        return view('admin.voucher.add_voucher');
    }

    public function saveVoucher(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $voucher = new Voucher();
        $voucher->voucher_name = $data['voucher_name'];
        $voucher->voucher_code = $data['voucher_code'];
        $voucher->voucher_amount = $data['voucher_amount'];
        $voucher->voucher_condition = $data['voucher_condition'];
        $voucher->voucher_percent_discount = $data['voucher_percent_discount'];
        $voucher->created_at = date('Y-m-d H:i:s');
        //update data
        $voucher->updated_at = NULL;
        $voucher->save();
        if ($voucher) {
            $message = "Voucher Added Successfully";
            Session::put('message', $message);
            return Redirect::to('/add-voucher');
        } else {
            $message = "Voucher Not Added Fail";
            Session::put('message', $message);
            return Redirect::to('/add-voucher');
        }
    }
    public function allVoucher()
    {
        $this->Authenticate();
        $all_voucher = Voucher::orderBy('voucher_id', 'desc')->get();
        $manager_voucher = view('admin.voucher.all_voucher')->with('all_voucher', $all_voucher);
        return view('admin_layout')->with('admin.voucher.all_voucher', $manager_voucher);
    }

    public function deleteVoucher($voucher_id)
    {
        $this->Authenticate();
        $voucher_info = Voucher::find($voucher_id);
        $voucher_info->delete();
        return Redirect::to('/all-voucher');
    }
}
