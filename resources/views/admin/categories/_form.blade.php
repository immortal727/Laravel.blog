    <div class="card-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror" id="title"
                   placeholder="Название"
                   value="{{ $category->title ?? '' }}">
        </div>
        <div class="form-group">
            <select name="parent_id" class="form-control">
                <option value="0">-- без родительской категории --</option>
                @include('admin.categories._categories')
            </select>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>


