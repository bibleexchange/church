<meta charset="utf-8" />
<!--60 to 70 Characters-->
<title>{{ $page->title ?? '' }} | Bible exchange</title>

<meta name="keywords" content="{{ $page->tags ?? 'bible, christian, study, learn, religion' }}" />
<meta name="author" content="{{ $page->author->name['profile'] ?? ' Bible exchange' }}" />
<meta name="description" content="{{ $page->description ?? 'Bible exchange is your place for bible studies and conversation. Equip yourself to better know and share your faith in Jesus Christ by using our social Bible.' }}" />

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $page->title ?? '' }} | Bible exchange">
<meta itemprop="description" content="{{ $page->description ?? 'Bible exchange is your place for bible studies and conversation. Equip yourself to better know and share your faith in Jesus Christ by using our social Bible.' }}">
<meta itemprop="image" content="{{ $page->mainImage->src ?? url('/images/be_logo.png') }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@bible_exchange">
<meta name="twitter:title" content="{{ $page->title ?? 'Bible exchange' }}">
<meta name="twitter:description" content="{{ $page->description ?? '' }}">
<meta name="twitter:creator" content="{{ $page->contact['twitter']  ?? '@bible_exchange' }}">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{{ $page->mainImage->src ?? 'http://bible.exchange/images/be_logo.png' }}">		

<!-- Open Graph data -->
<meta property="og:title" content="{{ $page->title ?? '' }} | Bible exchange" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ $page->website ?? 'http://bible.exchange' }}" />
<meta property="og:image" content="{{ $page->mainImage->src ?? 'http://bible.exchange/images/be_logo.png' }}" />
<meta property="og:description" content="{{ $page->description ?? 'Bible exchange is your companion in discovery. Equip yourself to better know and share your faith in Jesus Christ by engaging in Biblical conversation.' }}" />
<meta property="og:site_name" content="Bible exchange" />
<meta property="article:author" content="{{ $page->author->name['profile'] ?? '' }}" />
<meta property="article:published_time" content="{{ $page->created_at ?? '' }}" />
<meta property="article:modified_time" content="{{ $page->updated_at ?? '' }}" />
<meta property="article:section" content="{{ $page->section ?? 'Bible exchange' }}" />
<meta property="article:tag" content="{{ $page->tags ?? 'bible, christian, study, learn, religion' }}" />
<meta property="fb:app_id" content="{{ Config::get('services.facebookAppId') }}"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1">
