@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Альбом "{{ $album->name }}"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $album->name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Пока данных альбома -->
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <img class="media-object pull-left" alt="{{$album->name}}"
                                     src="{{$album->getImage()}}"
                                     style="width:inherit;">
                            </div>
                            <div class="col-7">
                                <div class="mb-3">
                                    <a href="{{ route('create_album_form') }}" class="btn btn-primary mb-2">Добавить
                                        альбом</a><br/>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                        Загрузка нескольких фото в альбом
                                    </button>
                                </div>
                                <div>
                                    {{$album->description}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Показ изображений в альбоме-->
                    <div class="row">
                        @foreach($album->Photos as $photo)
                            <div class="col-lg-3">
                                <div class="thumbnail" style="max-height: 350px;min-height: 350px;">
                                    <img alt="{{$photo->name}}"
                                         src="{{ url('images/albums/'.$album->id.'/'.$photo->image) }}"
                                         class="img-thumbnail mt-2" width="200">
                                    <div class="caption">
                                        <p>{{$photo->description}}</p>
                                        <time>Дата публикации:<br/>
                                            {{ date("d F Y",strtotime($photo->created_at)) }}
                                            at {{ date("g:ha",strtotime($photo->created_at)) }}</time>
                                    </div>
                                    <div>
                                        <form
                                            action="{{ route('delete_image', ['id' => $photo->id]) }}"
                                            method="post" class="float-left">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Удалить фото?')" title="Удалить фото">
                                                <i
                                                    class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>  <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Загрузка нескольких фото в альбом
                    </button>
                </div>  <!-- /.card-footer -->
            </div> <!-- /.card -->
        </div>

        <!-- Модальное окно для загрузки файлов-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Загрузка файлов</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('admin.albums._uploadImages')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.js-more').on('click', function (e) {
                e.preventDefault(); // не отправить пользователя на url
                let wrapper = $(this).closest('tr'); // Для каждого элемента в наборе,
                // получает первый элемент, который совпадает с селектором
                // при движении вверху по DOM дереву элементов.
                $('.' + $(this).data('target')).fadeToggle('slow');
                wrapper.toggleClass('active');
            });
        })
    </script>

    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>

    <script src="{{ asset('assets/admin/js/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>

    <script>
        $(document).ready(function () {
            let form = $('#multi_upload');
            form.on('submit', function (e) {
                e.preventDefault();
                let rout = $(this).parent().find('.custom-file-label').data('route'),
                    message = $('#status'),
                    formData = new FormData();
                if ($('#multi_image')[0].files.length != 0) {
                    $.each($('#multi_image')[0].files, function (i, file) {
                        formData.append("file[" + i + "]", file);
                        formData.append('description', $('#description').val());
                        formData.append('album_id', $('#album_id').val());
                        formData.append('_token', '{{ csrf_token() }}');
                    });
                } else {
                    message.html('Файл не выбран');
                    return false;
                }
                $.ajax({
                    url: rout,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    cache: false, // отключаем кэш
                    contentType: false,
                    processData: false,
                    beforeSend: function () { // Запрос начат
                        // Обезапасим от лишнего кликанья по инпутам
                        form.find('input').prop('disabled', true);
                    },
                    success: function (data) {
                        if (data.status == 'ok') {
                            message.text('Файлы загружены');
                            $('#multi_image').val('');
                        } else {
                            message.text('С загрузкой что-то не так');
                        }
                    },
                    complete: function () { // Запрос закончен
                        form.find('input').prop('disabled', false);
                    }
                })
                return false;
            });
        });
    </script>
@endsection

