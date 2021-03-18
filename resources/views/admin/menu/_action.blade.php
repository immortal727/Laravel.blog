<a href="{{ route('menu.edit', ['menu' => $item->id]) }}"
   class="btn btn-info btn-sm float-left mr-1">
    <i class="fas fa-pencil-alt"></i>
</a>

<form
    action="{{ route('menu.destroy', ['menu' => $item->id]) }}"
    method="post" class="float-left">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm float-left mr-1"
            onclick="return confirm('Подтвердите удаление')">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>

<button type="submit" class="btn btn-info btn-sm active show_item" name="show_item"
        data-route="{{ route('menu.show', ['menu' => $item->id]) }}" data-live="{{ $item->live }}">
    @if($item->live)
        <i class="fas fa-eye"></i>
    @else
     <i class="fas fa-eye-slash"></i>
    @endif
    <div class="message"></div>
</button>
