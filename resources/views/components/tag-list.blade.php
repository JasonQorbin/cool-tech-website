<div class="tag-list">
    <span>Tags: </span>
    @foreach($tags as $tag)
        <a href="/tag/{{getSlugFromName($tag->tag_name)}}" class="tag-button button">
            <span >{{$tag->tag_name}}</span>
        </a>
    @endforeach
</div>
