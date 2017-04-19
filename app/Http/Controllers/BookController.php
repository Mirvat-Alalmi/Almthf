<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('bookroom');
    }

    public function showRooms(Request $request)
    {
        $come_date = $request->input('come_date');
        $leave_date = $request->input('leave_date');
        $children = $request->input('children');
        $adults = $request->input('adults');
        $roomtype = $request->input('roomtype');
        if($roomtype==1){
            $roomtypename = "غرفة فردية";
        }
        elseif($roomtype==2){
            $roomtypename = "غرفة مزدوجة";
        }
        elseif($roomtype==3){
            $roomtypename = "غرفة عائلية";
        }
        $booked1 = Book::where('come_date','<=',$come_date)->Where('leave_date','>=',$come_date)->pluck('room_id')->toArray();
        $booked2 = Book::where('come_date','<=',$leave_date)->Where('leave_date','>=',$leave_date)->pluck('room_id')->toArray();
        $not_booked = Room::whereNotIn('id',$booked1)->whereNotIn('id',$booked2)->where('room_type_id',$roomtype)->get();
        $array_rooms = Array('rooms' => $not_booked,'come_date'=>$come_date,'leave_date'=>$leave_date,'children'=>$children,'adults'=>$adults,'type'=>$roomtypename);
        return view('rooms',$array_rooms);
    }

    public function bookRooms(Request $request)
    {
        $book = new Book();
        $book->room_id = $request->input('booked');
        $book->user_id = Auth::user()->id;
        $book->come_date = $request->input('come_date');
        $book->leave_date = $request->input('leave_date');
        $book->number_of_children =$request->input('children');
        $book->number_of_adults =$request->input('adults');
        $book->save();
        return redirect('hotel')->with('message', 'تم الحجز بنجاح , شكرا لك.');
    }


}
