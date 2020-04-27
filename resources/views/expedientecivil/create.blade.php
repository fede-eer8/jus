@extends('layouts.app')

@section('title', 'Expediente Civil Create')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

<h1>Crear Expediente Civil</h1>
      <div class="container">
        <h2>Por favor rellene el formulario para ingresar un nuevo expediente</h2>
        <form class="form-group" method="POST" action="/expedientecivil" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="" aria-describedby="helpId" placeholder="">
            </div>
            <select-categoria-materia></select-categoria-materia>
            <button type="submit" class="btn btn-primary">Guargar</button>
        </form>
    </div>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>


    @endsection
