<div class="search-bar">
    <form action="/{{$searchType}}" method="get">
        @php
            $inputID = "search-bar-" . $searchType;
        @endphp
        <label for="{{$inputID}}">Search by {{$searchType}}:</label>
        <input id="{{$inputID}}" type="text" name="term" placeholder="{{ucwords($searchType)}}" required>
        <input type="submit">
    </form>
</div>
