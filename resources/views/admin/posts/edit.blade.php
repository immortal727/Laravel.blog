@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редакттрование статьи</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Статья "{{ $post->title}}"</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form_post" role="form" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.posts._form')
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/bs-custom-file-input.min.js') }}"></script>

    @include('admin.posts._skeditor')

    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
        $(document).on('click', '.js-delete-image', function (e) {
            e.preventDefault();
            let confirmed = confirm('Удалить изображение? '),
                routs = $(this).data('route'),
                picture = $(this).data('img');
           // Очищаем название файла
            $(this).parent().find('.custom-file-label').text('');
            // Удалем блок с картинкой
            $(this).parents().find('.img-result').remove();
            if (confirmed) {
                $.ajax({
                    url: routs,
                    type: 'POST',
                    dataType: 'json',
                    data: {picture:picture},
                    success: function(response){
                        $(this).parent().find('.custom-file-label').text('Успешно отправлен ajax');
                    },
                    // Ошибка AJAX
                    error: function(result){
                        console.log(result);
                    }
                })
            }
        });
     </script>
@endsection
<style>
    .delete-file{
        position: absolute;
        z-index: 3;
        right: 80px;
    }
    .delete-file:hover{
        cursor: pointer;

    }
    #ckf-modal{
        top:15% !important;
    }
</style>

