<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h2>Laravel Dependent Dropdown  Tutorial With Example</h2>
            <div class="form-group">
                <label for="categoria">Select Categoria:</label>
                <select name="categoria" class="form-control" style="width:250px">
                    <option value="">--- Select Categoria ---</option>
                    @foreach ($categorias as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="materia">Select Materia:</label>
                <select name="materia" class="form-control"style="width:250px">
                <option>--Materia--</option>
                </select>
            </div>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function ()
        {
                jQuery('select[name="categoria"]').on('change',function(){
                   var categoriaID = jQuery(this).val();
                   if(categoriaID)
                   {
                      $.ajax({
                         url : 'dropdownlist/getmateria/' +categoriaID,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="materia"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="materia"]').append('<option value="'+ key +'">'+ value +'</option>');
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
        </script>
  </body>
</html>