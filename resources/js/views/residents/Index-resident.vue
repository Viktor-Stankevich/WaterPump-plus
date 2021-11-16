<template>
    <div class="container">
        <Header></Header>
        <div class="row">
            <div class="col-lg-4">
                <form class="z-depth-2 red lighten-5 p-5 form">
                    <h2>Добавить дачника</h2>
                    <div class="input-field">
                        <input
                            type="text"
                            name='fio'
                            v-model='form.fio'
                            id="fio"
                            class="autocomplete">
                        <label
                            for="fio"
                            class="red-text"
                            v-if="errors.fio">Поле не может быть пустым</label>
                        <label for="fio" v-else>ФИО</label>
                    </div>
                    <div class="input-field">
                        <input
                            type="text"
                            name='area'
                            v-model='form.area'
                            id="area" class="autocomplete">
                        <label
                            for="area"
                            class="red-text"
                            v-if="errors.area">Поле не может быть пустым</label>
                        <label for="area" v-else>Площадь</label>
                    </div>
                    <div class="input-field">
                        <DatePicker
                            id="startDate"
                            v-model='form.start_date'
                            value-type="format" format="YYYY-MM-DD"></DatePicker>
                        <label
                            for="startDate"
                            class="red-text"
                            v-if="errors.start_date">Поле не может быть пустым</label>
                        <label for="startDate" v-else>Дата подключения</label>
                    </div>
                    <div class="input-field">
                        <div class="progress" v-if="storeLoading">
                            <div class="indeterminate"></div>
                        </div>
                        <input
                            type="submit"
                            @click.prevent="storeResident"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Создать"
                            v-else>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">

                <table >
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>ФИО</td>
                            <td>Площадь</td>
                            <td>Дата подключения</td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="resident in residents" :key="resident">
                            <td>{{ resident.id }}</td>
                            <td>{{ resident.fio }}</td>
                            <td>{{ resident.area }}</td>
                            <td>{{ resident.start_date }}</td>
                            <td>
                                <a
                                :href='link + resident.id'
                                class='waves-effect waves-light btn yellow darken-3'>Изменить</a>
                            </td>
                        </tr>
                        <div class="progress" v-if="getLoading">
                            <div class="indeterminate"></div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

import Header from '../../components/Index-header.vue';

export default {
  components: {
    DatePicker,
    Header,
  },
  data: () => ({
    residents: [],
    link: '/editResident/',
    form: {
      fio: '',
      area: '',
      start_date: '',
    },
    errors: [],
    storeLoading: false,
    getLoading: false,
  }),
  mounted() {
    this.loadResident();
  },
  methods: {
    loadResident() {
      this.getLoading = true;
      axios
        .get('/api/resident')
        .then((response) => {
          this.getLoading = false;
          this.residents = response.data;
        });
    },
    storeResident() {
      this.storeLoading = true;
      axios
        .post('/api/resident', this.form, {
          headers: {
            'Content-type': 'application/json',
          },
        })
        .then(() => {
          this.storeLoading = false;
          this.loadResident();
        })
        .catch((error) => {
          this.storeLoading = false;
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
    @media (min-width: 992px ) {
        .form {
            position: fixed;
        }
    }
    .table {
        position: relative;
    }
    .progress {
        position: absolute;
        top: 100%;
    }
</style>
