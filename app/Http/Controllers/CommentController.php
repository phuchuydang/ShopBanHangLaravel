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
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();

class CommentController extends Controller
{
    public function loadComment(Request $request)
    {
        $data = $request->all();
        $product_id = $data['product_id'];
        $output ='';
        
        $comments = Comment::where('comment_product_id', $product_id)->get();
        foreach ($comments as $comment) {
            if($comment->comment_status == 1 && $comment->comment_parent == 0){
                $output .= '<div class="row style_comment">
                           
                            <div class="col-md-3">
                                <img src="'.url('public/frontend/images/batman.png').'" class="img-circle" alt="User Image" style="width:100px;height:100px;">
                            </div>
                            <div class="col-md-9">
                                <p>
                                    <b>'.$comment->comment_name.'</b>
                                </p>
                                <p>
                                    <b>'.$comment->comment_date.'</b>
                                </p>
                                <p>'.$comment->comment_content.'</p>
                            </div>
                        </div>
                        <br>';

                foreach ($comments as $comment_child) {
                    if($comment_child->comment_parent == $comment->comment_id){
                        $output .= '<div class="row style_comment" style="margin: 5px 50px; background: #ddd">
                           
                            <div class="col-md-3">
                                <img src="'.url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEqUPHsU4ebuzz1VkrvE2aQE5r5e6g76UJu3l6_EGVZCyA3kn0GQoQ8urtDyGxDvRhJMA&usqp=CAU').'" class="img-circle" alt="User Image" style="width:60%;">
                            </div>
                            <div class="col-md-9">
                                <p>
                                    <b>Admin</b>
                                </p>
                                <p>
                                    <b>'.$comment_child->comment_date.'</b>
                                </p>
                                <p>'.$comment_child->comment_content.'</p>
                            </div>
                        </div>
                        <br>';
                    }
                }
            } 
        }
        echo $output;
    }

    public function sendComment(Request $request)
    {
        $data = $request->all();
        $product_id = $data['product_id'];
        $comment_name = $data['comment_name'];
        $comment_email = $data['comment_email'];
        $comment_content = $data['comment_content'];
      
            $comment = new Comment();
            $comment->comment_product_id = $product_id;
            $comment->comment_name = $comment_name;
            $comment->comment_email = $comment_email;
            $comment->comment_content = $comment_content;
            $comment->comment_date = date('Y-m-d H:i:s');
            $comment->comment_status = 1;
            $comment->created_at = date('Y-m-d H:i:s');
            $comment->updated_at = NULL;
            $comment->save();
        
    }

    public function listComment(){
        $comments = Comment::all();
        return view('admin.comment.all_comment', ['comments' => $comments]);
    }
    
    public function hideComment(Request $request){
        $data = $request->all();
        $comment_id = $data['comment_id'];
        $comment = Comment::find($comment_id);
        $comment_count = $comment->count();
        if($comment_count > 0){
            $comment->comment_status = 0;
            $comment->save();
        } else {
            echo '<script>alert("Không tìm thấy bình luận")</script>';
        }
    }

    public function displayComment(Request $request){
        $data = $request->all();
        $comment_id = $data['comment_id'];
        $comment = Comment::find($comment_id);
        $comment_count = $comment->count();
        if($comment_count > 0){
            $comment->comment_status = 1;
            $comment->save();
        } else {
            echo '<script>alert("Không tìm thấy bình luận")</script>';
        }
    }

    public function deleteComment(Request $request){
        $data = $request->all();
        $comment_id = $data['comment_id'];
        $comment = Comment::find($comment_id);
        $comment_count = $comment->count();
        if($comment_count > 0){
            $comment->delete();
        } else {
            echo '<script>alert("Không tìm thấy bình luận")</script>';
        }
    }

    public function replyComment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_content = $data['reply_comment']; 
        $comment->comment_parent = $data['comment_id']; //comment_id là id của comment cha
        $comment->comment_name = 'Admin Reply';
        $comment->comment_email = 'Hidden';
        $comment->comment_status = 1;
        $comment->save();
    }
}
