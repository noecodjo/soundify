<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Auth\AuthManager as Auth;
use App\Track;

class HomeController extends Controller
{
    private $storage;

    private $auth;

    public function __construct(Storage $storage, Auth $auth)
    {
        $this->storage = $storage;
        $this->auth = $auth;
    }

    public function index()
    {
        $user = $this->auth->check() ? $this->auth->user() : null;

        $tracks = collect();

        if ($user) {
            $user = $user->with('tracks.user', 'tracks.likes', 'tracks.comments', 'tracks.tag', 'likes.user', 'follows.tracks.user', 'follows.tracks.likes', 'follows.tracks.comments', 'follows.tracks.tag')
                ->get()
                ->find($user->id);
            $tracks = $user->tracks;

            foreach ($user->follows as $followee) {
                $tracks = $tracks->merge($followee->tracks);
            }

            $tracks = $tracks->sortByDesc('created_at');
        } else {
            $tracks = Track::with('user', 'tag', 'likes', 'comments')->get()->sortByDesc('created_at')->take(5);
        }

        return view('home.index', [
            'user' => $user,
            'tracks' => $tracks,
            'storage' => $this->storage,
            'auth' => $this->auth
        ]);
    }
}
