<li><a href="{{route('home')}}"><span class='fa fa-home'></span> Home</a></li>
<li{{ (Request::is('user/study*') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/study-maker') }}}"><span class="fa fa-book"></span> Study Maker ({!!$currentUser->lessons()->count()!!})</a></li>
<li{{ (Request::is('user/course*') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/course-maker') }}}"><span class="fa fa-book"></span> Course Maker ({!!$currentUser->courses()->count()!!})</a></li>
<li{{ (Request::is('user/notes*') ? ' class="active"' : '') }}><a href="{{{ URL::to('/user/notes') }}}"><span class="fa fa-bullhorn"></span> Bible Notes ({!!$currentUser->notes()->count()!!})</a></li>
<li><a href="{{route('profile_path',$currentUser->nickname)}}"><span class='fa fa-eye-open'></span> Public Profile</a></li>
<li{{ (Request::is('/user/bookmarks*') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/bookmarks') }}}"><span class="fa fa-bookmark"></span> Bookmarks ({!!$currentUser->bookmarks()->count()!!})</a></li>
<li{{ (Request::is('/user/notifications*') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/notifications') }}}"><span class="fa fa-bell"></span> Notifications ({!!$unReadNotifications->count()!!})</a></li>
<li{{ (Request::is('/user/settings') ? ' class="active"' : '') }}><a href="{{{ URL::to('/home/settings') }}}"><span class="fa fa-cog"></span> Settings</a></li>