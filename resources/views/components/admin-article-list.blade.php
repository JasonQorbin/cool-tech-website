<div class="admin-article-list">
    <form action="/admin/new-article" method="post">
        {{ csrf_field() }}
        <button class="button" type="submit">New Article</button>
    </form>
    <table class="admin-list-table">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Last Updated</th>
            <th>Created</th>
            <th></th>
            <th></th>
        </tr>
    @foreach($articles as $article)
        <tr>
            <td>{{$article->title}}</td>
            <td>{{$article->category_name}}</td>
            <td>{{$article->updated_at}}</td>
            <td>{{$article->created_at}}</td>
            <td><a href="/admin/articles/{{$article->id}}" class="button">Edit</a></td>
            <td><a class="button">Delete</a></td>
        </tr>
    @endforeach
    </table>
</div>
