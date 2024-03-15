<div class="admin-article-list">
    <h2>Edit Tags</h2>
    <span class="divider"></span>
    <form action="/admin/tags" method="post">
        {{ csrf_field() }}

        <label for="new-tag-field" >New Tag:</label>
        <input id="new-tag-field" type="text" name="new-tag-name" placeholder="Tag name">
        <button type="submit" class="button" name="action" value="add">Add Tag</button>
    </form>
    <table class="admin-list-table">
        <tr>
            <th>Tag</th>
            <th>Associated articles</th>
            <th></th>
        </tr>
        <tbody>
        @foreach($allTags as $tag)
            <tr>
                <td><a href="/tag/{{$tag->name}}" class="button">{{$tag->name}}</a></td>
                <td>{{$tag->associations()}}</td>
                <td>
                    <form action="/admin/tags" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="tag-to-delete" value="{{$tag->name}}">
                        <button type="submit" class="button" name="action" value="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
