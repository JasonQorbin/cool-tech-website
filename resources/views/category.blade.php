<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Categories</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="content-wrap">
    <header>
        <x-home-button/>
        <h1>Category: {{$categoryName}}</h1>
        <span class="divider"></span>
    </header>
    <div id="tile-list">
        @foreach($articles as $article)
            <a href="/article/{{$article->id}}"><div class="article-tile"><h2>{{$article->title}}</h2></div></a>
        @endforeach

    </div>
    <x-cookie-notice/>
    <x-page-footer/>
</div>
</body>
</html>
