<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;
use App\Relay\Models\StarWarsData;

use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;

use App\Relay\Types\BibleType as Bible;
use App\Relay\Types\BibleVersionType as BibleVersion;
use App\Relay\Types\BibleBookType as BibleBook;
use App\Relay\Types\BibleChapterType as BibleChapter;
use App\Relay\Types\BibleVerseType as BibleVerse;
use App\Relay\Types\LibraryType as Library;
use App\Relay\Types\CourseType as Course;
use App\Relay\Types\LessonType as Lesson;
use App\Relay\Types\StepType as Step;
use App\Relay\Types\NoteType as Note;
use App\Relay\Types\UserType as User;
use App\Relay\Types\ViewerType as Viewer;

class NodeType extends InterfaceType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

      $this->classnames = [
            'Bible'=> Bible::class,
            'BibleBook'=> BibleBook::class,
            'BibleChapter'=> BibleChapter::class,
            'BibleVerse'=> BibleVerse::class,
            'Library'=> Library::class,
            'Course'=> Course::class,
            'Lesson'=> Lesson::class,
            'Step'=> Step::class,
            'Note'=> Note::class,
            'User'=> User::class,
            'Viewer'=> Viewer::class,
          ];

      return parent::__construct([
          'name' => 'Node',
          'description' => 'An object with an ID',
          'fields' => [
              'id' => [
                  'type' => Type::nonNull(Type::id()),
                  'description' => 'The id of the object',
              ]
          ],
          'resolveType' => function($obj) use (&$typeResolver){
              return $typeResolver->get($this->classnames[$obj->relayType]);
          }
      ]);
    }
}
