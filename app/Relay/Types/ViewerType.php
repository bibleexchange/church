<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\BibleType;
use App\Relay\Types\BibleBookType;
use App\Relay\Types\BibleChapterType;
use App\Relay\Types\BibleVerseType;
use App\Relay\Types\BibleVersionType;
use App\Relay\Types\CourseType;
use App\Relay\Types\CrossReferenceType;
use App\Relay\Types\LibraryType;
use App\Relay\Types\NoteType;
use App\Relay\Types\ResourceType;
use App\Relay\Types\StepType;
use App\Relay\Types\TrackType;
use App\Relay\Types\UserTrackType;
use App\Relay\Types\NavHistoryType as NavigationType;

use App\Relay\Types\UserType;
use App\Relay\Types\UserCourseType;
use App\Relay\Types\UserNoteType;
use App\Relay\Types\UserLessonType;

use App\Relay\Types\ErrorType;
use App\Relay\Types\SimpleNoteType;
use App\Relay\Types\SearchType;

use App\Bible;
use App\BibleBook;
use App\BibleChapter;
use App\BibleVerse;
use App\Library;
use App\Course;
use App\CrossReference;
use App\Lesson;
use App\Resource;
use App\Step;
use App\Note;
use App\Search;
use App\Track;
use App\User;
use App\Viewer;

use ArrayObject;

class OneAndMany {

    public static function many($typeResolver, $model){
       return [
                    'type' => GraphQLGenerator::resolveConnectionType($typeResolver, $model[2]),
                    'description' => 'A Collection of ' . ucfirst($model[1]) . ' on Bible exchange.',
                    'args' => GraphQLGenerator::paginationArgs(),
                    'resolve' => function($root, $args, $resolveInfo) use ($model){
                        return $root->many($args,$model);
                    },
              ];
    }

    public static function one($typeResolver, $model){
       return [
            'type' => $typeResolver->get( $model[2]),
            'description' => ucfirst($model[0]) . ' on Bible exchange.',
            'args' => GraphQLGenerator::defaultArgs(),
            'resolve' => function($root, $args, $resolveInfo) use ($model){

                

                 if($model[0] !== "bibleChapter") {
                    return $root->one($args,$model);
                  }else{

                    $chapter = $root->one($args,$model);

                    if($chapter !== null){
                      return $chapter;
                    }else{
                      $verses = BibleVerse::where('body','LIKE','%'.$args['id'].'%');
                      $chapter = new BibleChapter;
                      $chapter->verses = $verses;
                      return $chapter; 
                    }

       
                  }
            },
      ];
    }

}

class ViewerType extends ObjectType {

  public function __construct(TypeResolver $typeResolver)
    {

    // SingularFieldName, PluralFieldName, TypeForResolver, ORMName, Model, isUserContext?
    $models = [
      ['note','notes',NoteType::class, 'notes', Note::class],
      ['bible','bibles',BibleType::class, 'bibles', Bible::class],
      ['bibleBook','bibleBooks',BibleBookType::class, 'bibleBooks', BibleBook::class],
      ['bibleChapter','bibleChapters',BibleChapterType::class, 'bibleChapters', BibleChapter::class],
      ['bibleVerse','bibleVerses',BibleVerseType::class, 'bibleVerses', BibleVerse::class],
      ['cossReference','crossReferences',CrossReferenceType::class, 'crossReferences', CrossReference::class],
      ['library','libraries',LibraryType::class, 'libraries', Library::class],
      ['course','courses',CourseType::class, 'courses', Course::class],
      ['lesson','lessons',LessonType::class, 'lessons', Lesson::class],
      ['step','steps',StepType::class, 'steps', Step::class],
      ['user','users',UserType::class, 'users', User::class],
      ['userNavigation','userNavigations',NavigationType::class, 'navigations',true],
      ['userNote','userNotes', UserNoteType::class, 'notes', Note::class, true],
      ['userCourse','userCourses', UserCourseType::class, 'courses', Course::class, true],
      ['userLesson','userLessons', UserLessonType::class, 'lessons', Lesson::class, true],
      ['userTrack','userTracks', TrackType::class, 'tracks', Track::class, true],
      ['resource','resources', ResourceType::class, 'resources', Resource::class],
    ];

    $basic_models = [];

    foreach($models AS $model){
      $basic_models[$model[0]] = OneAndMany::one($typeResolver, $model);
      $basic_models[$model[1]] = OneAndMany::many($typeResolver, $model);
    }

        return parent::__construct([
            'name' => 'Viewer',
            'description' => '',
            'fields' => array_merge( $basic_models,
              [
              'error' => ['type' =>  $typeResolver->get(ErrorType::class)],
              'id' => ['type' => Type::string()],
              'name' => ['type' => Type::string()],
              'email' => ['type' => Type::string()],
              'verified' => ['type' => Type::string()],
              'role' => ['type' => Type::int()],
              'password' => ['type' => Type::string()],
              'remember_token' => ['type' => Type::string()],
              'nickname' => ['type' => Type::string()],
              'url' => ['type' => Type::string()],
              'lang' => ['type' => Type::string()],
              'lastStep' => ['type' => Type::string()],
              'authenticated' => ['type' =>Type::boolean()]
          ]),
           'interfaces' => []
        ]);
    }

}
