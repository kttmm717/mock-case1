<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;

class RegisteredUserController extends Controller
{
    public function store(Request $request, CreateNewUser $creator) {
        event(new Registered($user = $creator->create($request->all())));

        session()->put('unauthentication_user', $user);

        return redirect('/email/verify');
    }
}
