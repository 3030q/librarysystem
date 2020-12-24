<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;


class AdminConfirmController extends Controller
{
    public function adminConfirmView()
    {
        return view('adminconfirm');
    }

    public function adminConfirmReq(Request $request)
    {
        if (Hash::check($request->admin_password, (Organization::query()->where('id', Auth::user()->organization_id)->firstOrFail('admin_password')['admin_password'])))
        {
            try {
                User::where('id', (Auth::user()->id))->update(['role' => 'admin']);
            } catch (\Exception $exception) {
                echo $exception;
            }
            return redirect()->route('profile');
        }
    }
}
