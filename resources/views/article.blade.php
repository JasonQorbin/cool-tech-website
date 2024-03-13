<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$article->title}} | Cool Tech</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="content-wrap">
    <header>
        <x-home-button/>
        <h1>{{$article->title}}</h1>
        <div class="side-by-side">
            <div class="left">
                <span class="post-date">Posted on: {{date('Y-m-d', strtotime($article->creation_date))}}</span>
            </div>
            <div class="right">
                <a href="/category/{{getSlugFromName($article->category_name)}}" class="category-button button">
                    <span>{{$article->category_name}}</span>
                </a>
            </div>
        </div>
        <x-tag-list :article-id="$article->id"/>
        <span class="divider"></span>
    </header>
    <main>
        @php
            $Parsedown = new Parsedown();
            $htmlContent = $Parsedown->text($article->content);
        @endphp
        {!! $htmlContent !!}
    </main>
    <x-cookie-notice/>
    <x-page-footer/>
</div>
</body>
</html>
