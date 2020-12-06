<template>
    <div>
        <h1 class="text-center mb-2 titulo-general">{{establecimiento.nombre}}</h1>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <img :src="`../storage/${establecimiento.img}`" class="card-img-top img-thumbnail" alt="establecimiento.img">
                    <div class="card-body">
                        <h2 class="card-title">Acerca de {{ establecimiento.nombre }}</h2>
                        <p class="card-text">{{ establecimiento.descripcion }}</p>
                        <p class="card-text"><small class="text-muted">Registrado: {{ establecimiento.created_at }}</small></p>
                        <galeria-imagenes></galeria-imagenes>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-column">
                    <div><mapa-ubicacion></mapa-ubicacion></div>
                    <div class="informacion">
                        <h3 class="text-center titulo-info">Información</h3>
                        <p class="card-text texto"><i class="icono fas fa-map-marker-alt"></i> {{ establecimiento.direccion }} , {{ establecimiento.colonia }}</p>
                        <p class="card-text texto"><i class="icono fas fa-phone-alt"></i> {{ establecimiento.telefono }}</p>
                        <p class="card-text texto"><i class="icono fas fa-clock"></i> Horario : <span class="hora">{{ establecimiento.apertura }}</span> a.m - <span class="hora">{{ establecimiento.cierre }}</span> p.m</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import mapaUbicacion from './mapaUbicacion';
import galeriaImagenes from './galeriaImagenes';
import GaleriaImagenes from './galeriaImagenes.vue';
export default {
    components:{
        mapaUbicacion,
        galeriaImagenes
    },
    mounted(){
        const {id} = this.$route.params;
        axios.get('/api/establecimientos/' + id)
        .then(respuesta => {
            this.$store.commit('AGREGAR_ESTABLECIMIENTO', respuesta.data)
        });
    },
    computed:{
        establecimiento(){
            return this.$store.getters.obtenerEstablecimiento;
        }
    }
}
</script>
