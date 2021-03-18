<div class="card-body">
    <div class="form-group">
        <label for="name">Название</label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror" id="name"
               placeholder="Название статьи" value="{{ $post->name ?? old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if($post)
        <div class="form-group">
            <label for="slug">Псевдоним (название url-a)</label>
            <input type="text" name="slug"
                   class="form-control @error('slug') is-invalid @enderror" id="slug"
                   placeholder="Название url-a" value="{{ $post->slug ?? old('slug') }}">
            @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small>Если вы хотите изменить url, то не забудьте сделать редирект в файле .htaccess со старого url на новый</small>
        </div>
    @endif
    <div class="form-group">
        <label for="category_id">Категория</label>
        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
            <option value="0">Выберите категорию</option>
            @foreach($categories as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title"
               class="form-control @error('title') is-invalid @enderror" id="title"
               placeholder="Для мета поля title" value="{{ $post->title ?? old('title') }}">
       {{-- @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror--}}
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Цитата ..." id="description" name="description">{{ $post->description ?? old('description')}}</textarea>
    </div>

    <div class="form-group">
        <label for="quote">Цитата</label>
        <textarea class="form-control @error('quote') is-invalid @enderror" rows="5" placeholder="Цитата ..." id="quote" name="quote">{{ $post->quote ?? old('quote')}}</textarea>
        @error('quote')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Контент</label>
        <textarea class="form-control @error('content') is-invalid @enderror" rows="5" placeholder="Контент ..." id="content" name="content">
            {{ $post->content ?? old('content') }}
        </textarea>
        @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="tags">Теги</label>
        <select name="tags[]" id="tags" class="select2" multiple="multiple"
                data-placeholder="Выбор тегов" style="width: 100%;">
            @foreach($tags as $k => $v)
                @if($post)
                    <option value="{{ $k }}" @if(in_array($k, $post->tags->pluck('id')->all())) selected @endif>{{ $v }}</option>
                @else
                    <option value="{{ $k }}">{{ $v }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="thumbnail">Изображение</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
                @if($post)
                    @if($post->thumbnail!=null)
                        <div class="btn btn-danger delete-file delete-image-button js-delete-image"
                             title="Удалить"
                             data-img="{{ $post->thumbnail }}"
                             data-route="{{ route('posts.deleteImage', ['post' => $post->id]) }}">
                            <div class="fa fa-trash"></div>
                        </div>
                        {{--<button id="del" class="delete-file" data-img="{{ $post->thumbnail }}"><i class="fas fa-times-circle"></i></button>--}}
                    @endif
                @endif
                <label class="custom-file-label" for="thumbnail">{{ $post->thumbnail ?? '' }}</label>
            </div>
        </div>
        @if($post)
            <div class="img-result"><img src="{{ $post->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></div>
        @endif
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
