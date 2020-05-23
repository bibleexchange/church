<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Types\NodeType as Node;
use App\Relay\Types\BibleChapterType as BibleChapter;

use App\BibleBook as BibleBookModel;
use App\BibleChapter as BibleChapterModel;

class BibleBookType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

         $defaultArgs = GraphQLGenerator::defaultArgs();
	 $bibleChaptersConnectionType = GraphQLGenerator::connectionType($typeResolver, BibleVerseType::class);

        return parent::__construct([
            'name' => 'BibleBook',
            'description' => 'A book of the Holy Bible',
            'fields' => [
          		  'id' => Relay::globalIdField(),
                'title' => [
                    'type' => Type::string(),
                    'description' => 'Name of the Book of the Bible',
                ],
                'slug' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                't' => [
                    'type' => Type::string(),
                    'description' => 'Testament of the Book of the Bible.',
                ],
                'g' => [
                    'type' => Type::int(),
                    'description' => 'Genre ID of the book of the Bible',
                ],
                'chapterCount' => [
                    'type' => Type::int(),
                    'description' => 'The number of Chapters in this book of the Bible',
                ],
                'chapters' => [
                    'type' =>  $typeResolver->get($bibleChaptersConnectionType),
                    'description' => 'The chapters of this book of the Bible.',
                    'args' => $defaultArgs,
                    'resolve' => function($book, $args, $resolveInfo){
                        $chapters = $book->chapters()->orderBy('order_by')->get();
                        return $this->paginatedConnection($chapters, $args);
                    }
                  ]
            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }
}
