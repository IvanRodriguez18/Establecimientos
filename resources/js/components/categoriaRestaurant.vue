<template>
    <div>
        <div class="box"><h2 class="titulo-seccion">Categoría <span class="categoria">Restaurant</span></h2></div>
        <div class="row my-3">
            <div class="col-12 mb-md-0 mb-2 col-md-4" v-for="restaurant in this.restaurantes" v-bind:key="restaurant.id">
                <div class="card">
                    <img :src="`storage/${restaurant.img}`" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">{{ restaurant.nombre }}</a></h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ restaurant.direccion }} , {{ restaurant.colonia }}</p>
                        <p class="card-text"><i class="fas fa-clock"></i> Horario : <span class="hora">{{ restaurant.apertura }}</span> a.m - <span class="hora">{{ restaurant.cierre }}</span> p.m</p>
                        <div class="row d-flex justify-content-center">
                            <router-link :to="{name: 'establecimiento', params:{id: restaurant.id}}">
                                <a data-toggle="tooltip" data-placement="bottom" class="btn btn-sm" title="Ver establecimiento">
                                    Ver <i class="fas fa-angle-double-right"></i>
                                </a>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        axios.get('/api/categorias/restaurant')
        .then(respuesta => {
            this.$store.commit("AGREGAR_RESTAURANTES", respuesta.data);
        });
    },
    computed:{
        restaurantes(){
            return this.$store.state.restaurantes;
        }
    }
}
</script>
