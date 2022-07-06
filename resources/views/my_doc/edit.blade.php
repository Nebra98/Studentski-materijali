@extends('layouts.app')

@section('content')


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <form class="form-horizontal" method="POST" action="{{ route('my_documents.update', $file->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{ csrf_field() }}

                        @can('delete-users')
                            <input type="hidden" id="control" name="control" value="2">
                        @endcan
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Uredi dokument</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                                    <div class="form-group">
                                        <input id="user_name" type="text" value="{{ $file->user_name}}" class="form-control" name="user_name" placeholder="Vaše ime" required  autofocus>
                                    </div>

                                    <div class="form-group">

                                        <input id="doc_name" type="text" class="form-control" name="doc_name" value="{{ $file->doc_name }}" placeholder="Naslov dokumenta" required  autofocus>
                                    </div>

                                    <div class="form-group">
                                        <textarea placeholder="Opis dokumenta (nije obavezno)" class="form-control" name="description" id="description" rows="3">{{ $file->description }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            Dokument:
                                        </div>
                                        <div class="col-7" id="fileList">{{ $file->doc_file }}</div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <select name="category_id" id="category_id" class="form-control select2">
                                            <option selected value="{{ $current_category->id }}">{{ $current_category->name }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
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

    <script>
        updateList = function() {

            var input = document.getElementById('doc_file');
            var output = document.getElementById('fileList');

            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML = input.files.item(i).name;
            }

        }
    </script>

@endsection

