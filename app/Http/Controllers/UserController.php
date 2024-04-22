<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataTables\UsersDataTable;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }
}
