@extends('layouts.app')

@section('title', 'Expediente Civil {{$expedienteCivil->nombre}}')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    {{-- <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$expedientecivil->nombre}}</h5>
            <h1>{{$expedientecivil->slug}}</h1>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Categoria: {{ $expedientecivil->categoria->cat_nombre }}</li>
            <li class="list-group-item">Materia: {{ $expedientecivil->materia->mat_nombre }}</li>
            <li class="list-group-item">Iniciado: {{ $expedientecivil->created_at->format('d/m/Y') }}</li>
        </ul>
  </div> --}}
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="actorHumano-tab" data-toggle="tab" href="#ActorHumano" role="tab" aria-controls="ActorHumano" aria-selected="false">Actores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">{{$expedientecivil->nombre}}</h5>
                <h1>{{$expedientecivil->slug}}</h1>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                {!! Form::open([ 'route' => ['expedientecivil.destroy', $expedientecivil->slug], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-outline-danger', 'icon' => 'fa fa-trash', ]) !!}
                {!! Form::close() !!}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Categoria: {{ $expedientecivil->categoria->cat_nombre }}</li>
                <li class="list-group-item">Materia: {{ $expedientecivil->materia->mat_nombre }}</li>
                <li class="list-group-item">Iniciado: {{ $expedientecivil->created_at->format('d/m/Y') }}</li>
            </ul>
        </div>
        
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container">
            <add-ah-button></add-ah-button>
            <hr>
            <div class="row">     
                <div class="col-md-6">               
                    <add-human-actor></add-human-actor>
                    <list-human-actor></list-human-actor>
                    <edit-human-actor></edit-human-actor>
                </div>
                <div class="col-md-6" >
                    <view-human-actor></view-human-actor>
                </div>
            </div>
        </div>
        
    </div>
    <div class="tab-pane fade" id="ActorHumano" role="tabpanel" aria-labelledby="actorHumano-tab">
        <div class="container">
            <list2-human-actor props-slug="{{ $expedientecivil->slug }}"></list2-human-actor>
        </div>
        
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
@endsection