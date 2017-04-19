<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\OrderMeal;
use App\Models\FoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ResController extends Controller {

    public function index() {
        $foodTypes = FoodType::all();
//        $meals = Meal::all();
        $arr = Array('foodTypes' => $foodTypes);
        return view('restorunte', $arr);
    }

    public function meels_checked(Request $req) {

        $newOrder = new \App\Models\Order();
        $newOrder->user_id = Auth::user()->id;
        $address = null;

        if ($req->input('address') == null) {
            $temp_cust = \App\Models\Customer::where('user_id', '=', Auth::user()->id)->get();
            foreach ($temp_cust as $user) {
                $user_address = var_dump($user->name);
            }

//            dd($req);
//            $user_address = $temp_cust['address1'];
            if ($user_address == null) {
                return redirect()->back()->with('message', 'يجب ادخال عنوان للتوصيل');
            }else{
               $address = $user_address;
            }
        } else {
            $address = $req->input('address');
        }

        $newOrder->order_date_time = gmdate('Y-m-d H:i:s', strtotime($req->input('date')));
        $newOrder->address = $address;
        $newOrder->created_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->updated_at = gmdate('Y-m-d H:i:s', strtotime(Carbon::now()->toDateTimeString()));
        $newOrder->save();
        $amount=$req->input("amount");
//            dd($req);
        foreach ($req->input('myCheck') as $meal) {
            $orderMeal = new OrderMeal();
            $orderMeal->order_id = $newOrder->id;
            $orderMeal->meal_id = $meal;
            $orderMeal->amount = $amount[$meal];
            
            $orderMeal->save();
        }


        $foodTypes = FoodType::all();
        $meals = Meal::all();
        $arr = Array('foodTypes' => $foodTypes, 'meals' => $meals);
        return view('restorunte', $arr);
    }

}
