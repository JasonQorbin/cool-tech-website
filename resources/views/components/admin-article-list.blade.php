<div class="admin-article-list">
    <div>
        <span class="block-button">New Article</span>
    </div>
    @foreach($articles as $article)
        <div class="admin-article-list-item side-by-side">
            <span class="admin-article-list-item-title left">{{$article->title}}</span>
            <div class="right">
                <a href="/admin/articles/{{$article->id}}" class="button">Edit</a>
                <span>|</span>
                <a class="button">Delete</a>
            </div>
        </div>
    @endforeach
</div>
