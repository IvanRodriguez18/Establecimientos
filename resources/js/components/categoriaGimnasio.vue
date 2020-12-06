<template>
    <div>
        <div class="box"><h2 class="titulo-seccion">Categoría <span class="categoria">Gimnasio</span></h2></div>
        <div class="row my-3">
            <div class="col-12 mb-md-0 mb-2 col-md-4" v-for="gimnasio in this.gimnasios" v-bind:key="gimnasio.id">
                <div class="card">
                    <img :src="`storage/${gimnasio.img}`" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">{{ gimnasio.nombre }}</a></h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ gimnasio.direccion }} , {{ gimnasio.colonia }}</p>
                        <p class="card-text"><i class="fas fa-clock"></i> Horario : <span class="hora">{{ gimnasio.apertura }}</span> a.m - <span class="hora">{{ gimnasio.cierre }}</span> p.m</p>
                        <div class="row d-flex justify-content-center">
                            <router-link :to="{name: 'establecimiento', params:{id: gimnasio.id}}">
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
        axios.get('/api/categorias/gimnasio')
        .then(respuesta => {
            this.$store.commit("AGREGAR_GIMNASIOS", respuesta.data);
        });
    },
    computed:{
        gimnasios(){
            return this.$store.state.gimnasios;
        }
    }
}
</script>
