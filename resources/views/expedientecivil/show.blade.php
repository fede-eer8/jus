@extends('layouts.app')

@section('title', 'Expediente Civil')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principal" role="tab" aria-controls="principal" aria-selected="true"><i style="margin-right: 0.5em; color:Dodgerblue ;" class="fas fa-home" aria-hidden="true"></i> {{$expedientecivil->nombre}}</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Actores</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#ActorHumano" id="actorHumano-tab" data-toggle="tab" role="tab" aria-controls="ActorHumano">Actores Humanos</a>
          <a class="dropdown-item" href="#ActorIdeal" id="actorIdeal-tab" data-toggle="tab" role="tab" >Actores Ideales</a>
          {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
          {{-- <div class="dropdown-divider"></div> --}}
          {{-- <a class="dropdown-item" href="#">Separated link</a> --}}
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Demandados</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#DemandadoHumano" id="demandadoHumano-tab" data-toggle="tab" role="tab" aria-controls="ActorHumano">Demandados Humanos</a>
          <a class="dropdown-item" href="#DemandadoIdeal" id="demandadoIdeal-tab" data-toggle="tab" role="tab" >Demandados Ideales</a>
          {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
          {{-- <div class="dropdown-divider"></div> --}}
          {{-- <a class="dropdown-item" href="#">Separated link</a> --}}
        </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento" role="tab" aria-controls="documento" aria-selected="false">Documentos</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
    
    <!-- <li class="nav-item dropdown">
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
    </li> -->
  </ul>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center p-2">
                        <h5 class="text-center">{{$expedientecivil->nombre}}</h5>
                        <h1>{{$expedientecivil->slug}}</h1>
                        <!-- {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary m-2">Go somewhere</a> --}} -->
                        
                        {{-- {!! Form::open([ 'route' => ['expedientecivil.destroy', $expedientecivil->slug], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger', 'icon' => 'fa fa-trash', ]) !!}
                        {!! Form::close() !!} --}}
                        <ul class="list-group list-group-flush bg-light">
                            <li class="list-group-item">Categoria: <strong>{{ $expedientecivil->categoria->cat_nombre }} </strong></li>
                            <li class="list-group-item">Materia: <strong>{{ $expedientecivil->materia->mat_nombre }} </strong></li>
                            <li class="list-group-item">Iniciado: <strong>{{ $expedientecivil->created_at->format('d/m/Y')}}</strong></li>
                        </ul><br>
                    </div>
                </div>

                <div class="col-md-6">
                    <list-human-actor :indicator="false"></list-human-actor>        
                </div>
                <div class="col-md-6">
                    <list-ideal-actor></list-ideal-actor>
                </div>
                
                     
            </div>
        </div>                
    </div>

    <div class="tab-pane fade" id="Actor" role="tabpanel" aria-labelledby="actor-tab">
        <div class="container">
            <hr>
            <div class="row">     
                <div class="col-md-6">               
                    <list-human-actor :indicator="false"></list-human-actor>
                </div>
                <div class="col-md-6" >
                    <list-ideal-actor></list-ideal-actor>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="ActorHumano" role="tabpanel" aria-labelledby="actorHumano-tab">
        <div class="container">
            <add-ha-button></add-ha-button>
            <hr>
            <div class="row">     
                <div class="col-md-6">               
                    <add-human-actor></add-human-actor>
                    <list-human-actor :indicator="true"></list-human-actor>
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
            <div class="row">
                <div class="col-md-6">
                    <add-ideal-actor></add-ideal-actor>
                    <list-ideal-actor></list-ideal-actor>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="DemandadoHumano" role="tabpanel" aria-labelledby="actorHumano-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <add-human-defendant></add-human-defendant>
                    <list-human-defendant></list-human-defendant>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="DemandadoIdeal" role="tabpanel" aria-labelledby="demandadoIdeal-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <add-ideal-defendant></add-ideal-defendant>
                    <list-ideal-defendant></list-ideal-defendant>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="documento" role="tabpanel" aria-labelledby="documento-tab">
    <div class="container">
            <div class="row">     
                <div class="col-md-6">               
                    <add-document></add-document>
                    <list-document></list-document>
                </div>
                <div class="col-md-6" >
                    <view-document></view-document>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
@endsection