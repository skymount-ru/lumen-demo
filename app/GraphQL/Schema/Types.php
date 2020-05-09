<?php

namespace App\GraphQL\Schema;

use App\GraphQL\Schema\Mutations\BookMutationType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\UnionType;
use Illuminate\Database\Eloquent\Model;

class Types
{
    private static $query;
    private static $mutation;

    private static $book;

    private static $bookMutation;

    private static $validationError;
    private static $validationErrorsList;
    private static $validationTypes;

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

    public static function book()
    {
        return self::$book ?: (self::$book = new BookType());
    }

    public static function bookMutation()
    {
        return self::$bookMutation ?: (self::$bookMutation = new BookMutationType());
    }

    public static function validationError()
    {
        return self::$validationError ?: (self::$validationError = new ValidationErrorType());
    }

    public static function validationErrorsList()
    {
        return self::$validationErrorsList ?: (self::$validationErrorsList = new ValidationErrorsListType());
    }

    public static function validationErrorsUnionType(ObjectType $type)
    {
        if (!isset(self::$validationTypes[$type->name . 'ValidationErrorsType'])) {
            self::$validationTypes[$type->name . 'ValidationErrorsType'] = new UnionType([
                'name' => $type->name . 'ValidationErrorsType',
                'types' => [
                    $type,
                    Types::validationErrorsList(),
                ],
                'resolveType' => function ($value) use ($type) {
                    if ($value instanceof Model) {
                        return $type;
                    } else {
                        return Types::validationErrorsList();
                    }
                }
            ]);
        }
        return self::$validationTypes[$type->name . 'ValidationErrorsType'];
    }
}
