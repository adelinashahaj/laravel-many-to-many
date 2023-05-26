@extends('layouts.app')

@section('page-title')

@section('content')
<form method="POST" action="{{route('admin.technologies.update', ['technology'=>$technology->slug])}}">

    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
                               <!-- un metodo per dare l'errore se tu non metti i dati (validazioni)-->
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $technology->name)}}">
        <!-- ti da il messagio che non hai compilato i dati necessari -->
        @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
    </div>





    <button type="submit" class="btn btn-primary">Salva</button>
</form>
@endsection
