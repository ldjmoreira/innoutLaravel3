<template>
     <router-view></router-view>
</template>

<script>

export default {
    name: 'Content',
        
}
</script>

<style>
.content {
    background-color: #FFF;
    grid-area: content;
    margin: 20px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.2);
}
.content .content-title {
    display: flex;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 1px solid #CCC;
}

.content .content-title .icon {
    font-size: 3rem;
}

.content .content-title h1 {
    color: #444;
    font-size: 1.8rem;
    font-weight: 300;
    margin: 0;
}

.content .content-title h2 {
    color: #888;
    font-size: 1.2rem;
    font-weight: 300;
    margin: 0;
}
</style>
