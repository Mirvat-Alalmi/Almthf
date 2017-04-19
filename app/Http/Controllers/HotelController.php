<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        $arr = Array('roomTypes' => $roomTypes);
        return view('hotel', $arr);
    }

    public function showRooms(Request $request, $typeId)
    {

        $type = RoomType::find($typeId);
        $rooms = Room::where('room_type_id', '=', $typeId)->get();
        $arr = Array('roomTypes' => $type,
            'rooms' => $rooms);
        return response()->view('rooms', $arr);

    }
}
