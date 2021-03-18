@foreach($menu_items as $menuItem)
    <option value="{{ $menuItem->id ?? '' }}"
        @isset($menu_item->id)
            @if($menu_item->parent_id == $menuItem->id)
                selected=''
            @endif
            @if($menu_item->id == $menuItem->id)
                disabled=''
            @endif
        @endisset
    >
        {{ $delimetr ?? ''}} {{ $menuItem->name ?? '' }}
    </option>
    {{-- Вызов рекурсии, если во вложенной категории есть также свои вложенные--}}
    @isset($menuItem->children)
        @include('admin.menu._list',[
            /* Передаем список только вложенных категорий в данную категорию */
            'menu_items' => $menuItem->children,
            'delimetr' => ' - ' . $delimetr
        ])
    @endisset
@endforeach
