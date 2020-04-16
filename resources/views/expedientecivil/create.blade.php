@extends('layouts.app')

@section('title', 'Expediente Civil Create')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Ho</h5>
                <h1>Ho</h1>
                <div class="container">
                  <h2>Laravel Dependent Dropdown  Tutorial With Example</h2>
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
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        {{-- <add-ah-button></add-ah-button>
        <add-human-actor></add-human-actor>
        <list-human-actor></list-human-actor> --}}

    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>



      {{-- <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="categoria"]').on('change',function(){
                   var categoriaID = jQuery(this).val();
                   if(categoriaID)
                   {
                      $.ajax({
                         url : '/dropdown/getmaterias/'+categoriaID,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="materia"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="materia"]').append('<option name="mat_id" value="'+ key +'">'+ value +'</option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="materia"]').empty();
                   }
                });
        });
        </script> --}}
    @endsection
