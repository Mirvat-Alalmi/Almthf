<?php

namespace App\Http\Controllers;

use Redirect;
use TCG\Voyager\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $arr = Array('posts' => $posts);
        return view('mainPage', $arr);
    }

    public function indexWithMsg($msg)
    {
        $posts = Post::all();
        $arr = Array('posts' => $posts,
            'msg' => $msg);
//        return Redirect::to('mainPage')->with(compact('posts','msg'));
        return view('mainPage', $arr);
    }

    public function temp($user_id, $number_of_adults, $number_of_children, $come_date, $leave_date)
    {
//        dd($come_date);
//        dd(date("Y-m-d H:m:s", strtotime($come_date)));
        $arr = Array('user_id' => $user_id,
            'number_of_adults' => $number_of_adults,
            'number_of_children' => $number_of_children,
            'come_date' => date("Y-m-d H:m:s", strtotime($come_date)),
            'leave_date' => date("Y-m-d H:m:s", strtotime($leave_date)));
        return view('getRooms', $arr);
    }
}
