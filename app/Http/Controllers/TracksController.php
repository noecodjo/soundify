<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Auth\AuthManager as Auth;
use App\Track;
use App\Tag;

class TracksController extends Controller
{
    private $auth;

    private $storage;

    public function __construct(Auth $auth, Storage $storage)
    {
        $this->middleware('auth', ['except' => ['show']]);

        $this->auth = $auth;
        $this->storage = $storage;
    }

    public function create()
    {
        return view('tracks.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'track' => 'required|file|mimetypes:audio/mpeg|max:200000',
            'tag' => 'required|max:255|regex:/^[a-z \-0-9]+$/i',
            'name' => 'required|max:255',
            'description' => 'max:5000'
        ];
        $this->validate($request, $rules);

        $ext = $request->file('track')->guessExtension();
        $filename = uniqid('', true) . '.' . $ext;

        $dir = 'public/tracks/' . $request->user()->id;

        $path = $request->file('track')->storeAs($dir, $filename);

        $track = new Track();
        $track->user_id = $this->auth->id();
        $track->name = $request->name;
        $track->description = $request->description;
        $track->path = $path;

        $tag = Tag::where('name', '=', $request->tag)->first();

        if ($tag) {
            $track->tag_id = $tag->id;

            $track->save();
        } else {
            $tag = new Tag();
            $tag->name = $request->tag;

            $tag->save();

            $tag->tracks()->save($track);
        }


        return redirect('/');
    }

    public function show(Track $track)
    {
        $id = $track->id;

        $track = $track->with('user', 'tag', 'likes', 'comments.user')->get()->find($id);

        return view('tracks.show', [
            'track' => $track,
            'storage' => $this->storage,
            'auth' => $this->auth
        ]);
    }

    public function edit(Track $track)
    {
        if ($this->auth->id() != $track->user->id) {
            return response(403, 'forbidden');
        }

        return view('tracks.edit', compact('track'));
    }

    public function update(Request $request, Track $track)
    {
        if ($this->auth->id() != $track->user->id) {
            return response(403, 'forbidden');
        }

        $rules = [
            'name' => 'required|max:255',
            'tag' => 'required|max:255|regex:/^[a-z \-0-9]+$/i',
            'description' => 'max:5000'
        ];
        $this->validate($request, $rules);

        $track->name = $request->name;
        $track->description = $request->description;

        if (strtolower($request->tag) !== strtolower($track->tag->name)) {
            $tag = Tag::where('name', '=', $request->tag)->first();

            if (!$tag) {
                $tag = new Tag();
                $tag->name = $request->tag;

                $tag->save();

                $tag->tracks()->save($track);

            } else {
                $track->save();
            }
        } else {
            $track->save();
        }

        session()->flash('flash_message', 'Track updated.');

        return back();
    }

    public function updateAvatar(Request $request, Track $track)
    {
        if ($this->auth->id() != $track->user->id) {
            return response(403, 'forbidden');
        }

        $rules = [
            'avatar' => 'required|image|max:512'
        ];
        $this->validate($request, $rules);

        $ext = $request->file('avatar')->guessExtension();
        $filename = 'avatar.' . $ext;

        $dir = 'public/track_avatars/' . $track->id;

        $this->storage->deleteDirectory($dir);

        $path = $request->file('avatar')->storeAs($dir, $filename);

        session()->flash('flash_message', 'Avatar updated.');

        return back();
    }

    public function delete(Track $track)
    {
        if ($this->auth->id() != $track->user->id) {
            return response(403, 'forbidden');
        }

        return view('tracks.delete', compact('track'));
    }

    public function destroy(Track $track)
    {
        if ($this->auth->id() != $track->user->id) {
            return response(403, 'forbidden');
        }

        $this->storage->delete($track->path);

        $track->likes()->detach();
        $track->comments()->delete();
        $track->delete();

        $msg = 'Deleted track "' . $track->name . '".';

        session()->flash('flash_message', $msg);

        return redirect('/users/you/tracks');
    }
}
