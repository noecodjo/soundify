<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use App\Track;

class SearchController extends Controller
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function index(Request $request)
    {
        $query = '';
        $tracks = collect();

        if ($request->has('query')) {
            $query = $request->get('query');
            $tracks = Track::search($query)->get()->load('user', 'likes', 'comments');
        }

        return view('search.index', [
            'tracks' => $tracks,
            'query' => $query,
            'storage' => $this->storage
        ]);
    }
}
