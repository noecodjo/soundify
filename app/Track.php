<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Storage;

class Track extends Model
{
    use Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains(function ($liker) use ($user) {
            return $user->id == $liker->id;
        });
    }

    public function avatarPath()
    {
        $dir = 'public/track_avatars/' . $this->id;

        $files = Storage::files($dir);

        if ($files) {
            $path = $files[0];

            return Storage::url($path);
        }

        return $this->user->avatarPath();
    }
}
