@extends('layouts.app')

@section('page-title', 'Elenco di types')

@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Slug</th>
        <th scope="col">Numero di proggeti</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
            <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->name}}</td>
                <td>{{$type->slug}}</td>
                <td>{{count($type->projects)}} @if(count($type->projects) > 0) <!-- sto contando qunti proggeti hanno un type-->

                  @foreach ($projects as $project )
                  @if ($type->id == $project->type_id)
                  <h6>{{$project->title}}</h6>
                  @endif
                  @endforeach
                  @endif</td>
                  <td class="d-flex">

                    <a class="btn btn-primary me-2" href="{{route('admin.types.show', ['type' => $type->slug])}}">Vedi</a>
                    <a class="btn btn-warning me-2" href="">Modifica</a>
                   

                </td>
            </tr>
        @endforeach
    </tbody>
  </table>


@endsection
