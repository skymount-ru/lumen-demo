<?php


namespace App;


class Book extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'url', 'name', 'isbn', 'authors', 'numberOfPages', 'publisher', 'country', 'mediaType', 'released', 'characters', 'povCharacters',
    ];

    protected $casts = [
        'authors' => 'array',
        'characters' => 'array',
        'povCharacters' => 'array',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
