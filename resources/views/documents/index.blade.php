@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar-light">
                       <div class="row" style="margin-left: 10px">
                           <p class="navbar-brand">Pregled kategorije "{{ $category->name }}"</p>

                            <div class=" mx-auto pull-right" id="navbarSupportedContent">
                                <form action="{{ url('category/' . $category->id) }}" method="GET" role="search" class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" name="term" id="term" type="search" placeholder="Pretraži dokument" aria-label="Search">
                                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg> Pretraži</button>
                                </form>
                            </div>
                       </div>
                    </nav>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @forelse($files as $file)

                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Naslov dokumenta:</b></p>
                                            </div>
                                            <div class="col-4">
                                                {{$file->doc_name}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Objavio korisnik: </b></p>
                                            </div>
                                            <div class="col-3">
                                                {{ $file->user_name }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Dokument:</b> </p>
                                            </div>
                                            <div class="col-6">
                                                {{$file->doc_file}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Format dokumenta:</b></p>
                                            </div>
                                            <div class="col-6">
                                                @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'pdf')
                                                    .pdf <img src="{{url('storage/uploads/icons/pdf.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'doc')
                                                        .doc <img src="{{url('storage/uploads/icons/word.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'docx')
                                                        .docx <img src="{{url('storage/uploads/icons/docx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'txt')
                                                        .txt <img src="{{url('storage/uploads/icons/txt.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'csv')
                                                        .csv <img src="{{url('storage/uploads/icons/csv.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'ppt')
                                                        .ppt <img src="{{url('storage/uploads/icons/ppt.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'pptx')
                                                        .pptx <img src="{{url('storage/uploads/icons/pptx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                                    @if (pathinfo($file->doc_file, PATHINFO_EXTENSION) == 'xlsx')
                                                        .xlsx <img src="{{url('storage/uploads/icons/xlsx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Datum objave:</b></p>
                                            </div>
                                            <div class="col-6">
                                                {{ Carbon\Carbon::parse($file->created_at)->format('d.m.Y H:i') }}
                                            </div>
                                        </div>

                                        @if($file->description == "")
                                            <a class="text-white bg-primary" data-toggle="collapse" href="#opis{{$file->id}}" type="button" aria-expanded="false" aria-controls="{{$file->id}}">
                                                Pogledajte opis
                                            </a>
                                        @else
                                            <a type="button" class="text-white bg-primary" href="#desc{{$file->id}}" data-toggle="modal" data-target="#desc{{$file->id}}">
                                                Pogledajte opis
                                            </a>
                                        @endif

                                        <div class="collapse" id="opis{{$file->id}}">
                                            <div class="card card-body">
                                                Nije dodan opis za ovaj dokument
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="desc{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Opis dokumenta
                                                            "{{ $file->doc_name }}"</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $file->description }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <a download href="{{url('storage/uploads/documents/'.$file->doc_file)}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                            </svg> Preuzmi dokument</a>
                                        @can('delete-users')

                                            <form action="{{ route('documents.destroy', $file) }}" method="POST" class="float-right">
                                            @csrf
                                            {{ method_field('DELETE') }}

                                            <!-- in blade -->
                                                <button type="submit" onclick="return confirm('Jeste li sigurni da želite izbrisati  dokument {{$file->doc_name}}?')" class="btn btn-danger" style="margin-left: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                                        <path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z"/>
                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                    </svg> Izbriši dokument</button>
                                            </form>
                                            @endcan
                                    </div>
                                </div>

                                <br>
                            @empty
                                <div class="alert alert-warning">
                                    <strong style="font-size:2rem;width:100%;text-align:center;">&#128543;</strong><strong>Oops!</strong> U ovoj kategoriji nema ni jedan objavljeni dokument..
                                </div>
                        @endforelse
                        {{ $files->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection
