<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(Request $req){
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function register(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $check = $user->save();
        return redirect()->intended('/');
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }
    public function getChangePassword(){
        return view('client.profile.changePassword');
    }
    public function changePassword(Request $req){
        $req->validate([
            'currentPassword' => 'required | min:6',
            'newPassword' => 'required | min:6 | different:currentPassword',
            'confirmPassword' => 'required | same:newPassword'
        ]);

        if(Auth::check()){
                $user = Auth::user();
                $currentPassword = $req->input('currentPassword');
                $newPassword = $req->input('newPassword');
            
                if(Hash::check($currentPassword, $user->password)){
                    $user->password = Hash::make($newPassword);
                    if($user->save()){
                        return redirect()->route('getChangePassword')->with('success', 'Your password has been changed.');
                    }else{
                        return redirect()->route('getChangePassword')->with('error', 'Unable to change password. Please try again.');
                    }
                }else{
                    return redirect()->route('getChangePassword')->with('error', 'Current password is incorrect.');
                }
        }else{
            return redirect()->route('getChangePassword')->with('error', 'You need to be logged in to change your password.');
        }
    }
}
