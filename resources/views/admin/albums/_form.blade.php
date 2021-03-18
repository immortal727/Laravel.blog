<div class="card-body">
    <div class="form-group">
        <label for="name">Имя альбома</label>
        <input name="name" type="text" class="form-control" placeholder="Album Name"
               value="{{ $album->name ?? old('name') }}">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea name="description" type="text" class="form-control"
                  placeholder="Album description">{{ $album->description ?? old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="cover_image">Выберите изображение для обложки</label>
        <div class="custom-file">
            <input type="file" name="cover_image" id="cover_image" class="custom-file-input">
            <label class="custom-file-label" for="image">{{ $album->cover_image ?? '' }}</label>
            {{--<label class="custom-file-label" for="exampleInputFile">Выбор файла</label>--}}
        </div>
        @if(!empty($album) && $album->cover_image)
            <div class="img-result">
                <img src="{{ $album->getImage() }}" alt="{{ $album->name }}" class="img-thumbnail mt-2" width="200">
            </div>
            <input type="hidden" name="old_image" id="old_image" value="{{ $album->cover_image ?? '' }}">
        @endif
    </div>
    <div class="form-group">
        <label>Выберите категорию, где будет показана галерея</label>
        <select name="cat_id" id="cat_id" class="form-control">
            <option value="0">-- без родительской категории --</option>
            @include('admin.categories._categories')
        </select>
    </div>

    @isset($posts)
    <div class="form-group">
        <label>Выберите статью(и), где будет показана галерея</label>
        <select multiple name="post_id" id="post_id" class="form-control">
            @include('admin.albums._listPosts')
        </select>
    </div>
    @endisset
</div>
<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>


