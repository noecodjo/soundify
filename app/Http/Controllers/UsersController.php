<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Contracts\Hashing\Hasher as Hash;
use Illuminate\Auth\AuthManager as Auth;
use App\User;

class UsersController extends Controller
{
    private $auth;

    private $storage;

    private $hash;

    public function __construct(Auth $auth, Hash $hash, Storage $storage)
    {
        $this->middleware('auth', ['except' => ['show']]);

        $this->auth = $auth;
        $this->hash = $hash;
        $this->storage = $storage;
    }

    public function show(User $user)
    {
        $id = $user->id;

        $user = $user->with('tracks.likes', 'tracks.comments', 'tracks.tag', 'follows', 'followers', 'likes.user', 'comments.track')->find($id);

        $user->tracks = $user->tracks->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'storage' => $this->storage,
            'auth' => $this->auth
        ]);
    }

    public function edit()
    {
        $user = $this->auth->user();

        return view('users.edit', compact('user'));
    }

    public function tracks()
    {
        $user = $this->auth->user()->with('tracks.likes', 'tracks.comments')->get()->find($this->auth->id());

        $tracks = $user->tracks;

        return view('users.tracks', compact('tracks'));
    }

    public function update(Request $request, User $user)
    {
        if ($this->auth->id() != $user->id) {
            return response(403, 'forbidden');
        }

        $rules = [
            'name' => 'required|max:255',
            'username' => [
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => [
                'sometimes',
                'required',
                'min:6',
                'confirmed'
            ]
        ];
        $this->validate($request, $rules);

        $user->update($request->all());

        session()->flash('flash_message', 'Settings updated.');

        return back();
    }

    public function updatePassword(Request $request, User $user)
    {
        if ($this->auth->id() != $user->id) {
            return response(403, 'forbidden');
        }

        $rules = [
            'password_old' => 'required',
            'password' => 'required|min:6|confirmed'
        ];
        $this->validate($request, $rules);

        $confirmCurrent = $request->password_old;
        $currentPassword = $this->auth->user()->password;

        if (!$this->hash->check($confirmCurrent, $currentPassword)) {
            return redirect()->back()->withErrors(['password_old' => 'Incorrect password.']);
        }

        $newPassword = $request->password;

        $hash = $this->hash->make($newPassword);
        $user->password = $hash;

        $user->save();

        session()->flash('flash_message', 'Password updated.');

        return back();
    }

    public function updateAvatar(Request $request, User $user)
    {
        if ($this->auth->id() != $user->id) {
            return response(403, 'forbidden');
        }

        $rules = [
            'user_avatar' => 'required|image|max:512'
        ];
        $this->validate($request, $rules);

        $ext = $request->file('user_avatar')->guessExtension();
        $filename = 'avatar.' . $ext;

        $dir = 'public/user_avatars/' . $user->id;

        $this->storage->deleteDirectory($dir);

        $path = $request->file('user_avatar')->storeAs($dir, $filename);

        session()->flash('flash_message', 'Avatar updated.');

        return back();
    }
}
