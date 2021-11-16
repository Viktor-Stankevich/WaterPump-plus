<template>
    <div class="container">
        <Header></Header>
        <div class="row">
            <div class="col-lg-4">
                <div class="z-depth-2 red lighten-5 p-5" v-if="calculateForm">
                    <h2>Уже был произведён рассчёт</h2>
                    <span>Рассчёт производиться за прошлый месяц</span>
                </div>
                <form class="z-depth-2 red lighten-5 p-5 form" v-else>
                    <h2>Рассчёт по показаниям счётсика</h2>
                    <span>Рассчёт производиться за прошлый месяц</span>
                    <div class="input-field" v-if="showPrice">
                        <input
                        type="text"
                        :value="price"
                        class="autocomplete"
                        placeholder="Цена"
                        readonly>
                        <a href="/tariffs">{{ notificationOfExistingTariff }}</a>
                        <label for="price"></label>
                    </div>
                    <div class="input-field" v-else>
                        <input
                        type="text"
                        name='price'
                        v-model="form.price"
                        id="price"
                        class="autocomplete"
                        placeholder="Цена">
                        <label for="price"></label>
                    </div>
                    <div class="input-field">
                        <input
                        type="text"
                        name='counter'
                        v-model="form.amount_volume"
                        id="counter" class="autocomplete"
                        placeholder="Показания счётчика">
                        <label for="counter"></label>
                    </div>
                    <div class="input-field" v-if="update">
                        <div class="progress" v-if="storeLoading">
                            <div class="indeterminate"></div>
                        </div>
                        <input
                            type="submit"
                            @click.prevent="updateBills"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Создать"
                            v-else>
                    </div>
                    <div class="input-field" v-else>
                        <div class="progress" v-if="storeLoading">
                            <div class="indeterminate"></div>
                        </div>
                        <input
                            type="submit"
                            @click.prevent="store"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Создать"
                            v-else>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <h2>Показать результаты за:</h2>
                <div class="date">
                    <DatePicker
                    v-model='formDate.month'
                    @change='showBill'
                    type="month"
                    value-type="format"
                    format="YYYY-MM-DD HH-mm-ss"
                    placeholder="Выберите дату"></DatePicker>
                </div>
                <div v-if="notPaymentForThisMonth">
                    <div class="card amber accent-1">
                        <div class="card-content black-text">
                            <span class="card-title">Нет данных на выбранный месяц</span>
                            <span class="card-title">Или не выбран месяц</span>
                            <p>Пожалуйста выберите месяц</p>
                        </div>
                    </div>
                </div>
                <table v-else>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>ФИО</td>
                            <td>Период От:</td>
                            <td>Период До:</td>
                            <td>Уплачено</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bill in bills" :key="bill" >
                            <td>{{ bill.id }}</td>
                            <td>{{ bill.resident.fio }}</td>
                            <td>{{ bill.period.begin_date }}</td>
                            <td>{{ bill.period.end_date }}</td>
                            <td>{{ bill.amount_rub }}</td>
                        </tr>
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

import Header from '../components/Index-header.vue';

export default {
  components: {
    DatePicker,
    Header,
  },
  data: () => ({
    form: {
      price: '',
      amount_volume: '',
    },
    formDate: {
      month: '',
    },
    bills: [],
    price: '',
    showPrice: false,
    notPaymentForThisMonth: true,
    storeLoading: false,
    notificationOfExistingTariff: '',
    calculateForm: false,
    update: false,
  }),
  mounted() {
    this.tariffPrice();
    this.showCalculateForm();
  },
  methods: {
    store() {
      this.storeLoading = true;
      axios
        .post('/api/payment', this.form)
        .then(() => {
          this.storeLoading = false;
          this.showBill();
        })
        .catch(() => {
          const toastHTML = '<span>На даный месяц уже произведён рассчёт</span>';
          // eslint-disable-next-line no-undef
          M.toast({ html: toastHTML, classes: 'deep-orange lighten-1' });
        });
    },
    showBill() {
      axios
        .post('/api/bill', this.formDate)
        .then((response) => {
          if (response.data) {
            this.notPaymentForThisMonth = false;
            this.bills = response.data;
          } else {
            this.notPaymentForThisMonth = true;
          }
        });
    },
    tariffPrice() {
      axios
        .get('/api/payment')
        .then((response) => {
          if (response.data > 0) {
            this.showPrice = true;
            this.price = response.data;
            this.notificationOfExistingTariff = 'На данный месяц был заранее запланирован тарифф. Кликните чтобы перейти к настройкам тариффов.';
          }
        });
    },
    showCalculateForm() {
      axios
        .get('/api/showCalculateForm')
        .then((response) => {
          if (response.data.status === true) {
            this.calculateForm = true;
          }
        });
    },
  },
};
</script>
