<div class="card-body">
    <div class="form-group">
        <label for="name">Название</label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror" id="name"
               placeholder="Название слайда" value="{{ $slide->name ?? old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{--<div class="form-group">
        <label for="category_id">Категория</label>
        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
            @foreach($categories as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>--}}

    <div class="form-check col-5 col-sm-3 col-xl-2 mb-2">
        <input type="checkbox" class="form-check-input" id="show" name="show" value="1"
            @isset($slide->active )
            {{ $slide->active ? "checked" : ""}}
            @endisset
        >
        <label class="form-check-label" for="show">Показать/нет</label>
      {{--  <input type="hidden" name="show" value="0">--}}
    </div>
    <div class="form-group col-5 col-sm-3 col-xl-2 ">
        <label>Номер по порядоку</label>
        <select class="form-control" name="weight" id="weight">
            @isset($slide->weight)
                <option value="{{ $slide->weight }}" selected="">
                    {{ $slide->weight }}
                </option>
                @for ($i = 0 ; $i <= $max_order + 1 ; $i++)
                    @if( $slide->weight!=$i){
                      <option value="{{ $i }}"> {{ $i }} </option>
                    }
                    @endif
                @endfor
            @else
                @for ($i = 0; $i <= $max_order + 1; $i++)
                    <option value="{{ $i }}"> {{ $i }} </option>
                @endfor
            @endisset

        </select>
    </div>

    <div class="form-group">
        <label for="thumbnail">Изображение</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="image">
                <label class="custom-file-label" for="image">{{ $slide->image ?? '' }}</label>
            </div>
        </div>
        @if($slide)
            <div class="img-result"><img src="{{ $slide->getSlider() }}" alt="" class="img-thumbnail mt-2" width="200"></div>
            <input type="hidden" name="slide_img" id="slide_img" value="{{ $slide->image ?? '' }}">
        @endif
    </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
