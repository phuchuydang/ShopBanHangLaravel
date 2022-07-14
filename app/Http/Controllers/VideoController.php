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
use App\Models\Video;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();

class VideoController extends Controller
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

    public function video(){
        return view('admin.video.list_video');
    }

    public function loadVideo(Request $request){
        $this->Authenticate();
        $videos = Video::orderBy('video_id', 'asc')->get();
        $video_count = $videos->count();
        //get word after https://youtu.be/
        $videos = $videos->map(function ($video) {
            $video->video_link = substr($video->video_link, 17);
            return $video;
        });
        $output = '<form enctype="multipart/form-data">
        '.csrf_field().'
        <table id="myTables" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Video Title</th>
                    <th>Link</th>
                    <th>Description</th>
                    <th>Demo</th>
                    <th style="width:30px;">Action</th>
                </tr>
            </thead>
            <tbody>';
        if($video_count > 0){
            $i = 1;
            foreach ($videos as $video) {
                $output .= '
                <tr>
                    <td>'.$i.'</td>
                    <td  data-video_id="'.$video->video_id.'" class="edit_video_title">'.$video->video_title.'</td>
                    <td class="edit_video_link">https://youtu.be/'.$video->video_link.'</td>
                    <td  class="edit_video_desc">'.$video->video_desc.'</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#video_demo-'.$video->video_id.'">
                        Watch Demo
                    </button>
                  
                    </td>
                    <td>
                
                        <a href="'.url('edit-video/'.$video->video_id).'" ">
                        <i class="fa fa-pencil-square text-success text-active"></i></a>
                        <a data-video_id="'.$video->video_id.'" class="del_video" ui-toggle-class="">
                            <i class="fa fa-trash text-danger text"></i></a>
                    </td>
                        <div class="modal fade" id="video_demo-'.$video->video_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Video Demo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" id="video">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$video->video_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <script>
                        $(document).ready(function(){
                            $("#video_demo-'.$video->video_id.'").on("hidden.bs.modal", function(){
                                $("#video").html("");
                                location.reload();
                            });
                        });
                        </script>
                </tr>';
                $i++;
            }  
        } else {
            $output .= '
            <tr>
                <td colspan="6">No data found</td>
            </tr>';
        }
        
        
        $output .= '</tbody></table></form>';
        // $output .= '';
        echo $output;
    }

    public function deleteVideo(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = Video::find($video_id);
        $video->delete();
    }

    public function addVideo(){
       return view('admin.video.add_video');
    }

    public function saveVideo(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $video = new Video;
        // $get_image = $request->file('video_image');
        // if($get_image){
        //     $get_image_name = $get_image->getClientOriginalName();
        //     $__image_name = current(explode('.', $get_image_name));
        //     $new_image = $__image_name.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        //     $get_image->move(public_path('images/video'), $new_image);
            
        //     $video->video_title = $data['video_title'];
        //     $video->video_link = $data['video_link'];
        //     $video->video_desc = $data['video_desc'];
        //     $video->video_image = $new_image;
        //     $video->save();
        // } else {
        //     echo "No image";
        // }
        $video->video_title = $data['video_title'];
        $video->video_link = $data['video_link'];
        $video->video_desc = $data['video_desc'];
        $video->video_image = "0";
        $video->save();
       
    }

    public function editVideo($video_id){
        $this->Authenticate();
        $video = Video::find($video_id);
        return view('admin.video.edit_video', compact('video'));
    }

    public function updateVideo(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = Video::find($video_id);
        $video->video_title = $data['video_title'];
        $video->video_link = $data['video_link'];
        $video->video_desc = $data['video_desc'];
        $video->save();
    }

    public function videoShop(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status', 1)->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', 1)->orderby('brand_id', 'desc')->get();
        $all_video = Video::orderBy('video_id', 'asc')->paginate(6);
        return view('pages.video.video', compact('cate_product', 'brand_product', 'all_video'));
    }
}
