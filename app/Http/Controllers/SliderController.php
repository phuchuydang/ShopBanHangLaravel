<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;

class SliderController extends Controller
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

    public function allSlider()
    {
        $this->Authenticate();
        $all_slider = Slider::orderBy('slider_id', 'desc')->get();
        return view('admin.slider.all_slider', compact('all_slider'));
    }

    public function addSlider()
    {
        $this->Authenticate();
        return view('admin.slider.add_slider');
    }

    public function saveSlider(Request $request)
    {
        $this->Authenticate();
        $this->validate($request, [
            'slider_name' => 'required',
            'slider_image' => 'required',
            'slider_status' => 'required',
            'slider_desc' => 'required',
        ]);
        $data = $request->all();
       
        $get_image = $request->file('slider_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $__image_name = current(explode('.', $get_image_name));
            $new_image = $__image_name.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
            $slider = new Slider;
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            $message = 'Slider Added Successfully';
            return Redirect::to('add-slider')->with('message', $message);
        }
        else{
            $slider = new Slider;
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = "";
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            DB::table('tbl_sliders')->insert($data);
            $message = 'Slider Added Successfully';
            return Redirect::to('add-slider')->with('message', $message);
        }
    }

    public function unactiveSlider($slider_id)
    {
        $this->Authenticate();
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->update(['slider_status' => 0]);
        $message = 'Slider Unactive Successfully';
        return Redirect::to('all-slider')->with('message', $message);
    }

    public function activeSlider($slider_id)
    {
        $this->Authenticate();
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->update(['slider_status' => 1]);
        $message = 'Slider Active Successfully';
        return Redirect::to('all-slider')->with('message', $message);
    }

    public function deleteSlider(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $slider_id = $data['slider_id'];
        DB::table('tbl_sliders')->where('slider_id', $slider_id)->delete();
    }

    public function editSlider($slider_id){
        $this->Authenticate();
        $slider_info = Slider::where('slider_id', $slider_id)->first();
        return view('admin.slider.edit_slider', compact('slider_info'));
    }

    public function updateSlider(Request $request, $slider_id){
        $this->Authenticate();
        $this->validate($request, [
            'slider_name' => 'required',
            'slider_image' => 'required',
            'slider_status' => 'required',
            'slider_desc' => 'required',
        ]);
        $data = $request->all();
        $get_image = $request->file('slider_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $__image_name = current(explode('.', $get_image_name));
            $new_image = $__image_name.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
            $slider = Slider::where('slider_id', $slider_id)->first();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            $message = 'Slider Updated Successfully';
            return Redirect::to('all-slider')->with('message', $message);
        }
        else{
            $slider = Slider::where('slider_id', $slider_id)->first();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = "";
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            $message = 'Slider Updated Successfully';
            return Redirect::to('all-slider')->with('message', $message);
        }
    }

}
