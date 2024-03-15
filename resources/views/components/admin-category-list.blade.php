<div class="admin-article-list">
    <h2>Edit Categories</h2>
    <span class="divider"></span>
    <form action="/admin/categories" method="post">
        {{ csrf_field() }}
        <label for="new-category-field" >New Category:</label>
        <input id="new-category-field" type="text" name="new-category-name" placeholder="Category name">
        <button type="submit" class="button" name="action" value="add">Add Category</button>
    </form>
    <table class="admin-list-table">
        <tr>
            <th>Category</th>
            <th>Associated articles</th>
            <th></th>
        </tr>
        <tbody>
        @foreach($allCategories as $category)
            <tr>
                <td><a href="/categories/{{$category->name}}" class="button">{{$category->name}}</a></td>
                <td>{{$category->associations()}}</td>
                <td>
                    <form action="/admin/categories" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="category-to-delete" value="{{$category->name}}">
                        <button type="submit" class="button" name="action" value="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
