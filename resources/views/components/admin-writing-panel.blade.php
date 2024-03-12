<div>
    <form class="vertical">
        <label for="article-title" class="bold-blue">Title:</label>
        <input class="title-input" type="text" name="article-title" id="article-title" value="{{$articleToEdit->title}}">
        <label for="article-content-editor" class="bold-blue">Content:</label>
        <textarea id="article-content-editor"></textarea>
        <script>

            const easeMDE = new EasyMDE();
            easeMDE.value("Hello");
        </script>
    </form>
</div>
