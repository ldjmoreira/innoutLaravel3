<template>
<div class="header">
        <div class="logo">
            <i class="icofont-travelling mr-2"></i>
            <span class="font-weight-light">In </span>
            <span class="font-weight-bold mx-2">N'</span>
            <span class="font-weight-light">Out</span>
            <i class="icofont-runner-alt-1 ml-2"></i>
        </div>
        <div class="menu-toggle mx-3">
            <i class="icofont-navigation-menu"></i>
        </div>
        <div class="spacer"></div>
        <div class="dropdown">
            <div class="dropdown-button">
                <img class="avatar" 
                    src="<?= http://www.gravatar.com/avatar.php?gravatar_id=5">
                    
                <span class="ml-3">
                    Lorion
                </span>
                <i class="icofont-simple-down mx-2"></i>
            </div>
            <div class="dropdown-content">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a  @click.prevent="logout">
                            <i class="icofont-logout mr-2"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</div>
  
</template>

<script>
import { userKey } from '../../global'
import { mapState } from 'vuex'
export default {
  computed: mapState(['user']),
    methods: {
        logout() {
            localStorage.removeItem(userKey)
            this.$store.commit('setUser', null)
            this.$router.push({ name: 'auth' })
        }
    }
}
</script>

<style>
.header {
    grid-area: header;
    display: flex;
    background-color: #1976d2;
    align-items: center;
    z-index: 10;
    box-shadow: 
        0 2px 4px -1px rgba(0, 0, 0, .2),
        0 4px 4px 0px rgba(0, 0, 0, .14),
        0 1px 10px 0px rgba(0, 0, 0, .12);
}
.header .logo {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 2rem;
    flex-basis: 250px;
    height: 100%;
}
.header .menu-toggle {
    color: white;
    cursor: pointer;
}
.header .spacer {
    flex: 1;
}

.header .dropdown {
    position: relative;
    height: 100%;
}

.header .dropdown-button {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    font-size: 1.1rem;
    color: white;
    cursor: pointer;
}

.header .dropdown-content {
    display: none;
    position: absolute;
    min-width: 100%;
    background-color: #f9f9f9;
    padding: 15px 0px;
    z-index: 100;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, .2);
}

.header .dropdown:hover .dropdown-content {
    display: block;
}

.header .dropdown-content ul {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.header .dropdown-content a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #222;
    padding: 7px;
    font-size: 1.1rem;
    cursor: pointer;
}

.header .dropdown-content a:hover {
    background-color: rgba(0, 0, 0, .05);
}

.header .dropdown:hover {
    background-color: rgba(0, 0, 0, .1);
}

.header .avatar {
    height: 75%;
    border-radius: 50%;
    margin-left: 10px;
}
</style>