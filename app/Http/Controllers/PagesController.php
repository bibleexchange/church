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
		$page->title = "D.B.I. Spring Convention 2015";
			
		$mixlrs = [];
		
		$mixlrs[0] = new stdclass();
		$mixlrs[0]->link = 'http://mixlr.com/deliverance-center/showreel/deliverance-centers-mixlr-192/';
		$mixlrs[0]->download = 'https://mixlr-production.s3-eu-west-1.amazonaws.com/audio/affc6aa3190960fb9b83bfbc09e8c5f5/base.mp3?AWSAccessKeyId=AKIAIKPQ3T2LDPYYZPJQ&Expires=1432579968&Signature=ikb6fLM0H1i519g2SSjvbmKiI3k%3D&response-content-type=audio%2Fmpeg';
		$mixlrs[0]->date = 'Friday, May 22, 2015';
		$mixlrs[0]->title = '';
		$mixlrs[0]->preacher = 'Israel Ochoa';
		
		$mixlrs[1] = new stdclass();
		$mixlrs[1]->link = 'http://mixlr.com/deliverance-center/showreel/20150523a-saturday-morning-dbi-convention/';
		$mixlrs[1]->download = 'https://mixlr-production.s3-eu-west-1.amazonaws.com/audio/ee1a72c390ebf8bcad92d09bb3558268/base.mp3?AWSAccessKeyId=AKIAIKPQ3T2LDPYYZPJQ&Expires=1432581067&Signature=phDB4SWzmxyZG2zIp%2FchRARWi3g%3D&response-content-type=audio%2Fmpeg';
		$mixlrs[1]->date = 'Saturday Am, May 23, 2015';
		$mixlrs[1]->title = '';
		$mixlrs[1]->preacher = 'Nathan Davis';
		
		$mixlrs[2] = new stdclass();
		$mixlrs[2]->link = 'http://mixlr.com/deliverance-center/showreel/20150523p-saturday-evening-dbi-convention-2/';
		$mixlrs[2]->download = 'https://mixlr-production.s3-eu-west-1.amazonaws.com/audio/392c521868aa28bcdfafa74120c0a94f/base.mp3?AWSAccessKeyId=AKIAIKPQ3T2LDPYYZPJQ&Expires=1432581105&Signature=N7bW6CNQDvhs0Uij4SJ39DnE7Sw%3D&response-content-type=audio%2Fmpeg';
		$mixlrs[2]->date = 'Saturday Pm, May 23, 2015';
		$mixlrs[2]->title = 'The Power of a Second Glory';
		$mixlrs[2]->preacher = 'Israel Ochoa';
		
		$mixlrs[3] = new stdclass();
		$mixlrs[3]->link = 'http://mixlr.com/deliverance-center/showreel/20150524ss-sunday-school/';
		$mixlrs[3]->download = 'https://mixlr-production.s3-eu-west-1.amazonaws.com/audio/ccfdecee9e1e7727778fc5a491f6dfac/base.mp3?AWSAccessKeyId=AKIAIKPQ3T2LDPYYZPJQ&Expires=1432581155&Signature=MbZlFgUvfQxY05TSdLdCeUKw2XE%3D&response-content-type=audio%2Fmpeg';
		$mixlrs[3]->date = 'Sunday School, May 24, 2015';
		$mixlrs[3]->title = 'Truth in the Inward Parts, Part 7';
		$mixlrs[3]->preacher = 'Jerome Wadsworth';
		
		$mixlrs[4] = new stdclass();
		$mixlrs[4]->link = '';
		$mixlrs[4]->download = '';
		$mixlrs[4]->date = 'Sunday Am, May 24, 2015';
		$mixlrs[4]->title = '';
		$mixlrs[4]->preacher = 'Norman Lepage';
		
		$mixlrs[5] = new stdclass();
		$mixlrs[5]->download = '';
		$mixlrs[5]->link = '';
		$mixlrs[5]->date = 'Sunday Pm, May 24, 2015';
		$mixlrs[5]->title = 'The Field of God\'s Broken Dreams';
		$mixlrs[5]->preacher = 'Israel Ochoa';
		
		$mixlrs[6] = new stdclass();
		$mixlrs[6]->link = '';
		$mixlrs[6]->download = '';
		$mixlrs[6]->date = 'Monday Am, May 25, 2015';
		$mixlrs[6]->title = '';
		$mixlrs[6]->preacher = '';
		
		$mixlrs[7] = new stdclass();
		$mixlrs[7]->link = '';
		$mixlrs[7]->download = '';
		$mixlrs[7]->date = 'Monday Afternoon, May 25, 2015';
		$mixlrs[7]->title = '';
		$mixlrs[7]->preacher = 'Israel Ochoa';
		
		$mixlrs[8] = new stdclass();
		$mixlrs[8]->link = '';
		$mixlrs[8]->download = '';
		$mixlrs[8]->date = 'Monday Pm, May 25, 2015';
		$mixlrs[8]->title = '';
		$mixlrs[8]->preacher = 'Israel Ochoa';
		
		return view('pages.convention', compact('mixlrs','page'));
	}
	
}