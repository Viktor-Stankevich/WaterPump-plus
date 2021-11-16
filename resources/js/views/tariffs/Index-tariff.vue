<template>
    <div class="container">
        <Header></Header>
        <div class="row">
            <div class="col-lg-4">
                <form class="z-depth-2 red lighten-5 p-5 form">
                    <h2>Создать тарифф</h2>
                    <div class="input-field">
                        <input
                            class="autocomplete"
                            type="text"
                            v-model="form.price"
                            name='price' id="price">
                        <label
                            class="red-text"
                            for="price"
                            v-if="errors.price">не может быть пустым</label>
                        <label for="price" v-else>Цена</label>
                    </div>
                    <div>
                            <DatePicker
                                id='datepicker'
                                v-model='form.month'
                                type="month" value-type="format"
                                format="MM"></DatePicker>
                        <div class="input-field">
                            <!-- <label
                                for="datepicker"
                                class="red-text"
                                v-if="errors.month">Поле не может быть пустым</label>
                            <label for="datepicker" v-else>Месяц</label> -->
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="progress" v-if="storeLoading">
                            <div class="indeterminate"></div>
                        </div>
                        <input
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            type="submit"
                            @click.prevent="setForm"
                            value="Создать"
                            v-else>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Цена</td>
                            <td>Период С:</td>
                            <td>Период По:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tariff in tariffs" :key="tariff">
                            <td>{{ tariff.id }}</td>
                            <td>{{ tariff.price }}</td>
                            <td>{{ tariff.begin_date }}</td>
                            <td>{{ tariff.end_date }}</td>
                            <td>
                                <a
                                    class='waves-effect waves-light btn yellow darken-3'
                                    :href='link + tariff.id'
                                    >Изменить</a>
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
    tariffs: [],
    form: {
      price: '',
      month: '',
    },
    errors: [],
    link: '/tariff/',
    storeLoading: false,
    getLoading: false,
  }),
  mounted() {
    this.getTariffs();
  },
  methods: {
    setForm() {
      this.storeLoading = true;
      axios
        .post('/api/tariff', this.form)
        .then((response) => {
          if (response.data.status === false) {
            const toastHTML = '<span>Нельзя создать тарифф для прощедших месяцов</span>';
            // eslint-disable-next-line no-undef
            M.toast({ html: toastHTML, classes: 'deep-orange lighten-1' });
            this.storeLoading = false;
          } else {
            this.storeLoading = false;
            this.getTariffs();
          }
        })
        .catch((error) => {
          this.storeLoading = false;
          this.errors = error.response.data.errors;
        });
    },
    getTariffs() {
      this.getLoading = true;
      axios
        .get('/api/tariff')
        .then((response) => {
          this.getLoading = false;
          this.tariffs = response.data;
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
    .table {
        position: relative;
    }
    .progress {
        position: absolute;
        top: 100%;
    }
    }
</style>
