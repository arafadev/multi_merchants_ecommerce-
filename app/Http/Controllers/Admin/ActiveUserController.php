<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class ActiveUserController  extends Controller
{
    public function users()
    {
        return view('admin.active.users.index', ['users' => User::latest()->get()]);
    }
}
