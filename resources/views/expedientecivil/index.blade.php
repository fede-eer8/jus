@extends('layouts.app')

@section('title', 'Expediente Civil Create')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <form class="form-group" method="POST" action="/expedientecivil">
        @csrf
        <div class="form-group">
            <label for="nombre" class="for">Nombre</label>
            <input name="nombre" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Categoría</label>   
            <select id="categoria" name="categoria">
                <option value="0">Seleccionar Categoria</option>
                <option value="1">De conocimiento</option>
                <option value="2">De conocimiento especial</option> 
            </select>           
           
            <select disabled="disabled" class="subcat" id="materia" name="materia">
                <option value="0">Seleccionar materia</option>
                <option rel="1">accion de nulidad</option>
                <option rel="1">accion declarativa</option>
                <option rel="2">accion posesoria</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    @endsection
    @section('postJquery')
    <script>
        @parent
        $(function(){
            var $cat = $("#categoria"),
                $subcat = $(".subcat");

            $cat.on("change",function(){
            var _rel = $(this).val();
            $subcat.find("option").attr("style","");
            $subcat.val("");
            if(!_rel) return $subcat.prop("disabled",true);
            $subcat.find("[rel~='"+_rel+"']").show();
            $subcat.prop("disabled",false);
            });
        });  
    </script>
    @endsection