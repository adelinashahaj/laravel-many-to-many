@extends('layouts.app')
@section('page-title')

@section('content')

<h1>{{$type->name}}</h1>
<h6><small>Slug: {{$type->slug}}</small></h6>
<!-- vifico se dentro project di type c'e'  il valore e prendi il valore di type altrimenti null -->

<h6>{{count($type->projects)}}</h6>





<a href="{{route('admin.types.index')}}" class="btn btn-secondary">Torna alla lista</a>
@endsection
