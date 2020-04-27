@extends('layouts.app')

@section('title', 'Expediente Civil')

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
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actores Humanos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="actorIdeal-tab" data-toggle="tab" href="#ActorIdeal" role="tab" aria-controls="ActorIdeal" aria-selected="false">Actores Ideales</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acciones</a>
        <div class="dropdown-menu">
          {{-- <a class="dropdown-item" href="#">Action</a> --}}
          <form class="" action="{{ url('/expedientecivil', ['id' => $expedientecivil->slug]) }}" method="post">
            {{-- <i class="fa fa-trash icon" aria-hidden="true"></i> --}}
            <button class="dropdown-item" type="submit"><i style="margin-right: 0.5em; color: #a43;" class="fa fa-trash" aria-hidden="true"></i>Eliminar Expediente</button>
            {{-- <input class="btn btn-danger "  type="submit" value="Eliminar Expediente" /> --}}
            @method('delete')
            @csrf
        </form>
          {{-- <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a> --}}
        </div>
      </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">  
        <div class="text-center p-2">
            <h5 class="text-center">{{$expedientecivil->nombre}}</h5>
            <h1>{{$expedientecivil->slug}}</h1>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary m-2">Go somewhere</a>
            
            {{-- {!! Form::open([ 'route' => ['expedientecivil.destroy', $expedientecivil->slug], 'method' => 'DELETE']) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger', 'icon' => 'fa fa-trash', ]) !!}
            {!! Form::close() !!} --}}
            <ul class="list-group list-group-flush bg-light">
                <li class="list-group-item">Categoria: <strong>{{ $expedientecivil->categoria->cat_nombre }} </strong></li>
                <li class="list-group-item">Materia: <strong>{{ $expedientecivil->materia->mat_nombre }} </strong></li>
                <li class="list-group-item">Iniciado: <strong>{{ $expedientecivil->created_at->format('d/m/Y')}}</strong></li>
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
    <div class="tab-pane fade" id="ActorIdeal" role="tabpanel" aria-labelledby="actorIdeal-tab">
        <div class="container">
            {{-- <list2-human-actor props-slug="{{ $expedientecivil->slug }}"></list2-human-actor> --}}
            
        </div>
        
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
@endsection