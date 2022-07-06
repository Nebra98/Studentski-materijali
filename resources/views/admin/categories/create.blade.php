@extends('layouts.app')
@section('content')

    <div class="container-fluid gedf-wrapper">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Broj prijedloga: {{ $sug_category_count }}</h4>
            <p>Prije kreiranja nove kategorije, pogledajte prijedloge korisnika ukoliko ih ima. Prijedloge možete pogledati klikom na gumb ispod</p>
            <hr>
             <a class="btn btn-primary" href="{{ route('sug_category.index')}}" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                     <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                 </svg> Pogledaj prijedloge ketegorija</a>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Napravi novu kategoriju</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">

                                    <input id="name" type="text" class="form-control" name="name" placeholder="Ime kategorije" required  autofocus>
                                </div>

                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Naslovna fotografija</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cover_image" name="cover_image" required onchange="javascript:updateList()">

                                        <label class="custom-file-label" for="cover_image">jpeg | png | jpg | bmp</label>
                                      </div>
                                    </div>

                                <div class="row">
                                    <div class="col-4">
                                        Odabrani dokument:
                                    </div>
                                    <div class="col-7" id="fileList">još niste odabrali naslovnu fotografiju</div>
                                </div>
                                <br>

                            </div>

                        </div>
                        <div class="btn-toolbar justify-content-between">


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                        <path d="M.5 3l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg> Napravi ketegoriju</button>
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

            var input = document.getElementById('cover_image');
            var output = document.getElementById('fileList');

            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML = input.files.item(i).name;
            }

        }
    </script>

@endsection
