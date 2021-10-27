<template>
  <div class="pagenotfound">
      <div class="text"> <h1>404</h1> </div>
    <h1 class="mb-5">Página não encontrada</h1>
    <SvgNotFound width="100" height="100" />

  </div>

</template>

<script>
import SvgNotFound from './SvgComponent'
  export default {
    name: 'PAgeNoutFound',
    components: { SvgNotFound },
        props: {

    },
    data() {
      return {


      }
    },
    methods: {

    }
  }
</script>

<style scoped >
@import './style.css';
</style>