<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categoría - Materia</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Categoria:</label>
                            <select name="categoria" class='form-control' v-model='categoria' @change='getMaterias()'>
                              <option value='0' >Select Categoria</option>
                              <option v-for='data in categorias' :value='data.id'>{{ data.cat_nombre }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Materia:</label>
                            <select name="materia" class='form-control' v-model='materia'>
                              <option value='0' >Select Materia</option>
                              <option v-for='data in materias' :value='data.id'>{{ data.mat_nombre }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>  
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                categoria: 0,
                categorias: [],
                materia: 0,
                materias: []
            }
        },
        methods:{
            getCategorias: function(){
              axios.get('/api/getCategorias')
              .then(function (response) {
                 this.categorias = response.data;
              }.bind(this));

            },
            getMaterias: function() {
                axios.get('/api/getMaterias',{
                 params: {
                   cat_id: this.categoria
                 }
              }).then(function(response){
                    this.materias = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getCategorias()
        }
    }
</script>
