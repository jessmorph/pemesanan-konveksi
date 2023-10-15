<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function index()
  {
    $listUser = DB::table('users')
      ->join('roles', 'roles.id', '=', 'users.role_id')
      ->select('users.id as id', 'namaUser', 'username', 'role_id as roleId', 'roles.name as roleName')
      ->whereNull('users.deleted_at')
      ->get();
    $listRole = DB::table('roles')
      ->select('id', 'name')
      ->get();
    return view('user.user', [
      'active' => 'user',
      'data' => $listUser,
      'listRoles' => $listRole
    ]);
  }

  public function store(Request $request)
  {
    if (isset($request->userId)) {
      if (isset($request->password) && $request->password != '') {
        DB::table('users')
          ->where('id', $request->userId)
          ->update([
            'namaUser' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            "updated_at" => date('Y-m-d H:i:s'),
            'role_id' => $request->role
          ]);
      } else {
        DB::table('users')
          ->where('id', $request->userId)
          ->update([
            'namaUser' => $request->nama,
            'username' => $request->username,
            "updated_at" => date('Y-m-d H:i:s'),
            'role_id' => $request->role
          ]);
      }
    } else {
      DB::table('users')
        ->insert([
          'namaUser' => $request->nama,
          'username' => $request->username,
          'password' => bcrypt($request->password),
          "created_at" =>  date('Y-m-d H:i:s'),
          "updated_at" => date('Y-m-d H:i:s'),
          'role_id' => $request->role
        ]);
    }
    return redirect()->intended('/user');
  }

  public function getUser(string $request)
  {
    $id = (int) $request;
    if ($id) {
      $user = DB::table('users')->select('id', 'namaUser', 'username', 'role_id as roleId')->where('id', $id)->first();
      return $user;
    }
    abort(404);
  }

  public function deleteUser(Request $request)
  {
    $id = (int) $request->idDelete;
    if ($id) {
      DB::table('users')
        ->where('id', $id)
        ->update([
          'deleted_at' => date('Y-m-d H:i:s')
        ]);
      return redirect()->intended('/user');
    }
    abort(404);
  }
}
