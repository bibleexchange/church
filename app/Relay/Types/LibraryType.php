<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Models\StarWarsData;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\Definition\RelayType;

use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\CourseType as Course;
use App\Relay\Types\NodeType as Node;

use App\Library AS LibraryModel;
use GraphQLRelay\Relay;

class LibraryType extends  ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

	$coursesConnectionType = GraphQLGenerator::connectionType($typeResolver, CourseType::class);
 	$defaultArgs = array_merge(Relay::connectionArgs(), ['filter' => ['type' => Type::string()], 'id' => ['type' => Type::string()] ]);

        return parent::__construct([
            'name' => 'Library',
            'description' => 'A library',
            'fields' => [
		            'id' => Relay::globalIdField(),
                'title' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'description' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'created_at' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'updated_at' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
		'courses' => [
                    'type' =>  $typeResolver->get($coursesConnectionType),
                    'description' => 'The courses of the Library.',
                    'args' => $defaultArgs,
                    'resolve' => function($root, $args){
                      return $this->paginatedConnection($root->courses()->where('public',1)->get(), $args);
                     }
                ]
	     ],
            'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }
 }
