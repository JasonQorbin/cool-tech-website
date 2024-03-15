<div class="admin-article-list">
    <h2>Edit Articles</h2>
    <span class="divider"></span>
    <form action="/admin/articles" method="post">
        {{ csrf_field() }}
        <button class="button" type="submit" name="action" value="add">New Article</button>
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
            <td><a class="button" type="submit" href="/admin/articles/{{$article->id}}">Edit</a></td>
            <td>
                <form action="/admin/articles" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="article-id" value="{{$article->id}}">
                    <button class="button" type="submit" name="action" value="delete">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
</div>
