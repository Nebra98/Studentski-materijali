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
                        <p class="navbar-brand">Pregled kategorija</p>

                        <div class=" mx-auto pull-right" id="navbarSupportedContent">
                            <form action="{{ route('home.index') }}" method="GET" role="search"
                                  class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" name="term" id="term" type="search"
                                       placeholder="Pretraži kategoriju" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg> Pretraži
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

                    @forelse($categories as $category)

                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="{{url('storage/uploads/categories_photos/'.$category->cover_image)}}"
                                         style="max-width: 100%;" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">

                                    <div class="card-body">

                                        <h5 class="card-title"><a href="{{ url('category/' . $category->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                                                    <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
                                                </svg> {{ $category->name }}</a></h5>
                                        @php($count=0)
                                        @foreach($documents as $document)
                                            @if($category->id == $document->category_id)
                                                @php(++$count)
                                            @endif()
                                        @endforeach


                                        <p class="card-text">Broj dukumenata: {{ $count  }}</p>
                                        <p class="card-text"><small class="text-muted">Zadnji put
                                                ažurirano: {{$category->updated_at->diffForHumans()}}</small></p>

                                    </div>
                                    @can('delete-users')

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                              class="float-right">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <!-- in blade -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    style="margin-left: 5px" data-target="#kat{{$category->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-minus" viewBox="0 0 16 16">
                                                    <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                                    <path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                </svg> Izbriši
                                            </button>

                                            <div class="modal fade" id="kat{{$category->id}}" tabindex="-1"
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
                                                            kategoriju {{ $category->name }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Odustani
                                                            </button>
                                                            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-minus" viewBox="0 0 16 16">
                                                                    <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                                                    <path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                                </svg> Izbriši
                                                                kategoriju
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <a href="{{ route('categories.edit',$category) }}">
                                            <button type="button" class="btn btn-primary float-right"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg> Uredi kategoriju
                                            </button>
                                        </a>

                                    @endcan


                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            <strong
                                style="font-size:2rem;width:100%;text-align:center;">&#128543;</strong><strong>Oops!</strong>
                            Ne postoji ni jedna kreirana kategorija u sustavu.
                        </div>
                    @endforelse
                    {{ $categories->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
