<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use App\Tag;

class TagsController extends Controller
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function index(Tag $tag)
    {
        $tag = $tag->with('tracks.user', 'tracks.likes', 'tracks.comments')->get()->find($tag->id);

        $tag->tracks = $tag->tracks->sortByDesc(function ($track) {
            return $track->likes->count();
        });

        return view('tags.index', [
            'tag' => $tag,
            'storage' => $this->storage
        ]);
    }
}
