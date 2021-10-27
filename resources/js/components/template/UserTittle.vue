<template>
<div class="content-title mb-4">
        <i class="icon  mr-2" :class="icon"></i>
    <div>
        <h1>{{tittle1}}</h1>
        <h2>{{tittle2}}</h2>
    </div>
</div>
</template>

<script>
export default {
    name: "UserTittle",
        props: {
        tittle1: String,
        tittle2: String,
        icon: {
            type: String,
            default: ''
        }
    }
}
</script>

<style>

</style>
