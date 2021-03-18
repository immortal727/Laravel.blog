@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание альбома</h1>
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
                    <div class="card">
                         <!-- /.card-header -->
                        <div class="card-body">
                            <div class="nav-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="{{ route('create_album_form') }}">CreateNew Album</a></li>
                                </ul>
                            </div>
                            <div class="container">
                                <div style="display: inline-block;">
                                    <form name="createnewalbum" method="POST" action="{{ route('create_album') }}" enctype="multipart/form-data">
                                        @csrf
                                        @include('admin.albums._form')
                                    </form>
                                </div>
                            </div> <!-- /container -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

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

    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection


