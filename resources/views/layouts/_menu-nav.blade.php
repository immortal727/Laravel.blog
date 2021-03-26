@foreach($items as $item)
    {{--Есть ли вложенные категории--}}
    @if($item->children->count())
        <li class="">
            <a href="{{ url($item->url) }}">{{ $item->name  ?? '' }}</a>
            <div class="uk-navbar-dropdown uk-border-rounded uk-background-muted">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    @include('layouts._menu-nav', ['items' => $item->children, 'is_child' => true])
                </ul>
            </div>
        </li>
    @else
        {{--Показываем только вложенные, и цикл прерываем @continue, пока они не закончатся--}}
        @isset($is_child)
            <li class="uk-nav-header"><a class="" href="{{ url($item->url) }}">{{ $item->name ?? '' }}</a></li>
            @continue
        @endisset

        <li class=""><a href="{{ url($item->url) }}">{{ $item->name ?? '' }}</a></li>
    @endif
@endforeach
