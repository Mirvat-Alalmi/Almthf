<?php

namespace App\Http\Controllers;

use App\Models\Sugg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggController extends Controller
{


    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
//                'title' => 'required|min:3',
                'comment' => 'required|min:10|max:100',
            ]);

            $sugg = new Sugg();
            $sugg->user_id = Auth::user()->id;
//            $sugg->title = $request->input('title');
            $sugg->comment = $request->input('comment');
            $sugg->save();
//            return redirect('home/suggSucc');
//            return redirect()->route('home', ['msg' => 'succ']);

            return redirect()->back()->with('message', 'تم ارسال تعليقك بنجاح , شكرا لك.');

        }
    }
}
