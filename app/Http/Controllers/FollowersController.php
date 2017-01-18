<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use App\User;

class FollowersController extends Controller
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->middleware('auth', ['except' => [
            'followers', 'following'
        ]]);
        $this->storage = $storage;
    }

    public function followers(User $user)
    {
        $user = $user->with('followers')->get()->find($user->id);

        return view('followers.index', [
            'user' => $user,
            'storage' => $this->storage
        ]);
    }

    public function following(User $user)
    {
        $user = $user->with('follows')->get()->find($user->id);

        return view('followers.follows', [
            'user' => $user,
            'storage' => $this->storage
        ]);
    }

    public function toggle(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            dd('why are you trying to follow yourself?');
        }

        $user->followers()->toggle($request->user());

        return back();
    }
}
