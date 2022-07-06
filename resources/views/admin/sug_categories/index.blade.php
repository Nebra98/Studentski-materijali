<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous">

<script src='https://kit.fontawesome.com/a076d05399.js'></script>


@extends('layouts.app')


@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">

                    <nav class="navbar-light">
                        <p class="navbar-brand">Prijedlozi kategorija</p>

                        <div class=" mx-auto pull-right" id="navbarSupportedContent">
                            <form action="{{ route('home.index') }}" method="GET" role="search"
                                  class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" name="term" id="term" type="search"
                                       placeholder="Pretraži prijedlog" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><i
                                        class="fas fa-search"></i> Pretraži
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($sug_categories as $sug_category)

                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{url('storage/uploads/sug_categories_photos/'.$sug_category->sug_cover_image)}}"
                                         style="max-width: 100%;" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">

                                    <div class="card-body">

                                        <h5 class="card-title">{{ $sug_category->sug_name }}</h5>

                                        <p class="card-text"><small class="text-muted">Prijedlog poslan: {{$sug_category->created_at->diffForHumans()}}</small></p>

                                    </div>
                                    @can('delete-users')

                                        <form action="{{ route('sug_category.destroy', $sug_category) }}" method="POST"
                                              class="float-right">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <!-- in blade -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    style="margin-left: 5px" data-target="#kat{{$sug_category->id}}">
                                                <i class="fas fa-folder-minus"></i> Izbriši
                                            </button>

                                            <div class="modal fade" id="kat{{$sug_category->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"> Potvrtite
                                                                radnju</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Jeste li sigurni da želite izbrisati
                                                            prijedlog {{ $sug_category->sug_name }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Odustani
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Izbriši
                                                                kategoriju
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#sug{{ $sug_category->id }}" data-whatever="@mdo">Objavi kategoriju</button>

                                        <div class="modal fade" id="sug{{ $sug_category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Popunite formu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" id="control" name="control" value="2">
                                                            <input type="hidden" id="sug_id" name="sug_id" value="{{ $sug_category->id }}">
                                                            <div class="form-group">
                                                                <input id="name" type="text" class="form-control" name="name" value="{{$sug_category->sug_name}}" placeholder="Ime kategorije" required autofocus>
                                                            </div>

                                                            <div class="form-group">

                                                                <div class="col-md-8">
                                                                    <label class="text">Trenutna naslovna fotografija kategorije</label>
                                                                    <input type="hidden" id="current_image" name="current_image" value="{{ $sug_category->sug_cover_image }}">
                                                                    <img src="{{url('storage/uploads/sug_categories_photos/'.$sug_category->sug_cover_image)}}" style="width:100px; height:100px;" class="card-img" alt="..." >
                                                                </div>
                                                                {{$sug_category->sug_cover_image}}
                                                            </div>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Naslovna fotografija</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="cover_image" name="cover_image">
                                                                    <label class="custom-file-label" for="sug_cover_image{{ $sug_category->id }}">jpeg | png | jpg | bmp</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    Odabrani dokument:
                                                                </div>
                                                                <div class="col-7" id="sug_fileList{{ $sug_category->id }}">još niste odabrali naslovnu fotografiju</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                                                                <button type="submit" class="btn btn-primary">Objavi</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @endcan


                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            <strong
                                style="font-size:2rem;width:100%;text-align:center;">&#128543;</strong><strong>Oops!</strong>
                            Ne postoji ni jedan prijedlog kategorija.
                        </div>


                    @endforelse


                </div>
            </div>
        </div>
    </div>
    <script>
        updateListtt = function(a, b) {

            var input = document.getElementById(a);
            var output = document.getElementById(b);

            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML = input.files.item(i).name;
            }

        }
    </script>


@endsection
