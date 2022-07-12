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
        $videos = Video::orderBy('video_id', 'desc')->get();
        $video_count = $videos->count();
        $output = '<form enctype="multipart/form-data">
        '.csrf_field().'
        <table class="table table-bordered table-hover">
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
                    <td>'.$video->video_title.'</td>
                    <td>'.$video->video_link.'</td>
                    <td>'.$video->video_desc.'</td>
                    <td>
                      <iframe width="200" height="100" src="https://www.youtube.com/embed/'.$video->video_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </td>
                    <td>
                        <a data-video_id="'.$video->video_id.'" class="del_video" ui-toggle-class="">
                        <i class="fa fa-trash text-danger text"></i></a>
                    </td>
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
        echo $output;
    }

    public function deleteVideo(Request $request){
        $this->Authenticate();
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = Video::find($video_id);
        $video->delete();
    }
}
