@extends('layouts.app')
@section('content')


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <form class="form-horizontal" method="POST" action="{{ route('categories.update',$category) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Uredi kategoriju</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Ime kategorije" required autofocus>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-8">
                                            <label class="text">Trenutna naslovna fotografija kategorije</label>
                                            <img src="{{url('storage/uploads/categories_photos/'.$category->cover_image)}}" style="width:100%; height:100%;" class="card-img" alt="..." >
                                        </div>

                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Prenesite novu naslovnu fotografiju</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cover_image" name="cover_image">

                                            <label class="custom-file-label" for="cover_image">jpeg | png | jpg | bmp</label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="btn-toolbar justify-content-between">


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg> Uredi</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- Post /////-->





            </div>

        </div>
    </div>


@endsection
