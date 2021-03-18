@foreach($categories as $category)
    {{--Если у категорий есть вложенные категории--}}
    @if($category->children->count())
         <tr>
             <td>{{ $category->id }}</td>
             <td>
                {{ $category->title }}
                 <button class="js-more btn btn-primary" data-target="block_{{ $category->id }}">Открыть</button>
             </td>
             <td>{{ $category->slug }}</td>
             <td>
                <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                   class="btn btn-info btn-sm float-left mr-1">
                    <i class="fas fa-pencil-alt"></i>
                </a>

                <form
                    action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                    method="post" class="float-left">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Подтвердите удаление')">
                        <i
                            class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @include('admin.categories._list_categories', ['categories' => $category->children, 'is_child' => true])
    @else
            @isset($is_child)
                <tr class="block_{{ $category->parent_id }}" style="display: none">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                           class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <form
                            action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                            method="post" class="float-left">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Подтвердите удаление')">
                                <i
                                    class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @continue
            @endisset

        @if($category->parent_id == 0)
            <tr >
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                       class="btn btn-info btn-sm float-left mr-1">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form
                        action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                        method="post" class="float-left">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Подтвердите удаление')">
                            <i
                                class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endif
@endforeach

