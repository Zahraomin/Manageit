<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Application;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->application()->detach(Application::all());
        $user->delete();

        Session::put('key', $id);

        return redirect('home');
    }

    public function show($id)
    {
        $user = User::find($id);
        $user->load('application');

        return response($user);
    }

}
