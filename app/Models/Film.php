<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'photo', 'slug', 'genres'];

    protected $casts = [
        'rating' => 'int',
        'ticket_price' => 'double',
        'genres' => 'json'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCommentsAttribute()
    {
        return $this->comments()->get();
    }
}
