<?php

namespace App\Http\Controllers\Auth;

use App\Models\Customer;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|digits_between:9,10|integer',
            'ssn' => 'digits:3|integer|unique:customers',
            'credit' => 'digits_between:13,19|integer',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['firstName'] . " " . $data['lastName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->f_name = $data['firstName'];
        $customer->l_name = $data['lastName'];
        $customer->phone = $data['phone'];
        if ($data['ssn']) {
        } else {
            $data['ssn'] = null;
        }

        if ($data['credit']) {
        } else {
            $data['credit'] = null;
        }

        $customer->ssn = $data['ssn'];
        $customer->credit_card_num = $data['credit'];
        $customer->address1 = $data['address1'];
        $customer->address2 = $data['address2'];
        $customer->address3 = $data['address3'];
        $customer->save();

        return $user;
    }
}
