<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Search</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<header>
    <h1>Search</h1>
    <x-home-button/>
    <span class="divider"></span>
</header>
<main>
    <x-search-bar search-type="article"/>
    <x-search-bar search-type="category"/>
    <x-search-bar search-type="tag"/>
</main>
<x-cookie-notice/>
<x-page-footer/>
</body>
</html>
