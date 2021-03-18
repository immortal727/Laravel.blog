@foreach($albums as $album)
    <tr>
        <td>{{ $album->id }}</td>
        <td><img alt="{{$album->name}}" src="{{$album->getImage()}}" class="img-thumbnail mt-2" width="200"></td>
        <td><a href="{{ route('show_album', ['id' => $album->id]) }}" title="Показать альбом">{{ $album->name }}</a></td>
        <td>{{ $album->description }}</td>
        <td>{{ count($album->Photos) }}</td>
        <td>{{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</td>
        <td>
            <form
                action="{{ route('album_edit', ['id' => $album->id]) }}"
                method="post" class="float-left">
                @csrf
                <button type="submit" class="btn btn-info btn-sm float-left mr-1">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </form>
            <form
                action="{{ route('delete_album', ['id' => $album->id]) }}"
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
@endforeach
