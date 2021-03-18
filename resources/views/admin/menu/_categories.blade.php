@foreach($categories as $categoryItem)
    <option value="{{ $categoryItem->id ?? '' }}"
        @isset($menu_item->id)
            @if($menu_item->category_id == $categoryItem->id)
                selected=''
            @endif
            {{--@if($category->id == $categoryItem->id)
                disabled=''
            @endif--}}
        @endisset
    >
        {{ $delimetr ?? ''}} {{ $categoryItem->title ?? '' }}
    </option>
    {{-- Вызов рекурсии, если во вложенной категории есть также свои вложенные--}}
    @isset($categoryItem->children)
        @include('admin.menu._categories',[
            /* Передаем список только вложенных категорий в данную категорию */
            'categories' => $categoryItem->children,
            'delimetr' => ' - ' . $delimetr
        ])
    @endisset
@endforeach
