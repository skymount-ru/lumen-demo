<?php

namespace App\GraphQL\Schema\Mutations;

use App\Book;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class BookMutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'update' => [
                        'type' => Type::boolean(),
                        'description' => 'Update a book.',
                        'args' => [
                            'name' => Type::string(),
                            'isbn' => Type::string(),
                        ],
                        'resolve' => function(Book $book, $args) {
                            return $book->update($args);
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
