<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Types\NodeType as Node;
use App\Relay\Support\PaginatedCollection;
use App\Relay\Types\CrossReferenceType;

use App\BibleChapter as BibleChapterModel;

class ResourceSectionType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {
      $crossReferenceConnectionType = GraphQLGenerator::connectionType($typeResolver, CrossReferenceType::class);

        return parent::__construct([
            'name' => 'ResourceSection',
            'description' => 'A Resource',
            'fields' => [
          	    'id' => Relay::globalIdField(),
                'text' => ['type' => Type::string()],
                'crossReferences' => [
                    'type' => $typeResolver->get($crossReferenceConnectionType),
                    'description' => 'crossReferences.',
                    'args' => GraphQLGenerator::defaultArgs(),
                    'resolve' => function($root, $args, $resolveInfo){
                            return new PaginatedCollection($args, $root->crossReferences());
                          },
                ],

            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }
}
