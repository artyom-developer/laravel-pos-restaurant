<template>
  <div class="container">

        <br>
        <div class="row">

          <div class="col-md-8 order-md-1">

            <h4 class="mb-3">Modulo Producto</h4>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Crear un producto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                       <label for="exampleFormControlInput1">Nombre del Producto</label>
                       <input type="text" class="form-control" v-model="campoName" >
                     </div>
                     <div class="form-group">
                       <label for="exampleFormControlTextarea1">Descripcion</label>
                       <textarea class="form-control" v-model="campoDescription" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                       <label for="exampleFormControlTextarea1">Precio</label>
                       <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="text" class="form-control"  v-model="campoPrice">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                       </div>
                     </div>

                     <div class="form-group">
                       <label for="exampleFormControlSelect1">Categoria</label>
                       <select class="form-control" id="exampleFormControlSelect1" @change="onSelectCategories($event)"  >
                         <option value=""></option>
                         <option v-for="cat in listCat" :value="cat.cat_id" >{{cat.cat_nombre}}</option>
                       </select>
                     </div>

                     <div class="form-group">
                        <label for="exampleFormControlInput1">Imagen</label>
                        <input type="file" class="form-control" ref="file"  v-on:change="onUploadImage()"   >
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" v-on:click="sendNetwordCreateProduct()"  >Guardar</button>
                  </div>
                </div>
              </div>
            </div>


            <hr>
            
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="data in listProd">
                  <td></td>
                  <td>{{data.prod_name}}</td>
                  <td>{{data.prod_price}}</td>
                  <td>{{data.cat_nombre}}</td>
                  <td>
                    <button type="button" class="btn btn-info" v-if="data.prod_visible==1" v-on:click="updateSatus(data.prod_id,0)">Activo</button>
                    <button type="button" class="btn btn-light" v-else v-on:click="updateSatus(data.prod_id,1)">Desactivado</button>
                  </td>
                </tr>
              </tbody>
            </table>





          </div>
        </div>

  </div>
</template>

<script>
    export default {
        data(){
          return{
            listCat:[],
            listProd:[],
            campoName:'',
            campoDescription:'',
            campoPrice:'',
            campoCategoria:0,
            picFile:null
          }
        },
        mounted() {
          this.listCatService()
          this.listProdService()
        },
        methods:{
          listProdService(){

            axios.get("api/Producto/list")
            .then(response=>{
              // cargar datos
              this.listProd = response.data
            })
            .catch(error=>{
              alert(error)
            })

          },
          updateSatus(id,status){

            const formData = new FormData()
            // parametro
            // id de categoria
            formData.append('idprod',id)
            // status de categoria
            formData.append('status',status)

            axios.post("api/Producto/change-status",formData)
            .then(response => {
              // cargar lista de nuevo
              this.listProdService()
            })
            .catch(error => {
              alert(error)
            })
          },
          onUploadImage(){
            this.picFile = this.$refs.file.files[0];
            console.log("Get picFile success "+this.picFile)
          },
          onSelectCategories(event){
            this.campoCategoria = event.target.value
          },
          sendNetwordCreateProduct(){

            if (this.campoName=="") {
              alert("Completa los campo de nombre ")
            }
            else if (this.campoPrice=="") {
              alert("Completa los campo de precio")
            }
            else if (this.campoCategoria==0) {
              alert("Selecciona la categoria")
            }
            else {

              const formData = new FormData()
              formData.append('name',this.campoName)
              formData.append('description',this.campoDescription)
              formData.append('categorie',this.campoCategoria)
              formData.append('price',this.campoPrice)

              // por si no esta nulo
              if (this.picFile) {
                formData.append('prod_image',this.picFile)
              }

              //console.log(JSON.stringify(this))

              axios.post("api/Producto/create",formData)
              .then(response => {
                // limpiar campo_
                alert(response.data.message)
                // cargar lista de nuevo
                //this.listCatService()
              })
              .catch(error => {
                alert(error)
              })

            }

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

          }
        }
    }
</script>
