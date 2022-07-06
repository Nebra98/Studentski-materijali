@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-xm-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aktivnost</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Broj korisnika:</b> {{ $users_count }}</li>
                        <li class="list-group-item"><b>Broj kategorija:</b> {{ $categories_count }}</li>
                        <li class="list-group-item"><b>Broj dokumenata:</b> {{ $documents_count }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">

                <div class="card-header">

                    <nav class="navbar-light">
                        <div class="row" style="margin-left: 10px">
                        <p class="navbar-brand">Pregled svih korisnika</p>

                        <div class=" mx-auto pull-right" id="navbarSupportedContent">
                            <form action="{{ route('admin.users.index') }}" method="GET" role="search"
                                  class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" name="term" id="term" type="search"
                                       placeholder="Pretraži korisnika" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg> Pretraži
                                </button>
                            </form>
                        </div>
                            </div>
                    </nav>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Email</th>
                            <th scope="col">Uloga</th>
                            <th scope="col">Operacija</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ implode(', ',  $user->roles()->get()->pluck('name')->toArray() )}}</td>

                                @php
                                    $roles = $user->roles()->get()->pluck('name')->toArray();


                                    if (in_array("admin", $roles))
                                    {
                                        $flag = 1;
                                    }
                                    else
                                    {
                                        $flag = 0;

                                    }

                                @endphp


                                <td>
                                    @if($flag == 0)
                                    @can('edit-users')
                                        <a href="{{ route('admin.users.edit', $user->id) }}">
                                            <button type="button" class="btn btn-primary float-left"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg> Uredi</button></a>

                                            @endcan
                                            @can('delete-users')
                                                <a href="{{ route('user_detail.show', $user->id) }}">
                                                    <button type="button" style="margin-left: 5px" class="btn btn-warning float-left"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                        </svg> Detalji</button>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <!-- in blade -->
                                                    <button type="submit" onclick="return confirm('Jeste li sigurni da želite izbrisati korisnika {{ $user->name }}?')" class="btn btn-danger" style="margin-left: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                        </svg> Izbriši</button>
                                                </form>

                                            @endcan
                                    @else

                                        <a href="{{ route('admin.users.edit', $user->id) }}">
                                            <button type="button" class="btn btn-primary float-left"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg> Uredi</button></a>

                                                <a href="{{ route('user_detail.show', $user->id) }}">
                                                    <button type="button" style="margin-left: 5px" class="btn btn-warning float-left"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                        </svg> Detalji</button>
                                                </a>

                                      @endif
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                    {{ $users->links() }}
                </div>

            </div>
    </div>

@endsection
