<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-center">Войти</h1>
                <form>
                    <div class="input-field">
                        <input
                            type="text"
                            v-model="form.name"
                            name="name" id="name"
                            class="autocomplete"
                            placeholder="Логин">
                        <label for="name"></label>
                    </div>
                    <div class="input-field">
                        <input
                            type="password"
                            v-model="form.password"
                            name="password" id="password"
                            class="autocomplete"
                            placeholder="Пароль">
                        <label for="password"></label>
                    </div>
                    <div class="input-field">
                        <input
                            type="submit"
                            @click.prevent="login"
                            class="teal lighten-2 waves-effect waves-green btn-flat"
                            value="Войти">
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
  }),
  methods: {
    login() {
      axios
        .post('/api/login', this.form)
        .then(() => {
          this.$router.push({ name: 'Index' });
        })
        .catch(() => {
          const toastHTML = '<span>Неверный логин или пароль</span>';
          // eslint-disable-next-line no-undef
          M.toast({ html: toastHTML, classes: 'deep-orange lighten-1' });
        });
    },
  },
};
</script>
