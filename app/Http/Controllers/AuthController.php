<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function index()
  {
    return view('login.index', [
      'title' => 'Login',
      'active' => 'login'
    ]);
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'deleted_at' => null])) {
      $request->session()->regenerate();
      return redirect()->intended('/');
    }

    return back()->with('loginError', 'Login Failed');
  }

  public function logout()
  {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
  }
}
