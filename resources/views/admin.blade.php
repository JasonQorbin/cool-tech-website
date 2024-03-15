<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Admin panel</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

</head>
<body>
<header>
    <div class="side-by-side">
        <div class="left">
            <h1>Admin Panel</h1>
        </div>
        <div class="right">
            <x-home-button/>
        </div>
    </div>
    <span class="divider"></span>
</header>
<div class="admin-area-layout">
    <div class="side-bar-container">
        <nav class="vertical side-bar">
            <a class="button" href="/admin/articles">Articles</a>
            <a class="button" href="/admin/articles">Categories</a>
            <a class="button" href="/admin/tags">Tags</a>
            <a class="button" href="/admin/users">Users</a>
        </nav>
    </div>
    <main class="admin-panel-content">
        @if($mode != null && $mode == 'articles')
            @if($id == null)
                <x-admin-article-list :articles="$allArticles"/>
            @else
                <x-admin-writing-panel :articleToEdit="$articleToEdit" :allCategories="$allCategories" :allTags="$allTags"/>
            @endif
        @elseif($mode == "tags")
            <x-admin-tag-list :allTags="$allTags"/>
        @elseif($mode == "categories")
            <x-admin-category-list :categories="$categories"/>
        @endif
    </main>
</div>
</body>
</html>
