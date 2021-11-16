import VueRouter from 'vue-router';
import Vue from 'vue';
import axios from 'axios';
import Index from './views/Index-home.vue';
import Registration from './views/auth/Index-registration.vue';
import Login from './views/auth/Index-login.vue';
import Residents from './views/residents/Index-resident.vue';
import EditResident from './views/residents/Edit-resident.vue';
import Tariff from './views/tariffs/Index-tariff.vue';
import EditTariff from './views/tariffs/Edit-tariff.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: Index,
    name: 'Index',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/authenticated')
        .then(() => {
          next();
        })
        .catch(() => next({ name: 'Login' }));
    },
  },
  {
    path: '/residents',
    component: Residents,
    name: 'Resident',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/authenticated')
        .then(() => {
          next();
        })
        .catch(() => next({ name: 'Login' }));
    },
  },
  {
    path: '/editResident/:id',
    component: EditResident,
    name: 'EditResident',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/authenticated')
        .then(() => {
          next();
        })
        .catch(() => next({ name: 'Login' }));
    },
  },
  {
    path: '/tariffs',
    component: Tariff,
    name: 'Tariff',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/authenticated')
        .then(() => {
          next();
        })
        .catch(() => next({ name: 'Login' }));
    },
  },
  {
    path: '/tariff/:id',
    component: EditTariff,
    name: 'EditTariff',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/authenticated')
        .then(() => {
          next();
        })
        .catch(() => next({ name: 'Login' }));
    },
  },
  {
    path: '/registration',
    component: Registration,
    name: 'Registration',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/userExisits')
        .then((res) => {
          if (res.data === 1) {
            next();
          } else {
            next({ name: 'Login' });
          }
        });
    },
  },
  {
    path: '/login',
    component: Login,
    name: 'Login',
    beforeEnter: (to, from, next) => {
      axios
        .get('/api/userExisits')
        .then((res) => {
          if (res.data === 1) {
            next({ name: 'Registration' });
          } else {
            next();
          }
        });
    },
  },
];

export default new VueRouter({
  mode: 'history',
  routes,
});
