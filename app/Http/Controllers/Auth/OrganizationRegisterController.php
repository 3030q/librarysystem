<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class OrganizationRegisterController extends Controller
{
    public function orgRegisterView(){
        return view('auth.organizationRegister');
    }

    public function orgRegisterConfirm(Request $request){
         $request->validate([
            'name'=>['required', 'min:3', 'max:100'],
            'password'=>['required', 'min:8', 'max:100', 'string', 'confirmed']
        ]);
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->key = $request->password;
        $organization->admin_password = $request->admin_password;
        $organization->save();
        return redirect()->route('homesus');
    }

}
