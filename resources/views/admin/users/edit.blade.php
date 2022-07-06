@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Uredi korisnika ') }} {{ $user->name }}</div>

                    <div class="card-body">

                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Ime</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @csrf
                            {{ method_field('PUT') }}
                             @can('delete-users')

                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Uloge</label>

                                <div class="col-md-8">
                                    @php
                                        $check = $user->roles()->get()->pluck('name')->toArray();
                                    @endphp
                            @if(!in_array('admin', $check))
                            @foreach($roles as $role )
                                @if($role->id == 4)
                                    @continue
                                            @endif
                                  <div class="form-check">
                                       <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                       <label>{{ $role->name }}</label>
                                  </div>
                            @endforeach
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                           <p class="text-primary">Uloge koje korisnik {{ $user->name }} ima: <strong>{{ implode(', ',  $user->roles()->get()->pluck('name')->toArray() )}}</strong>.</p>

                                            <p class="text-danger">Ne možete promijeniti uloge, korisnik {{ $user->name }} je <strong>administrator</strong></p>.
                                        </div>
                                @endif
                                </div>
                            </div>

                            @endcan
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg> Uredi
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
