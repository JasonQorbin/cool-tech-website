<div>
    <form id="editor-form" class="vertical" action="/admin/articles/{{$articleToEdit->id}}" method="post">
        {{ csrf_field() }}
        <span><input id="save-button" class="submit-button" type="submit" value="Save Changes"></span>

        <label for="article-title" class="bold-blue">Title:</label>
        <input class="title-input" type="text" name="article-title" id="article-title" value="{{$articleToEdit->title}}">

        <div class="side-by-side">
            <div class="left">
                <span><label>Category:</label></span>
                <span>
                    <select name="article-category" id="category-selector">
                        @foreach($allCategories as $category)
                            <option value="{{$category->name}}"
                                    @if($category->name == $articleToEdit->category_name)
                                        selected
                                    @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
            <div class="right">
                <div class="vertical">
                    <x-tag-list :article-id="$articleToEdit->id"/>
                    <div class="vertical">
                        <div>
                            <input type="submit" id="add-tag-button" name="add-tag" value="Add Tag" form="tag-update-form">
                            <input type="submit" id="delete-tag-button" name="delete-tag" value="Delete Tag"
                                   form="tag-update-form">
                        </div>
                        <label for="tag-selector">Tag:</label>
                        <select id="tag-selector" name="selected-tag" form="tag-update-form">
                            @foreach($allTags as $tag)
                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <label for="article-content-editor" class="bold-blue">Content:</label>
        <em>Note: This is a Markdown editor. Write your article or post in <a href="https://www.markdownguide.org/basic-syntax/">Markdown</a> format.</em>
        <textarea id="article-content-editor" name="article-content">{!! $articleToEdit->content !!}</textarea>
        <script>
            {{-- This script replaces the textarea above with a markdown editor  --}}

            const easyMDE = new EasyMDE({
                element: document.getElementById('article-content-editor')
            });
        </script>
    </form>
    <form id="tag-update-form" action="/admin/articles/{{$articleToEdit->id}}" method="post">
        {{ csrf_field() }}
    </form>
</div>
