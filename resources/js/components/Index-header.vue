<template>
    <div class="row">
        <div class="col">
            <header class="header">
                <nav class="pl-5 pr-5 white">
                    <div class="nav-wrapper">
                        <a href="/" class="brand-logo">Водокачка +</a>
                        <a
                            href="#"
                            data-target="mobile-demo"
                            class="sidenav-trigger">
                                <i class="material-icons">menu</i>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li v-for="(link, item) in links" :key="item">
                                <router-link :to="link.href">{{link.title}}</router-link>
                            </li>
                            <li class="ml-5">
                                <button
                                    class="waves-effect waves-light btn"
                                    @click.prevent="logout">Выйти</button>
                            </li>
                        </ul>
                    </div>
            </nav>

                <ul class="sidenav" id="mobile-demo">
                    <li v-for="(link, item) in links" :key="item">
                        <router-link :to="link.href">{{link.title}}</router-link>
                    </li>
                    <li class="ml-5">
                        <button
                        class="waves-effect waves-light btn"
                        @click.prevent="logout">Выйти</button>
                    </li>
                </ul>
            </header>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Index-header',
  data() {
    return {
      links: [
        {
          title: 'Главная',
          href: '/',
        },
        {
          title: 'Дачники',
          href: '/residents',
        },
        {
          title: 'Тариффы',
          href: '/tariffs',
        },

      ],
    };
  },
  mounted() {
    // eslint-disable-next-line no-undef
    M.AutoInit();
  },
  methods: {
    logout() {
      axios
        .post('/api/logout')
        .then(() => {
          this.$router.go({ name: 'Login' });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
    a {
        color: #000
    }

    nav {
        box-shadow: 0px 5px 5px -5px rgba(0, 0, 0, 0.6);
    }
</style>
