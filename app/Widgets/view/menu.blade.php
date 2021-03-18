@if($data)
    <div class="menu classic">
        <ul id="nav" class="menu">
            @foreach($data as $item)
                <li>
                    <a href="{{ $item->path }}">{{ $item->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
