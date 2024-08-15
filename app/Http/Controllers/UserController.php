<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserController extends Controller
{
    public function index()
    {
       return User::get();
    }

    public function store(StoreUserRequest $request)
    {
       return User::create($request->validated());
    }

    public function show(User $User)
    {
        return $User;
    }

    public function update(UpdateUserRequest $request, User $User)
    {
        $User->update($request->validated());
        return $User;
    }

    public function destroy(User $User)
    {
        $User->delete();
        return response()->json("User deleted successfully");
    }

    public function test(Request $request)
    {
        return $request->user();
    }
}
