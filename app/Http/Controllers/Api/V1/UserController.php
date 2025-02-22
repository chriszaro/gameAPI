<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->user()->role == 'Admin') {
            $includeGames = $request->query('includeGames');

            $users = User::where([]);

            if ($includeGames) {
                $users = $users->with('games');
            }

            return new UserCollection($users->get());
        }
        else
            return  response()->json(['message' => 'You do not have the right for this action'], 401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //User::create($request->all());

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password!
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (request()->user()->role == 'Admin') {
            $includeGames = request()->query('includeGames');

            if ($includeGames) {
                return new UserResource($user->loadMissing('games'));
            }

            return new UserResource($user);
        }
        else
            return  response()->json(['message' => 'You do not have the right for this action'], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function make_admin(User $user)
    {
        if (request()->user()->role == 'Admin'){
            $user->role = 'Admin';
            $user->save();
            return  response()->json(['message' => $user->username . ' is now '. $user->role], 200);
        }
        else
            return  response()->json(['message' => 'You do not have the right for this action'], 401);
    }
}
