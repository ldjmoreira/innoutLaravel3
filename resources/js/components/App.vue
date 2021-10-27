<template>
	<div  >
		<div id="app2" v-if="user">
			<Header  />
			<Left />
			<Loading v-if="validatingToken" />
			<Content v-else />
			<Footer   />
		</div>
		<div class="bodyy" v-else>
			<Loading v-if="validatingToken" />
			<Auth v-else />
		</div>

	</div>
</template>

<script>

import { mapState } from "vuex"
import { baseApiUrl, userKey } from "../global"

import Header from "./template/Header.vue"
import Footer from "./template/Footer.vue"
import Left from "./template/Left2.vue"
import Loading from "./template/Loading.vue"
import Content from "./template/Content.vue"
import Auth from "./auth/Auth.vue"

export default {
    name: 'App',
    components: { Header,Loading,Left, Content,Auth, Footer },
    computed: mapState(['user','algo']),
		data: function() {
		return {
			validatingToken: true
		}
	},
	methods: {
		async validateToken() {
			this.validatingToken = true
			const json = localStorage.getItem(userKey)
			const userData = JSON.parse(json)
			this.$store.commit('setUser', null)
			console.log(userData)


			if(!userData) {
				this.validatingToken = false
				this.$router.push({ name: 'auth' })
				return
			}
			/*
			const res = await axios.post(`${baseApiUrl}/api/auth/validateToken`, userData)
			console.log(res)
			if (res.data) {
				console.log("ola2")
				this.$store.commit('setUser', userData)
				this.$store.commit('setAlgo', 2)
				
			} else {
				console.log("ola3")
				localStorage.removeItem(userKey)
				this.$router.push({ name: 'auth' })
			}
			this.validatingToken = false
			*/
			
			try {
				const res = await axios.post(`${baseApiUrl}/auth/validateToken`, userData)
				console.log(res)
				//console.log(userData)
				this.$store.commit('setUser', userData)
				this.$store.commit('setAlgo', 2)
				this.validatingToken = false
				console.log("ola2")
			} catch(msg) {
				console.log("ola3")
				localStorage.removeItem(userKey)
				this.$router.push({ name: 'auth' })
				this.validatingToken = false
			}
			


		}
	},
	created() {
		this.validateToken()
		
	}
}
</script>

<style>
	.bodyy {
		height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: #DDD;
	}
	* {
		font-family: "Lato", sans-serif;
	}

	body {
		margin: 0;
	}

	#app2 {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;

		height: 100vh;
		display: grid;
		grid-template-rows: 60px 1fr 40px;
		grid-template-columns: 300px 1fr;
		grid-template-areas:
			"header header"
			"sidebar content"
			"sidebar footer";
	}

	#app.hide-menu {
		grid-template-areas:
			"header header"
			"content content"
			"footer footer";
	}

* {
    font-family: 'Oswald', sans-serif;
}

@font-face {
    font-family: 'Oswald';
    font-weight: 200;
    src: url('./fonts/Oswald-ExtraLight.ttf') format('truetype');
}

@font-face {
    font-family: 'Oswald';
    font-weight: 300;
    src: url('./fonts/Oswald-Light.ttf') format('truetype');
}

@font-face {
    font-family: 'Oswald';
    font-weight: 400;
    src: url('./fonts/Oswald-Regular.ttf') format('truetype');
}

@font-face {
    font-family: 'Oswald';
    font-weight: 500;
    src: url('./fonts/Oswald-Medium.ttf') format('truetype');
}

@font-face {
    font-family: 'Oswald';
    font-weight: 600;
    src: url('./fonts/Oswald-SemiBold.ttf') format('truetype');
}

@font-face {
    font-family: 'Oswald';
    font-weight: 700;
    src: url('./fonts/Oswald-Bold.ttf') format('truetype');
}
</style>
