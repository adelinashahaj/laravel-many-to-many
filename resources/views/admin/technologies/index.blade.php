@extends('layouts.app')


@section('page-title', 'Elenco di technologies')

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
        @foreach ($technologies as $technology)
            <tr>
                <td>{{$technology->id}}</td>
                <td>{{$technology->name}}</td>
                <td>{{$technology->slug}}</td>
                <td>{{count($technology->projects)}}

                 </td>
                  <td class="d-flex">

                    <a class="btn btn-primary me-2" href="{{route('admin.technologies.show', ['technology' => $technology->slug])}}">Vedi</a>
                    <a class="btn btn-warning me-2" href="{{route('admin.technologies.edit', ['technology' => $technology->slug])}}">Modifica</a>

                    <form class="form_delete_project" action="{{route('admin.technologies.destroy', ['technology' => $technology->slug])}}" method="POST">
                        @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancella</button>

                     </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>


@endsection


<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Confermi di voler eliminare l'elemento selezionato?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Conferma eliminazione</button>
        </div>
        </div>
    </div>
</div>
