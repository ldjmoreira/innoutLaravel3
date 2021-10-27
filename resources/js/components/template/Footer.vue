<template>
    <footer class="footer">
        <span>Desenvolvido com</span>
        <span><i class="icofont-heart text-danger mx-1"></i></span>
        <span>por COD<span class="text-danger">3</span>R</span>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style>
    .footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-right: 20px;
    font-size: 1.2rem;
    grid-area: footer;
    background-color: #222;
    color: #FFF;
    }
</style>
