<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use App\Ville;


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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tele' => ['required', 'string', 'min:9'],
            'ville_idVille' => ['required ', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tele'   => $data['tele'],
            'ville_idVille' => $data['ville_idVille'],
            'password' => Hash::make($data['password']),

        ]);
    }


    /**
 * Show the application registration form.
 *
 * @return \Illuminate\Http\Response
 */
    public function showRegistrationForm()
    {
        $car_ville = Ville::all();
        return view('auth.register', compact('car_ville'));
    }
    // public function index()
    // {
    //     $car_ville = DB::table('villes')
    //         ->groupBy('nomVille')
    //         ->get();
    //     return view('auth.register')->whith('car_ville', $car_ville);
    // }
}
