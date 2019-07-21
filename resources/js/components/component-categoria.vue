<template>
  <div class="container">
        <br>
        <div class="row">

      <div class="col-md-8 order-md-1">

        <h4 class="mb-3">Modulo Categorias {{nameCat}}</h4>

        <div class="input-group mb-3">
          <input type="text" class="form-control" v-model="nameCat" placeholder="Nombre de categoria" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2" v-on:click="addCategory()">Agregar</button>
          </div>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in listCat">
              <td></td>
              <td>{{data.cat_nombre}}</td>
              <td>
                <button type="button" class="btn btn-info" v-if="data.cat_active==1" v-on:click="updateSatus(data.cat_id,0)">Activo</button>
                <button type="button" class="btn btn-light" v-else v-on:click="updateSatus(data.cat_id,1)">Desactivado</button>
              </td>
            </tr>
          </tbody>
        </table>

      </div>


    </div>


  </div> <!-- /container -->
</template>

<script>
    export default {
        data(){
          return{
            nameCat:"",
            listCat:[]
          }
        },
        mounted() {
            this.listCatService()
        },
        methods:{
          addCategory(){

            const formData = new FormData()
            formData.append('name',this.nameCat)

            axios.post("api/Categoria/add",formData)
            .then(response => {
              // limpiar campo
              this.nameCat = ""
              // cargar lista de nuevo
              this.listCatService()
            })
            .catch(error => {
              alert(error)
            })

          },
          listCatService(){

            axios.get("api/Categoria/list")
            .then(response=>{
              // cargar datos
              this.listCat = response.data
            })
            .catch(error=>{
              alert(error)
            })

          },
          updateSatus(id,status){

            const formData = new FormData()
            // parametro
            // id de categoria
            formData.append('idcat',id)
            // status de categoria
            formData.append('status',status)

            axios.post("api/Categoria/change-status",formData)
            .then(response => {
              // limpiar campo
              // cargar lista de nuevo
              this.listCatService()
            })
            .catch(error => {
              alert(error)
            })
          }
        }
    }
</script>
