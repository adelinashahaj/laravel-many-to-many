@extends('layouts.app')

@section('content')


<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titolo</th>
        <th scope="col">Img</th>
        <th scope="col">Slug</th>
        <th scope="col">Tipo</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td scope="row">{{$project->id}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->cover_image}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->type?->name}}</td>
                <td class="d-flex">

                    <a class="btn btn-primary me-2" href="{{route('admin.projects.show', ['project' => $project->slug])}}">Vedi</a>
                    <a class="btn btn-warning me-2" href="{{route('admin.projects.edit', ['project' =>$project->slug])}}">Modifica</a>
                    <form class="form_delete_project" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}" method="POST">
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
