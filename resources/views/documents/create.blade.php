@extends('layouts.app')

@section('content')


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <form class="form-horizontal" method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Prenesi novi dokument</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                                    <div class="form-group">
                                        <input id="user_name" type="text" value="{{ Auth::user()->name}}" class="form-control" name="user_name" placeholder="Vaše ime" required  autofocus>
                                    </div>

                                    <div class="form-group">

                                        <input id="doc_name" type="text" class="form-control" name="doc_name" placeholder="Naslov dokumenta" required  autofocus>
                                    </div>

                                    <div class="form-group">
                                        <textarea placeholder="Opis dokumenta (nije obavezno)" class="form-control" name="description" id="description" rows="3"></textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Dokument</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="doc_file" name="doc_file" required onchange="javascript:updateList()">

                                            <label class="custom-file-label" for="doc_file">doc | docx | pdf | txt | xlsx | csv | pptx | ppt</label>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            Odabrani dokument:
                                        </div>
                                        <div class="col-7" id="fileList">još niste odabrali dokument</div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <select name="category_id" id="category_id" class="form-control select2">
                                            <option disabled  selected value="">Odaberite kategoriju...</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="btn-toolbar justify-content-between">


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                                            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                        </svg> Objavi</button>
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

