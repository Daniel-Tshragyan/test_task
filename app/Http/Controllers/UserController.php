<?php

namespace App\Http\Controllers;

use App\Facades\UserServiceFacade;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $usersCount = cache()->remember('usersCount', 60 * 60 * 24, function() {
            return User::all()->count();
        });

        return view('user.index', compact('usersCount'));
    }

    public function import()
    {
        UserServiceFacade::import();
        return response()->json(UserServiceFacade::getImportInfo());
    }
}
