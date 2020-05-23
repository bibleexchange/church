<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Types\BibleBookType as BibleBook;
use App\Relay\Types\NoteType as Note;
use App\Relay\Types\BibleChapterType as BibleChapter;
use App\Relay\Types\NodeType as Node;
use App\BibleVerse as BibleVerseModel;
use App\Note as BibleNoteModel;

class SimpleBibleVerseType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'SimpleBibleVerse',
            'description' => 'A verse of the Holy Bible',
            'fields' => [
          	'id' => Relay::globalIdField(),
                'bookNumber' => ['type' => Type::int(),'description' => 'book order by'],
                'chapterNumber' => ['type' => Type::int(),'description' => 'chapter order by'],
                'verseNumber' => ['type' => Type::int(),'description' => 'verse order by'],
                'body' => [
                    'type' => Type::string(),
                    'description' => 'text of the verse',
                ],
                'biblechapter_id' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
                'bible_version_id' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
                'chapterURL' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'reference' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'url' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'quote' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'notesCount' => [
                    'type' => Type::int(),
                    'description' => '',
                ],
            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }

}
