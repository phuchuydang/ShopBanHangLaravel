<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Model import
use App\Models\City;
use App\Models\Province;
use App\Models\Ward;
use App\Models\Feeship;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class DeliveryController extends Controller
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

    public function deliveryDetail()
    {
        $this->Authenticate();
        $cities = City::orderBy('matp', 'asc')->get();
        return view('admin.delivery.delivery_detail', compact('cities'));
       
    }

    
    public function addDelivery(Request $request)
    {
        //$this->Authenticate();
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->feeship_matp = $data['city'];
        $feeship->feeship_maqh = $data['province'];
        $feeship->feeship_xaid = $data['ward'];
        $feeship->feeship_price = $data['feeship'];
        $feeship->created_at = date('Y-m-d H:i:s');
        $feeship->updated_at = NULL;
        $feeship->save();
        // return  Redirect::to('/delivery-detail');
        // return view('admin.delivery.delivery_detail');
        
    }

    public function getDistricts(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        if($data['action']){
                $output = '';
                if($data['action'] == 'city'){
                    $output= '<option>Choose Province</option>';
                    $districts = Province::where('matp', $data['ma_id'])->orderby('maqh','ASC')->get();
                    foreach ($districts as $district) {
                        $output = '<option value="'.$district->maqh.'">'.$district->nameprovince.'</option>';
                        echo $output;
                    }
                    
                } else {
                    $output = '<option value="">Choose Ward</option>';
                    $wards = Ward::where('maqh', $data['ma_id'])->orderby('xaid','ASC')->get();;
                    foreach ($wards as $ward) {
                        $output = '<option value="'.$ward->xaid.'">'.$ward->nameward.'</option>';
                        echo $output;
                    }

                }
                
        }
    }

    //listDelivery
    public function listDelivery()
    {
        $this->Authenticate();
        $feeship = new Feeship();
        $feeship = $feeship->orderBy('feeship_id', 'desc')->get();
        return view('admin.delivery.all_delivery', compact('feeship'));
    }

    //deleteDelivery
    public function deleteDelivery(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $id = $data['id'];
        $feeship = Feeship::find($id);
        $feeship->delete();
        
    }

    public function editDelivery($id)
    {
        $this->Authenticate();
        
        $feeships = Feeship::findOrFail($id);
        return view('admin.delivery.edit_delivery', compact('feeships'));
        
    }

    public function saveDelivery(Request $request)
    {
        $this->Authenticate();
        $data = $request->all();
        $id = $data['fee_id'];
        $feeship = Feeship::find($id);  
        $feeship->feeship_price = $data['fee_price'];
        $feeship->updated_at = date('Y-m-d H:i:s');
        $feeship->save();
    }
}
