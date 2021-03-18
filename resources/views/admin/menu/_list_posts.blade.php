@foreach($posts as $postItem)
    <option value="{{ $postItem->id ?? '' }}"
        @isset($menu_item->id )
            {{--У данного пункта меню уже был выбран этот пост--}}
            @if($menu_item->post_id == $postItem->id)
                selected=''
            @endif
        @endisset
    >
         {{  $postItem->name ?? '' }}
    </option>
@endforeach
