<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\StepType;
use App\Relay\Types\LessonType;
use App\Relay\Types\NoteCacheType;
use App\Relay\Types\OwnerType;
use App\Relay\Types\SimpleBibleVerseType;

use App\Note as NoteModel;

class NoteType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'Note',
            'description' => 'A note.',
            'fields' => [
                'id' => Relay::globalIdField(),
                'title' => ['type' => Type::string()],
                'tags' => ['type' => Type::listOf(Type::string())],
        		'tags_string' => ['type' => Type::string()],
        		'body' => ['type' => Type::string()],
        		'bible_verse_id' => ['type' => Type::int()],
        	   'created_at' => ['type' => Type::string()],
        	   'updated_at' => ['type' => Type::string()],
        	   'output' => ['type' => $typeResolver->get(NoteCacheType::class)],
       		   'verse' => ['type' => $typeResolver->get(SimpleBibleVerseType::class)],
       		   'author' => ['type' => $typeResolver->get(OwnerType::class)]
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
