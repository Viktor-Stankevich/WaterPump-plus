<template>
    <div class="container">
        <Header></Header>
        <div class="row">
            <div class="col">
                <form class="z-depth-2 red lighten-5 p-5 form">
                    <div class="input-field">
                        <input
                            type="text"
                            name='fio'
                                v-model='form.fio'
                                id="fio"
                                class="autocomplete">
                        <label for="fio">ФИО</label>
                    </div>
                    <div class="input-field">
                        <input
                            type="text"
                            name='area'
                            v-model='form.area'
                            id="area"
                            class="autocomplete">
                        <label for="area">Площадь</label>
                    </div>
                    <div class="input-field">
                        <DatePicker
                        v-model='form.start_date'
                        value-type="format"
                        format="YYYY-MM-DD" :placeholder="resident.start_date"></DatePicker>
                    </div>
                    <div class="input-field">
                        <input
                            type="submit"
                            @click.prevent="updateResident"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Изменить">
                        <button
                            @click.prevent="deleteResident"
                            class="waves-effect waves-light btn red accent-43">Удалить</button>
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
    resident: [],
    form: {
      fio: '',
      area: '',
      start_date: '',
    },
  }),
  mounted() {
    //
  },
  methods: {
    updateResident() {
      axios
        .put(`/api/resident/${this.$route.params.id}`, this.form, {
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(() => {
          this.$router.push('/residents');
        });
    },
    deleteResident() {
      axios
        .delete(`/api/resident/${this.$route.params.id}`)
        .then(() => {
          this.$router.push('/residents');
        });
    },
  },
};
</script>
