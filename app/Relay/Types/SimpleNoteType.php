<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\NoteCacheType;
use App\Relay\Types\SimpleBibleVerseType;

use App\Note as NoteModel;

class SimpleNoteType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

	$defaultArgs = GraphQLGenerator::defaultArgs();

        return parent::__construct([
            'name' => 'SimpleNote',
            'description' => 'A note.',
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
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
