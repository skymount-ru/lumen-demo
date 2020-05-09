<?php


namespace App;


class Book extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'url', 'name', 'isbn', 'authors', 'numberOfPages', 'publisher', 'country', 'mediaType', 'released', 'characters', 'povCharacters',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
//    protected $hidden = [];
}
