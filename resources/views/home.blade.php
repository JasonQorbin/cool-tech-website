<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="content-wrap">
    <header>
        <div class="side-by-side">
            <div class="left"><h1>Cool Tech</h1></div>
            @auth
                <div class="right">
                    @if (Auth::user()->role != "user")
                        <a href="/admin">Admin Panel</a><span>|</span>
                    @endif
                    <a href="/logout">Logout</a>
                </div>
            @else
                <div class="right"><a href="/login">Login</a></div>
            @endauth
        </div>
        <p><em>The <span class="bold-blue">coolest</span> place to get the <span class="bold-blue">coolest</span> tech news</em></p>
        <div>
            <a href="/search" class="button">
                <span>search</span>
            </a>
        </div>
        <span class="divider"></span>
    </header>
    <div id="article-grid">
        @foreach($articles as $article)
            <div class="article-block">
                <h2 class="article-heading"><a href="/article/{{$article['id']}}">{{$article['title']}}</a></h2>
                {!! $article['firstPara'] !!}
            </div>
        @endforeach
    </div>
    <x-cookie-notice/>
    <x-page-footer/>
</div>
</body>
</html>
