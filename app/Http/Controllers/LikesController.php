<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use App\Track;
use App\User;

class LikesController extends Controller
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->middleware('auth')->only('toggle');
        $this->storage = $storage;
    }

    public function userLikes(User $user)
    {
        $tracks = $user->likes()->with('user', 'comments', 'likes', 'tag')->get()->sortByDesc('created_at');

        return view('likes.user', [
            'tracks' => $tracks,
            'user' => $user,
            'storage' => $this->storage
        ]);
    }

    public function showLikes(Track $track)
    {
        $track = $track->with('likes')->get()->find($track->id);

        return view('likes.show', compact('track'));
    }

    public function toggle(Request $request, Track $track)
    {
        $user = $request->user();

        $user->likes()->toggle($track);

        return back();
    }
}
