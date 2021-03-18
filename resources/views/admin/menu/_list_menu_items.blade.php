@foreach($menu_items as $item)
    {{--Если у элементов меню есть вложенные пункты--}}
    {{--{{ $item->name }} - {{ $item->children->count() }}<br/>--}}
    @if($item->children->count())
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                {{ $item->name }}
                <button class="js-more btn btn-primary" data-target="block_{{ $item->id }}">Открыть</button>
            </td>
            <td>{{ $item->url }}</td>
            <td>
                @include('admin.menu._action')
            </td>
        </tr>
        @include('admin.menu._list_menu_items', ['menu_items' => $item->children, 'is_child' => true])
    @else
        @isset($is_child)
            <tr class="block_{{ $item->parent_id }}" style="display: none">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    @include('admin.menu._action')
                </td>
            </tr>
            @continue
        @endisset

        @if($item->parent_id == 0)
            <tr >
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    @include('admin.menu._action')
                </td>
            </tr>
        @endif
    @endif
@endforeach

