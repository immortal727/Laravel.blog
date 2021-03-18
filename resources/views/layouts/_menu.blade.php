@foreach($categories as $category)
    {{--Есть ли вложенные категории--}}
    @if($category->children->count())
        <li class="">
            <a href="{{ url('category/'.$category->slug) }}">{{ $category->title ?? '' }}</a>
            <div class="uk-navbar-dropdown uk-border-rounded uk-background-muted">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                    @include('layouts._menu', ['categories' => $category->children, 'is_child' => true])
                </ul>
            </div>
        </li>
    @else
        {{--Показываем только вложенные, и цикл прерываем @continue, пока они не закончатся--}}
        @isset($is_child)
            <li class="uk-nav-header"><a class="" href="{{ url('category/'.$category->slug) }}">{{ $category->title ?? '' }}</a></li>
            @continue
        @endisset

        <li class=""><a href="{{ url('category/'.$category->slug) }}">{{ $category->title ?? '' }}</a></li>
    @endif
@endforeach

