<template>
  <div class="container">
        <br>
        <div class="row">

      <div class="col-md-8 order-md-1">

        <h4 class="mb-3">Orden</h4>

        <table class="table t ">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Orden</th>
              <th scope="col">Valor</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <template v-for="data in listOrder">
              <tr style="background-color: #cecece; ">
                <td>{{data.ord_id}}</td>
                <td><b>Mesa {{data.ord_mesa}}</b> - {{data.ord_fecha}}</td>
                <td>{{data.ord_valor}}</td>
                <td>
                  <button type="button" class="btn btn-light"  v-on:click="data.show=!data.show">Detalles</button>
                </td>
              </tr>
              <!-- Detalles del orden -->
              <tr v-for="pedido in data.pedidos" v-show="data.show">
                <td>{{data.ord_id}}</td>
                <td>{{pedido.prod_name}}</td>
                <td>{{pedido.ped_cantidad}}</td>
                <td>{{pedido.ped_valor}}</td>
              </tr>
            </template>
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
            this.listOrderService()
        },
        methods:{
          listOrderService()
          {
            axios.get("api/Orden/list")
            .then(response=>{
              // cargar datos
              this.listOrder = response.data
            })
            .catch(error=>{
              alert(error)
            })

          },
        }
    }
</script>
