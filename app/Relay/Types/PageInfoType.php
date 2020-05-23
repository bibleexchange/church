<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

class PageInfoType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {

        //$name = explode("\\", $nodeType);
//end($name) . 
        return parent::__construct([
           'name' => 'PagesInfo',
           'description' => "PageInfo for a connection",
           'fields' => [
                    'hasNextPage' => [
                        'type' => Type::nonNull(Type::boolean()),
                        'description' => 'When paginating forwards, are there more items?'
                    ],
                    'hasPreviousPage' => [
                        'type' => Type::nonNull(Type::boolean()),
                        'description' => 'When paginating backwards, are there more items?'
                    ],
                    'startCursor' => [
                        'type' => Type::string(),
                        'description' => 'When paginating backwards, the cursor to continue.'
                    ],
                    'perPage' => [
                        'type' => Type::int(),
                        'description' => 'When paginating forwards, the cursor to continue.'
                    ],
                    'currentPage' => [
                        'type' => Type::int(),
                        'description' => 'When paginating forwards, the cursor to continue.'
                    ],
                    'totalCount' => [
                        'type' => Type::int(),
                        'description' => 'When paginating forwards, the cursor to continue.'
                    ],
                    'totalPagesCount' => [
                        'type' => Type::int(),
                        'description' => 'When paginating forwards, the cursor to continue.'
                    ]

            ],
           'interfaces' => []
        ]);

    }

}