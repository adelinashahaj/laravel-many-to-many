@extends('layouts.app')
@section('page-title')

@section('content')

<!--<img src="{{$project->cover_image}}" class="img-fluid" alt="{{$project->title}}">-->
<h2>Immagine selezionata:</h2>
@if ($project->cover_image)
    <img class="img-thumbnail" src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->title}}"/>
@endif

<h1>{{$project->title}}</h1>
<h6><small>Slug: {{$project->slug}}</small></h6>
<!-- vifico se dentro project di type c'e'  il valore e prendi il valore di type altrimenti null -->
<h5> Tipo: {{$project->type?$project->type->name: 'Nessun type' }}</h5>

@foreach ($project->technologies as $technology)
<span class="badge rounded-pill text-bg-primary">{{$technology->name}}</span>
@endforeach
<h2>{{$project->description}}</h2>



<a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna alla lista</a>
@endsection
