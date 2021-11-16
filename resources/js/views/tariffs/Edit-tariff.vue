<template>
    <div class="container">
        <Header></Header>
        <div class="row">
            <div class="col-lg">
                <form class="z-depth-2 red lighten-5 p-5 form">
                    <h2>Изменить тарифф</h2>
                    <div class="input-field">
                        <input
                            type="text"
                            class="autocomplete"
                            v-model="form.price"
                            name='price' id="price">
                        <label
                            class="red-text"
                            for="price"
                            v-if="errors.price">Поле не может быть пустым</label>
                        <label for="price" v-else>Цена</label>
                    </div>
                    <div>
                        <DatePicker
                            v-model='form.month'
                            type="month"
                            value-type="format"
                            format="MM"
                            placeholder="Select month"></DatePicker>
                        <label
                            for="price"
                            class="red-text"
                            v-if="errors.month">Выберите дату</label>
                        <label for="price" v-else>Цена</label>
                    </div>
                    <div class="input-field">
                        <input
                        type="submit"
                        @click.prevent="updateTariff"
                        class="teal lighten-2 waves-effect waves-green btn-flat"
                        value="Создать">
                    </div>
                    <div class="input-field">
                        <button
                        class="waves-effect waves-light btn red accent-43"
                        @click.prevent="deleteTariff">Удалить</button>
                    </div>
                </form>
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
    form: {
      price: '',
      month: '',
    },
    errors: [],
  }),
  methods: {
    updateTariff() {
      axios
        .put(`/api/tariff/${this.$route.params.id}`, this.form, {
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          if (response.data.status === false) {
            const toastHTML = '<span>Нельзя создать тарифф для прощедших месяцов</span>';
            // eslint-disable-next-line no-undef
            M.toast({ html: toastHTML, classes: 'deep-orange lighten-1' });
          } else {
            this.$router.push('/tariffs');
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    deleteTariff() {
      axios
        .delete(`/api/tariff/${this.$route.params.id}`)
        .then(() => {
          this.$router.push('/tariffs');
        });
    },
  },
};
</script>
