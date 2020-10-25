<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterUserController extends Controller
{
    public function registerUserView(){
        return view('auth.register');
    }

    public function registerUserConfirm(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number'=>['required', 'string', 'min:11', 'max:11'],
            'organization_name'=>['string', 'min:3','max:10'],
            'key'=>['string'],
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        try{
            $model = Organization::query()->where('name',$request->organization_name)->where('key', $request->key)->first('id');
        }catch(\Exception $exception){
            echo $exception;
        }
        if ($model !=null){
            $user->organization_id = $model['id'];
        }
        $user->save();
        return redirect()->route('homesus');
    }

}
