<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\StepType;
use App\Relay\Types\LessonType;
use App\Relay\Types\NoteCacheType;
use App\Relay\Types\OwnerType;
use App\Relay\Types\SimpleBibleVerseType;

use App\Note as NoteModel;

class UserNoteType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

	$defaultArgs = GraphQLGenerator::defaultArgs();
	$lessonsConnectionType = GraphQLGenerator::connectionType($typeResolver, LessonType::class);
	$stepsConnectionType = GraphQLGenerator::connectionType($typeResolver, StepType::class);

        return parent::__construct([
            'name' => 'UserNote',
            'description' => 'A users note.',
            'fields' => [
                'id' => Relay::globalIdField(),
                'title' => ['type' => Type::string()],
                'tags' => ['type' => Type::listOf(Type::string())],
            		'tags_string' => ['type' => Type::string()],
            		'body' => ['type' => Type::string()],
            		'type' => ['type' => Type::string()],
            		'bible_verse_id' => ['type' => Type::int()],
            		'created_at' => ['type' => Type::string()],
            		'updated_at' => ['type' => Type::string()],
            		'output' => ['type' => $typeResolver->get(NoteCacheType::class),'description' => 'Processed body of note'],
            		'verse' => ['type' => $typeResolver->get(SimpleBibleVerseType::class)],

                    'author' => ['type' => $typeResolver->get(OwnerType::class),'description' => 'author of note'],

		    	'lessons' => [
		            'type' => $typeResolver->get($lessonsConnectionType),
		            'description' => 'The lessons of this note.',
		            'args' => $defaultArgs,
		            'resolve' => function($root, $args, $resolveInfo){
		                return $this->paginatedConnection($root->lessons()->orderBy('order_by')->get(), $args);
		            }
		        ],
		    	'steps' => [
		            'type' => $typeResolver->get($stepsConnectionType),
		            'description' => 'The steps of this note.',
		            'args' => $defaultArgs,
		            'resolve' => function($root, $args, $resolveInfo){
		                return $this->paginatedConnection($root->steps()->orderBy('order_by')->get(), $args);
		            }
		        ],
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
