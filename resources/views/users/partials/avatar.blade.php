<a href="{!! route('profile_path', $user->nickname) !!}" class="avatar {{ $anchor_class ?? '' }}"><img 
	class="media-object {{ $image_class ?? '' }}" 
    src="{!! $user->gravatar(isset($size) ? $size : 30) !!}" 
    width="{!! isset($size) ? $size : 30 !!}" 
    alt="{!! $user->nickname !!}"></a>
