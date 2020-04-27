@extends('layouts.app')

@section('title', 'Expediente Civil')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="p-2">
    <a href="/expedientecivil/create" class="btn btn-primary">Crear Expediente Civil</a><hr>
  <div class="row">
    @foreach($expedienteCivils as $expedienteCivil)
      <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-header">{{$expedienteCivil->nombre}}</div>
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <h5 class="card-title">{{$expedienteCivil->slug}}</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Categoria: {{$expedienteCivil->categoria->cat_nombre}}</li>
              <li class="list-group-item">Materia: {{$expedienteCivil->materia->mat_nombre}}</li>
              <li class="list-group-item">Iniciado: {{$expedienteCivil->created_at->format('d/m/Y')}}</li>

            </ul>
            <div class="card-body">
              <a href="/expedientecivil/{{$expedienteCivil->slug}}" class="btn btn-primary">Ver más...</a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>
      </div>
        
    @endforeach
  </div>
</div>

@endsection