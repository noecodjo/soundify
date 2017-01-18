<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Track::class, 'likes');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function avatarPath()
    {
        $dir = 'public/user_avatars/' . $this->id;

        $path = 'public/user_avatars/default_500x500.jpg';

        $files = Storage::files($dir);

        if ($files) {
            $path = $files[0];
        }

        return Storage::url($path);
    }

    public function followedBy(User $user)
    {
        return $this->followers->contains(function ($followee) use ($user) {
            return $user->id == $followee->id;
        });
    }
}
