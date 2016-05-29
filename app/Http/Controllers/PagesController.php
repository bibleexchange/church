<?php namespace Deliverance\Http\Controllers;

use Deliverance\Entities\Contact;
use Deliverance\Entities\Audio;
use \stdClass;

class PagesController extends Controller {

	public function __construct()
	{

	}

	public function home()
	{

		$t = [
				['title'=>'Every word of the Bible was given by God.','more-info'=>''],
				['title'=>'In the absolute Trinity of the eternal Godhead-Father, Son and Holy Ghost.','more-info'=>''],
				['title'=>'In the pre-existence and deity of our Lord Jesus Christ.','more-info'=>''],
				['title'=>'Jesus suffered and died as a substitue for everyone that believes and repents of their sin.','more-info'=>''],
				['title'=>'In complete salvation by grace through faith.','more-info'=>''],
				['title'=>'In the life of holiness without which no man shall see the Lord.','more-info'=>''],
				['title'=>'In Water Baptism by immersion.','more-info'=>''],
				['title'=>'In the observance of the Lord&apos;s Supper.','more-info'=>''],
				['title'=>'In tithing as God&apos;s financial plan for the church.','more-info'=>''],
				['title'=>'In the Bible revelation of Divine healing.','more-info'=>''],
				['title'=>'In the personal Baptism of the Holy Spirit as received by the Apostles.','more-info'=>''],
				['title'=>'In the gifts of the Holy Spirit.','more-info'=>''],
				['title'=>'In the Church, which is the Body of Christ composed of Spirit-filled Believers.','more-info'=>''],
				['title'=>'In a five-fold ministry to the Church for the perfecting of the Saints.','more-info'=>''],
				['title'=>'In the Bride of Christ which is Composed of Overcomers out of the Body of the Church.','more-info'=>''],
				['title'=>'In the personal and imminent return of our Lord.','more-info'=>''],
				['title'=>'In the everlasting punishment of those who reject God&apos;s plan of salvation.','more-info'=>''],
				['title'=>'In eternal life for all true Believers.','more-info'=>'']
		];
		
		return view('pages.home',compact('t'));
	}
	
	public function live()
	{
		return view('pages.live');
	}
	
	public function archives()
	{
		
		$pageTitle = 'Sermon Audio | Deliverance Center';		
		
		return view('pages.archives',compact('pageTitle'));
	}
	
	public function news()
	{		
		return view('pages.news');
	}
	
	public function nav()
	{		
		return view('pages.nav');
	}
	
	public function spr15()
	{	
		
		$page = new stdClass();
		$page->title = "Fellowship &amp; Spring Convention 2016";
		
		return view('pages.convention', compact('page'));
	}
	
}