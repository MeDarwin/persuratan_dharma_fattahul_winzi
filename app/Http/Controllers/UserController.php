<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /* ---------------------------------- VIEWS --------------------------------- */
    public function index()
    {
        $data = ['users' => User::all(['*'])];
        return view('manage.user', $data);
    }

    public function indexAdd()
    {
        return view('manage.add.user');
    }
    public function indexEdit(Request $request)
    {
        $data = ['user' => User::find($request['id'])];
        return view('manage.edit.user', $data);
    }

    /* --------------------------------- ACTION --------------------------------- */
    public function add(UserRequest $request)
    {
        return User::query()->create($request->validated())
            ? redirect()->to('/user')->with('success', 'User created')
            : redirect()->back()->with('err', 'User failed to create');
    }
    public function destroy(Request $request)
    {
        return User::query()->find($request->id)->delete()
            ? $request->session()->flash('success', 'User deleted')
            : $request->session()->flash('err', 'User failed to delete');
    }
    public function update(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->validated()['password']);
        return User::query()->find($request['id'])->fill($data)->save()
            ? redirect()->to('/user')->with('success', 'User updated')
            : redirect()->to("/user/$request[id]/edit")->with('err', 'User failed to update');
    }
}