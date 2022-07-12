<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Socialite
//use Socialite
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Social;
use App\Models\Customer;
use App\Models\Roles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();
use App\Models\Gallery;
class GalleryController extends Controller
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

    public function addGallery($product_id){
        $this->Authenticate();
        $product_id = $product_id;
        return view('admin.gallery.add_gallery', compact('product_id'));
    }

    public function loadGallery(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $product_id = $data['product_id'];
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        
        $output = '<form enctype="multipart/form-data">
        '.csrf_field().'
        <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
        if($gallery_count > 0){
            $i = 1;
            foreach ($gallery as $key => $value) {
                
                $output .= '
                
                <tr>
                                <td>'.$i.'</td>
                                <td contenteditable class="edit_gallery_name" data-gala_id="'.$value->gallery_id.'">'.$value->gallery_name.'</td>
                                <td>
                                    <img class="img-thumbnail" src="'.url('public/uploads/gallery/'.$value->gallery_image).'" width="100px" height="100px">
                                    <input type="file" class="file_image" style="width:40%" data-gal_id="'.$value->gallery_id.'" id="file-'.$value->gallery_id.'" name="file" accept="image/*">
                                </td>
                                <td>
                                <a data-gala_id="'.$value->gallery_id.'" class="del_gala" ui-toggle-class="">
                                <i class="fa fa-trash text-danger text"></i></a>
                            </tr>
                            
                        ';
                        $i++;
               
            }
        } else {
            $output .= '<tr>
                            <td colspan="3">No data</td>
                        </tr>';
        }
        $output .= '</tbody></table>
        </form>';
        echo $output;
    }

    public function insertGallery($product_id, Request $request){
        $this->Authenticate();
        $data = $request->all();
        $get_image = $request->file('file');
        if($get_image){
            foreach ($get_image as $key => $value) {
                $get_image_name = $value->getClientOriginalName();
                $image_name = current(explode('.', $get_image_name));
                $new_image = $image_name.rand(1, 100).'.'.$value->getClientOriginalExtension();
                $value->move(public_path('/uploads/gallery'), $new_image);
                $gallery = new Gallery;
                $gallery->product_id = $product_id;
                $gallery->gallery_name = $image_name;
                $gallery->gallery_image = $new_image;
                $gallery->created_at = date('Y-m-d H:i:s');
                $gallery->updated_at = NULL;
                $gallery->save();
                Session::put('success', 'Add gallery success');
            }
        } else {
            Session::put('error', 'Add gallery error');
        }
        return Redirect::to('add-gallery/'.$product_id);
    }

    public function editGalleryName(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $gallery_id = $data['gallery_id'];
        $gallery_name = $data['gallery_name'];
        $gallery = Gallery::find($gallery_id);
        $gallery->gallery_name = $gallery_name;
        //rename in folder
        // $old_image = $gallery->gallery_image;
        // $new_image = $gallery->gallery_name;
        // rename(public_path('uploads/gallery/'.$old_image), public_path('uploads/gallery/'.$new_image));
        $gallery->updated_at = date('Y-m-d H:i:s');
        $gallery->save();
        
        
    }

    public function deleteGallery(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $gallery_id = $data['gallery_id'];
        $gallery = Gallery::find($gallery_id);
        $gallery->delete();
        $image_path = public_path('uploads/gallery/'.$gallery->gallery_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
    }

    public function updateGallery(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $get_image = $request->file('file');
        $gal_id = $data['gala_id'];
        if($get_image){
            //save new imaghe and remove old image
            $get_image_name = $get_image->getClientOriginalName();
            $image_name = current(explode('.', $get_image_name));
            $new_image = $image_name.rand(1, 100).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('/uploads/gallery'), $new_image);
            $gallery = Gallery::find($gal_id);
            $old_image = $gallery->gallery_image;
            $gallery->gallery_image = $new_image;
            $gallery->updated_at = date('Y-m-d H:i:s');
            $gallery->save();
            $image_path = public_path('uploads/gallery/'.$old_image);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }
    }
}
