<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-center">Зарегистрироваться</h1>
                <form>
                    <div class="input-field">
                        <input
                            type="text"
                            v-model="form.name"
                            name="name"
                            id="name"
                            class="autocomplete"
                            placeholder="Логин">
                        <label for="name"></label>
                    </div>
                    <div class="input-field">
                        <input
                            type="password"
                            v-model="form.password"
                            name="password"
                            id="password"
                            class="autocomplete"
                            placeholder="Пароль">
                        <label for="password"></label>
                    </div>
                    <div class="input-field">
                        <input
                            type="submit"
                            @click.prevent="registration"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Зарегистрироваться">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    form: {
      name: '',
      password: '',
    },
    errors: [],
  }),
  methods: {
    registration() {
      axios
        .post('/api/registration', this.form)
        .then(() => {
          this.$router.push({ name: 'Login' });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
