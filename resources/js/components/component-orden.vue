<template>
  <div class="container">
        <br>
        <div class="row">

      <div class="col-md-8 order-md-1">

        <h4 class="mb-3">Pedidos</h4>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Hora</th>
              <th scope="col">Mesa</th>
              <th scope="col">Valor</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in listOrder">
              <td></td>
              <td>
                <button type="button" class="btn btn-info" v-if="data.cat_active==1" v-on:click="updateSatus(data.cat_id,0)">Activo</button>
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
            listOrder:[]
          }
        },
        mounted() {
            //this.loadOrder()
        },
        methods:{
          listCatService()
          {
            axios.get("api/Order/list")
            .then(response=>{
              // cargar datos
              this.listCat = response.data
            })
            .catch(error=>{
              alert(error)
            })

          },
        }
    }
</script>
