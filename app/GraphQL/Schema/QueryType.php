<?php

namespace App\GraphQL\Schema;

use App\Book;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'book' => [
                        'type' => Types::book(),
                        'args' => [
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            return Book::query()->findOrFail($args['id']);
                        },
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}
