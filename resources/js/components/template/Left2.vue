<template>
<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list">
            <li class="nav-item">
                <router-link  to="/" > 
                <i class="icofont-ui-check mr-2"></i>
                Registrar Ponto
                </router-link>
            </li>
            <li class="nav-item">
                <router-link  to="/fuller/Monthly_report" > 
                <i class="icofont-ui-calendar mr-2"></i>
                Relatório Mensal
                </router-link>

            </li>

            <li class="nav-item">
                <router-link  to="/admin/Manager_report" > 
                <i class="icofont-chart-histogram mr-2"></i>
                Relatório Gerencial
                </router-link>
            </li>
            <li class="nav-item">
                <router-link  to="/admin/user" > 
                <i class="icofont-users mr-2"></i>
                Usuários
                </router-link>
            </li>

        </ul>
    </nav>

    <div class="sidebar-widgets">
        <div class="sidebar-widget">
            <i class="icon icofont-hour-glass text-primary"></i>
            <div class="info">
                <span class="main text-primary">

                </span>
                <span class="label text-muted">Horas Trabalhadas</span>
            </div>
        </div>
        <div class="division my-3"></div>
        <div class="sidebar-widget">
            <i class="icon icofont-ui-alarm text-danger"></i>
            <div class="info">
                <span class="main text-danger">

                </span>
                <span class="label text-muted">Hora de Saída</span>
            </div>
        </div>
    </div>



</aside>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style>
aside.sidebar {
    display: flex;
    flex-direction: column;
    align-items: center;
    grid-area: sidebar;
    box-shadow: -5px 0px 25px 1px rgba(0, 0, 0, 0.4);
    background-color: #FFF;
}
aside.sidebar .menu {
    width: 100%;
    flex-grow: 1;
}

aside.sidebar .menu ul.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

aside.sidebar .menu li.nav-item {
    margin: 0;
    padding: 10px 10px 10px 25px;
}

aside.sidebar .menu li.nav-item:hover {
    background-color: rgba(0, 0, 0, 0.1);
}


aside.sidebar .menu li.nav-item a {
    font-size: 1.2rem;
    color: #555;
    text-decoration: none;
}

body.hide-sidebar aside.sidebar {
    display: none;
}

aside.sidebar .sidebar-widgets {
    position: sticky;
    bottom: 20px;
}

aside.sidebar .sidebar-widget {
    display: flex;
    align-items: center;
}

aside.sidebar .sidebar-widget .icon {
    font-size: 3.5rem;
    margin: 2px 10px 2px 0px;
}

aside.sidebar .sidebar-widget .info {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.division {
    widows: 80%;
    border: solid 1px #EEE;
}

aside.sidebar .info .main {
    font-size: 2rem;
}
</style>
