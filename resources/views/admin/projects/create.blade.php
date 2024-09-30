@extends('layouts.app')

@section('content')

<div class="container my-3">

    @if($errors->any())
        <div class="p-2">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error )
                    <ul>
                        <li>
                            {{$error}}
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    @endif

    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container my-3">
            <h2 class="my-3">Inserisci un nuovo progetto</h2>
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" placeholder="Inserisci il titolo">
                @error('title')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="theme" class="form-label">Argomento</label>
                <input type="text" class="form-control @error('theme') is-invalid @enderror" id="theme" name="theme" value="{{old('theme')}}" placeholder="Inserisci l'argomento">
                @error('theme')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Azienda/responsabile</label>
                <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{old('company')}}" placeholder="Inserisci l'argomento">
                @error('company')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipologia:</label>
                <select id="type" name="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Tipo di progetto</option>
                    @foreach($types as $type)
                        <option
                        value="{{$type->id}}"
                        @if(old('type_id') == $type->id) selected @endif
                        >{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <label for="" class="form-label">Tecnologia usata</label>
            <div class="mb-3">
                <div class="btn-group" role="group">
                    @foreach ($technologies as $technology)
                        <input
                        name="technologies[]"
                        type="checkbox"
                        class="btn-check"
                        id="technology-{{$technology->id}}"
                        autocomplete="off"
                        value="{{$technology->id}}"
                        @if (in_array($technology->id, old('technologies', [])))
                            checked
                        @endif
                        >
                        <label class="btn btn-outline-primary" for="technology-{{$technology->id}}">
                            {{$technology->name}}
                        </label>
                    @endforeach
                </div>
                @error('technologies')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Immagine</label>
                <input class="form-control"
                type="file"
                id="img"
                name="img"
                placeholder="inserisci un'immagine"
                onchange="showImage(event)">

                <img src="/img/placeholder.jpg" alt="" class="img-thumb my-2"
                id="thumb">

                @error('img')
                    <small class="text-danger">{{$message}}</small>
                @enderror

            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Data di inizio</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{old('start_date')}}">
                @error('start_date')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Data di fine</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{old('end_date')}}">
                @error('end_date')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Descrizione</label>
                <textarea type="text" class="form-control" cols="30" rows="5" id="description" name="description" placeholder="Inserisci una descrizione">{{old('description')}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
            <a href="{{route('admin.projects.index')}}" class="btn btn-warning">Indietro</a>

        </div>
    </form>


</div>

@endsection