<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\ResultType;
use App\Relay\Types\BibleVerseType;
use stdClass;

class SearchType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

      	 //$resultsConnectionType = GraphQLGenerator::connectionType($typeResolver, ResultType::class);
         	 $bibleVersesConnectionType = GraphQLGenerator::connectionType($typeResolver, BibleVerseType::class);
        $defaultArgs = GraphQLGenerator::defaultArgs();

        return parent::__construct([
            'name' => 'Search',
            'description' => 'A search instance.',
            'fields' => [
                'term' => ['type' => Type::string()],

                'verses' => [
                    'type' =>  $typeResolver->get($bibleVersesConnectionType),
                    'description' => 'Bible verses related to the term(s) searched',
                    'args' => ['first' => ['type' => Type::int()], 'after' => ['type' => Type::string()] ],
                    'resolve' => function($root, $args, $resolveInfo){
/*
                        $fake = new stdClass;
                        $fake->pageInfo = new stdClass;
                        $fake->pageInfo->hasNextPage = true;
                        $fake->pageInfo->endCursor = "";
                        $fake->edges = [];

                        $node = new stdClass;
                        $node->node = new stdClass;
                        $node->node->id = 0;
                        $node->node->url =  $args['after'];
                        $node->node->body = $args['first'];

                        $fake->edges[0] = $node;
                        return $fake;
*/
                        return $this->paginatedConnection($root->verses($args), $args);
                      }
                ]

            ],
           'interfaces' => []
        ]);
    }

}
