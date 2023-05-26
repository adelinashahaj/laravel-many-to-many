@extends('layouts.app')
@section('page-title')

@section('content')

<h1>{{$technologies->name}}</h1>
<h6><small>Slug: {{$technologies->slug}}</small></h6>
<!-- vifico se dentro project di type c'e'  il valore e prendi il valore di type altrimenti null -->

<h6>{{count($technologies->projects)}}</h6>





<a href="{{route('admin.technologies.index')}}" class="btn btn-secondary">Torna alla lista</a>
@endsection
