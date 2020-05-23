<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Types\NodeType as Node;
use App\Relay\Types\ResourceSectionType;
use App\Relay\Support\PaginatedCollection;

use App\BibleChapter as BibleChapterModel;

class ResourceType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {
        return parent::__construct([
            'name' => 'Resource',
            'description' => 'A Resource',
            'fields' => [
          	    'id' => Relay::globalIdField(),
                'title' => ['type' => Type::string()],
                'author' => ['type' => Type::string()],
                'text' => ['type' => Type::string()],
                'sections' => [
                    'type' => GraphQLGenerator::resolveConnectionType($typeResolver, ResourceSectionType::class),
                      'args' => GraphQLGenerator::paginationArgs(),
                      'resolve' => function($root, $args, $resolveInfo){
                                return new PaginatedCollection($args, $root->sections());
                            },
                ]

            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }
}
