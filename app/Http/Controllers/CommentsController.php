<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager as Auth;
use App\Track;
use App\Comment;
use App\User;

class CommentsController extends Controller
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->middleware('auth', ['except' => ['index']]);

        $this->auth = $auth;
    }

    public function index(User $user)
    {
        $user = $user->with('comments.track')->get()->find($user->id);

        return view('comments.index', [
            'user' => $user,
            'auth' => $this->auth
        ]);
    }

    public function store(Request $request, Track $track)
    {
        $rules = [
            'body' => 'required'
        ];
        $messages = [
            'body.required' => 'Comment cannot be empty.'
        ];
        $this->validate($request, $rules, $messages);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->track_id = $track->id;
        $comment->body = $request->body;

        $comment->save();

        return back();
    }

    public function destroy(Track $track, Comment $comment)
    {
        if ($this->auth->id() != $comment->user->id) {
            return response(403, 'forbidden');
        }

        $comment->delete();

        return back();
    }
}
