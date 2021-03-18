<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto" id="mainMenu">
    {{--function buildMenu($menuitems, $level = 0){
        foreach ($menuitems as $item) {
            if (isset($item->children)) {
                buildMenu($item, $level + 1);
                } else {
                echo str_repeat('--', $level) . $item . '\n';
            }
        }
    }--}}
    @php
        function buildMenu($items, $parent)
        {
            foreach ($items as $item) {
                if (isset($item->children)) {
    @endphp
    <li class="nav-item">
        <a href="{{ $item->url }}"
           class="nav-link"
           id="hasSub-{{ $item->id }}"
           data-toggle="collapse"
           data-target="#subnav-{{ $item->id }}"
           aria-controls="subnav-{{ $item->id }}"
           aria-expanded="false"
        >
            {{ $item->name }}
        </a>
        <ul class="navbar-collapse collapse"
            id="subnav-{{ $item->id }}"
            data-parent="#{{ $parent }}"
            aria-labelledby="hasSub-{{ $item->id }}"
        >
            @php buildMenu($item->children, 'subnav-'.$item->id) @endphp
        </ul>
    </li>
    @php
        } else {
    @endphp
    <li class="nav-item">
        <a href="{{ $item->url }}" class="nav-link">{{ $item->name }}</a>
    </li>
    @php
        }
    }
}

buildMenu($menuitems, 'mainMenu')
    @endphp
</ul>
