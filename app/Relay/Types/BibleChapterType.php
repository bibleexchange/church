<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Types\NodeType as Node;
use App\Relay\Types\BibleVerseType;
use App\Relay\Types\NoteType;
use App\Relay\Support\PaginatedCollection;

use App\BibleChapter as BibleChapterModel;

class BibleChapterType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {
        return parent::__construct([
            'name' => 'BibleChapter',
            'description' => 'A chapter of a book of the Holy Bible',
            'fields' => [
          	'id' => Relay::globalIdField(),
                'bible_book_id' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
                'verseCount' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
                'order_by' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
                'reference' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'referenceSlug' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'url' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'nextChapter' => [
                    'type' => $typeResolver->get(BibleChapterType::class),
                    'description' => '',
                ],
                'previousChapter' => [
                    'type' => $typeResolver->get(BibleChapterType::class),
                    'description' => '',
                ],
                'verses' => [
                    'type' =>  GraphQLGenerator::resolveConnectionType($typeResolver, BibleVerseType::class),
                    'description' => 'The verses of this chapter of the Bible.',
                    'args' =>  GraphQLGenerator::paginationArgs(),
                    'resolve' => function($root, $args, $resolveInfo){
                        return new PaginatedCollection($args, $root->verses());
                      }
                ]
                ,
                'notes' => [
                    'type' => GraphQLGenerator::resolveConnectionType($typeResolver, NoteType::class),
                      'description' => 'Notes Application Wide.',
                      'args' => GraphQLGenerator::paginationArgs(),
                      'resolve' => function($root, $args, $resolveInfo){
                                return new PaginatedCollection($args, $root->notes());
                            },
                ]

            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }
}
