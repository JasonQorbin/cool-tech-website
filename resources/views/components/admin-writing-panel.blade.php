<div>
    <form id="editor-form" class="vertical" action="/admin/articles/{{$articleToEdit->id}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="article-id" value="{{$articleToEdit->id}}">
        <span><button id="save-button" class="submit-button" type="submit" name="action" value="edit">Save Changes</button></span>

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
            {{-- Source: EasyMDE project on GitHub: https://github.com/Ionaru/easy-markdown-editor --}}
            const easyMDE = new EasyMDE({
                element: document.getElementById('article-content-editor')
            });
        </script>
    </form>
    {{-- This form is placed here because you can't have nested html forms.
    This is the form that responds to the Add Tag and Delete Tag buttons above--}}
    <form id="tag-update-form" action="/admin/articles/{{$articleToEdit->id}}" method="post">
        {{ csrf_field() }}
        {{-- This hiden input causes the correct controller function to be called to update the tags --}}
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="article-id" value="{{$articleToEdit->id}}">
    </form>
</div>
