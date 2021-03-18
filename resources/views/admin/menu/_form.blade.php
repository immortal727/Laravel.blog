    <div class="card-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="Название"
                   value="{{ $menu_item->name ?? '' }}"
                   required >
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_id">Уровень вложенности</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0">-- без вложений --</option>
                @include('admin.menu._list')
            </select>
        </div>
        <div class="form-group">
            <label for="type">Тип пункта меню</label>
            <div class="row" id="initialized">
                <div class="col-sm-3">
                    <select class="form-control" name="type" id="type">
                        @if(isset($menu_item['type']))
                            @switch($menu_item['type'])
                                @case('page_link')
                                     <option value="page_link">Статья</option>
                                    @break
                                @case('category_link')
                                     <option value="category_link">Категория</option>
                                    @break
                                @case('external_link')
                                    <option value="external_link">Внешняя сылка</option>
                                    @break
                            @endswitch
                        @else
                            <option value="page_link">Статья</option>
                            <option value="category_link">Категория</option>
                            <option value="external_link">Внешняя сылка</option>
                        @endif
                    </select>
                </div>
                <div class="col-sm-9">
                    @if(isset($menu_item['type']))
                        @switch($menu_item['type'])
                            @case('page_link')
                                <div class="page_or_link_value page_or_link_page">
                                    <select name="post_id" id="post_id" class="form-control">
                                        <option value="0">-- без прикрепления к статье --</option>
                                        @include('admin.menu._list_posts')
                                    </select>
                                </div>
                                @break
                            @case('category_link')
                                <div class="page_or_link_value page_or_link_category_link">
                                    <select name="category_id" id="category_id"  class="form-control">
                                        <option value="0">-- без прикрепления к категории --</option>
                                        @include('admin.menu._categories')
                                    </select>
                                </div>
                                @break
                            @case('external_link')
                                <div class="page_or_link_value page_or_link_external_link">
                                    <input type="url" class="form-control" name="external_link" id="external_link"
                                           placeholder="http://example.com/your-desired-page" disabled="disabled">
                                </div>
                                @break
                        @endswitch
                    @else
                        <div class="page_or_link_value page_or_link_page">
                            <select name="post_id" class="form-control">
                                <option value="0">-- без прикрепления к статье --</option>
                                @include('admin.menu._list_posts')
                            </select>
                        </div>
                        <div class="page_or_link_value page_or_link_category_link d-none">
                            <select name="category_id" class="form-control">
                                <option value="0">-- без прикрепления к категории --</option>
                                @include('admin.menu._categories')
                            </select>
                        </div>
                        <div class="page_or_link_value page_or_link_external_link d-none">
                            <input type="url" class="form-control" name="external_link" id="external_link"
                                   placeholder="http://example.com/your-desired-page" disabled="disabled">
                        </div>
                    @endif
                </div>
            </div>
            @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <fieldset id="home" class="btn-group btn-group-yesno radio">
                <label for="home1" class="btn active" data-class="btn-success">
                    Да
                    <input type="radio" name="home" id="home1" value="1" >
                </label>
                <label for="home0" class="btn btn-danger" checked="checked" data-class="btn-danger">
                    Нет
                    <input type="radio" name="home" id="home0" value="0">
                </label>
            </fieldset>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>


