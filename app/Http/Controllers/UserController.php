<?php

namespace App\Http\Controllers;

use App\Models\SalePoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{

    public function index()
    {
        return view("user.index", [
            "users" => User::not_admin()
        ]);
    }

    public function create()
    {
        return view("user.form", [
            "pvs" => SalePoint::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);
        $user = new User();
        $user->fill($request->all());
        $user->encrypt();
        $user->save();
        return Redirect::route('users.index');
    }

    public function show(User $user)
    {
        return view("user.show",[
            "user" => $user
        ]);
    }

    public function edit(User $user)
    {
        return view("user.form", [
            "pvs" => SalePoint::all(),
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $name = null;
        $email = null;
        if($request->name != $user->name)
            $name = 'unique:users';
        if($request->email != $user->email)
            $email = 'unique:users';
        $request->validate([
            'name' => ['required', $name],
            'email' => ['required', 'email', $email],
            'password' => ['sometimes','required']
        ]);
        $user->update($request->all());
        return Redirect::route("users.index");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route("users.index");
    }
}
