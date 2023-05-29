@extends('layouts.app')

@section('page-title')

@section('content')
<form method="POST" action="{{route('admin.projects.store')}}"enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Titolo:</label>
                               <!-- un metodo per dare l'errore se tu non metti i dati (validazioni)-->
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
        <!-- ti da il messagio che non hai compilato i dati necessari -->
        @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrizione:</label>
        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>
        @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    </div>

    <div class="mb-3">
        <!-- esempio con url dell'immagine
            <label for="cover_image" class="form-label">Url dell'immagine:</label>
        <input type="text" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" value="{{old('cover_image')}}">-->

        <label for="cover_image" class="form-label">Seleziona immagine:</label>
        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
        @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="type_id" class="form-label">Seleziona type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
            <option @selected(old('type_id')=='') value="">Nessun type</option>
            @foreach ($types as $type)
                <option @selected(old('type_id')==$type->id) value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        @error('type_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        @foreach($technologies as $technology)
            <input id="technology_{{$technology->id}}" @if (in_array($technology->id , old('technologies', []))) checked @endif type="checkbox" name="technologies[]" value="{{$technology->id}}">
            <label for="technology_{{$technology->id}}"  class="form-label">{{$technology->name}}</label>
            <br>
        @endforeach
        @error('technologies')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary">Salva</button>
</form>
@endsection
