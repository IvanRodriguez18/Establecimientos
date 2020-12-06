<template>
    <div>
        <nav class="menu d-flex flex-column flex-md-row container justify-content-md-center">
            <a @click="seleccionarTodo()" class="link-categoria">Todos</a>
            <a v-for="categoria in categorias" v-bind:key="categoria.id" class="link-categoria m-0"
            @click="seleccionarCategoria(categoria)">
                {{ categoria.categoria }}
            </a>
        </nav>
    </div>
</template>

<script>
export default {
    created(){
        axios.get('/api/categorias')
        .then(respuesta => {
            this.$store.commit('AGREGAR_CATEGORIAS', respuesta.data);
        });
    },
    computed:{
        categorias(){
            return this.$store.getters.obtenerCategorias;
        }
    },
    methods: {
        seleccionarCategoria(categoria){
            this.$store.commit('SELECCIONAR_CATEGORIA', categoria.slug)
        },
        seleccionarTodo(){
            axios.get('/api/establecimientos')
            .then(respuesta =>{
                this.$store.commit('AGREGAR_ESTABLECIMIENTOS', respuesta.data)
            });
        }
    }
}
</script>
