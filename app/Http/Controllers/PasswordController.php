<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class PasswordController extends Controller
{
    public function showEmailValidation()
    {
        return view('auth.passwords.custom_forget_password');
    }

    public function validateUser(Request $request)
    {
        $user = User::where(['nik' => $request->nik, 'email' => $request->email])->first();
        
        if ($user) {
            return view('auth.passwords.custom_reset_password', compact('user'));
        }

        toastr()->error('User tidak memiliki data yang sesuai!', 'Error');
        return redirect()->back();
    }

    public function reset(Request $request)
    {
        if ($request->password) {
            $user = User::where(['nik' => $request->nik, 'email' => $request->email])->first();
            $user->update(['password' => bcrypt($request->password)]);

            toastr()->success('Password berhasil direset, Silahkan Login!', 'Sukses');
            return redirect(route('custom.login'));
        }
    }

    public function showChangePasswordForm()
    {
        return view('admin.user.change_password');
    }

    public function change(Request $request)
    {
        // $user = User::where('id', Auth::user()->id)->get();
        // dd($request->all());
        if (Hash::check($request->oldpass, Auth::user()->password)) {
            if ($request->oldpass != $request->newpass) {
                User::where('id', Auth::user()->id)->update([
                    'email' => $request->email,
                    'password' => bcrypt($request->newpass)
                ]);

                toastr()->success('Password berhasil diganti!', 'Sukses');
                return redirect(route('home'));
            } else {
                toastr()->error('Password lama dan password baru tidak boleh sama!', 'Error');
                return redirect()->back();
            }
        } else {
            toastr()->error('Password lama anda tidak sesuai');
            return redirect()->back();
        }
    }
}
