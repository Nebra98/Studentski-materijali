@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xm-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informacije korisnika {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Korisničko ime:</b> {{ $user->name }}</li>
                        <li class="list-group-item"><b>Email:</b> {{ $user->email }}</li>
                        <li class="list-group-item"><b>Broj dokumenata:</b> {{ $documents_count }}</li>
                        <li class="list-group-item"><b>Registrirao se:</b> {{ Carbon\Carbon::parse($user->created_at)->format('d.m.y H:i') }}</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Pregled dokumenata korisnika {{ $user->name }}</h5>
                </div>

                <div class="card-body">

                    @forelse($documents as $document)

                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-3">
                                        <p><b>Naslov dokumenta:</b></p>
                                    </div>
                                    <div class="col-4">
                                        {{$document->doc_name}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <p><b>Objavio korisnik: </b></p>
                                    </div>
                                    <div class="col-3">
                                        {{ $document->user_name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <p><b>Dokument:</b> </p>
                                    </div>
                                    <div class="col-6">
                                        {{$document->doc_file}}
                                    </div>
                                </div>
                                @foreach($categories as $category)
                                    @if($document->category_id == $category->id)
                                        <div class="row">
                                            <div class="col-3">
                                                <p><b>Naziv kategorija: </b></p>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ url('category/' . $category->id) }}" >{{ $category->name }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="row">
                                    <div class="col-3">
                                        <p><b>Format dokumenta:</b></p>
                                    </div>
                                    <div class="col-6">
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'pdf')
                                            .pdf <img src="{{url('storage/uploads/icons/pdf.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'doc')
                                            .doc <img src="{{url('storage/uploads/icons/word.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'docx')
                                            .docx <img src="{{url('storage/uploads/icons/docx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'txt')
                                            .txt <img src="{{url('storage/uploads/icons/txt.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'csv')
                                            .csv <img src="{{url('storage/uploads/icons/csv.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'ppt')
                                            .ppt <img src="{{url('storage/uploads/icons/ppt.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'pptx')
                                            .pptx <img src="{{url('storage/uploads/icons/pptx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                        @if (pathinfo($document->doc_file, PATHINFO_EXTENSION) == 'xlsx')
                                            .xlsx <img src="{{url('storage/uploads/icons/xlsx.png')}}" style="height: 30px; width: 30px;" alt=".." >
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <p><b>Datum objave:</b></p>
                                    </div>
                                    <div class="col-6">
                                        {{ Carbon\Carbon::parse($document->created_at)->format('m.d.Y H:i') }}
                                    </div>
                                </div>

                                @if($document->description == "")
                                    <a class="text-white bg-primary" data-toggle="collapse" href="#opis{{$document->id}}" type="button" aria-expanded="false" aria-controls="{{$document->id}}">
                                        Pogledajte opis
                                    </a>
                                @else
                                    <a type="button" class="text-white bg-primary" href="#desc{{$document->id}}" data-toggle="modal" data-target="#desc{{$document->id}}">
                                        Pogledajte opis
                                    </a>
                                @endif


                                <div class="collapse" id="opis{{$document->id}}">
                                    <div class="card card-body">
                                        Nije dodan opis za ovaj dokument
                                    </div>
                                </div>

                                <div class="modal fade" id="desc{{$document->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Opis dokumenta
                                                    "{{ $document->doc_name }}"</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $document->description }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <a download href="{{url('storage/uploads/documents/'.$document->doc_file)}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                        <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                    </svg> Preuzmi dokument</a>
                                @can('delete-users')
                                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="float-right">
                                @csrf
                                {{ method_field('DELETE') }}

                                <!-- in blade -->
                                    <button type="submit" onclick="return confirm('Jeste li sigurni da želite izbrisati  dokument {{$document->doc_name}}?')" class="btn btn-danger" style="margin-left: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                            <path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z"/>
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg> Izbriši dokument</button>
                                </form>

                                <a class="float-right" href="{{ route('my_documents.edit',$document->id) }}"> <button type="button" class="btn btn-warning float-left"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg> Uredite dokument</button></a>
                                @endcan
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-warning">
                            <strong style="font-size:2rem;width:100%;text-align:center;">&#128543;</strong><strong>Oops!</strong> Korisnik <strong>{{ $user->name }}</strong> nema ni jedan objavljeni dokument
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

@endsection
