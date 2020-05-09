<?php

namespace App\GraphQL\Schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class BookType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'url' => [
                        'type' => Type::string(),
                    ],
                    'name' => [
                        'type' => Type::string(),
                    ],
                    'isbn' => [
                        'type' => Type::string(),
                    ],
                    'authors' => [
                        'type' => Type::listOf(Type::string()),
                    ],
                    'numberOfPages' => [
                        'type' => Type::int(),
                    ],
                    'publisher' => [
                        'type' => Type::string(),
                    ],
                    'country' => [
                        'type' => Type::string(),
                    ],
                    'mediaType' => [
                        'type' => Type::string(),
                    ],
                    'released' => [
                        'type' => Type::string(),
                    ],
                    'characters' => [
                        'type' => Type::listOf(Type::string()),
                    ],
                    'povCharacters' => [
                        'type' => Type::listOf(Type::string()),
                    ],
                ];
            },
        ];
        parent::__construct($config);
    }
}
