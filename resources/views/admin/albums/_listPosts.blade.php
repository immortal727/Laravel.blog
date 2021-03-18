@foreach($posts as $postItem)
    <option value="{{ $postItem->id ?? '' }}"
       {{-- @if(!empty($album_post) && $album_post->post_id == $postItem->id)
            selected=''
        @endif
        @if($album->id == $postItem->id)
            disabled=''
            @endif--}}
    >
        {{ $postItem->name }}
       {{-- {{ $delimetr ?? ''}} {{ $categoryItem->title ?? '' }}--}}
    </option>
    {{-- Вызов рекурсии, если во вложенной категории есть также свои вложенные--}}
   {{-- @isset($categoryItem->children)
        @include('admin.categories._categories',[
            /* Передаем список только вложенных категорий в данную категорию */
            'categories' => $categoryItem->children,
            'delimetr' => ' - ' . $delimetr
        ])
    @endisset--}}
@endforeach
