<form id="multi_upload" method="POST" action="{{ route('add_images', ['id' => $album->id]) }}"
      enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="description">Описание изображения</label>
            <textarea class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Цитата ..." id="description" name="description">{{ $post->description ?? old('description')}}</textarea>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="multi_image" class="custom-file-input" id="multi_image" multiple="multiple">
                <label class="custom-file-label" for="multi_image"
                    data-route="{{ route('add_images', ['id' => $album->id]) }}">
                </label>
                <input type="submit" class="btn btn-primary mt-2" value="Загрузить файлы">
                <div id="status"></div>
            </div>
        </div>
        <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">
    </div>
</form>
