<template>
    <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-gimnasio></categoria-gimnasio>
    </div>
</template>
<script>
import listadoCategorias from './listadoCategorias';
import mapaEstablecimientos from './mapaEstablecimientos';
import categoriaCafe from './categoriaCafe';
import categoriaRestaurant from './categoriaRestaurant';
import categoriaGimnasio from './categoriaGimnasio';
import MapaEstablecimientos from './mapaEstablecimientos.vue';
import ListadoCategorias from './listadoCategorias.vue';


export default {
    components: {
        listadoCategorias,
        mapaEstablecimientos,
        categoriaCafe,
        categoriaRestaurant,
        categoriaGimnasio
    }
}
</script>

        MapaEstablecimientos
