<template>
  <div class="q-pa-md">
    <q-toolbar-title>
      <div>Usuário</div>
    </q-toolbar-title>

    <div class="q-gutter-md q-my-lg items-start">
      <q-form @submit="onSubmit">
        <q-input
          v-model="dataForm.name"
          outlined
          hint="Digite Nome de Usuário"
        />
        <br />
        <q-input
          v-model="dataForm.email"
          outlined
          hint="Digite E-mail de Usuário"
        />
        <br />
        <q-input
          v-model="dataForm.password"
          outlined
          type="password"
          hint="Digite Senha de Usuário"
        />
        <!-- <q-select v-model="dataForm.userType" outlined type="userType" hint="Escolha Tipo de Usuário" /> -->
        <div class="row justify-end q-my-sm">
          <q-btn label="Salvar" type="submit" color="pink-6" />
          <q-btn
            label="Cancelar"
            type="reset"
            color="purple-9"
            flat
            class="q-ml-sm"
            to="/usuario"
          />
        </div>
      </q-form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dataForm: {},
    };
  },

  methods: {
    onSubmit() {
      let method = null;
      let url = '';

      if (this.dataForm.id) {
        method = 'put';
        url = '/' + this.dataForm.id;
      } else {
        method = 'post';
      }

      this.$axios({
        method: method,
        url: 'http://127.0.0.1:8000/api/user' + url,
        headers: {
          "gp-token": this.$q.sessionStorage.getItem('gp_token'),
        },
        data: this.dataForm,
      }).then(() => {
        this.$q.notify({
          message: "Usuário Cadastrado com Sucesso!",
          color: "positive",
          icon: "cloud_done",
        });

        this.$router.push({ name: "user_list" });
      });
    },
    async getData(id) {
      const { data } = await this.$axios({
        method: "get",
        url: "http://127.0.0.1:8000/api/user/" + id,
        headers: {
          "gp-token": this.$q.sessionStorage.getItem("gp_token"),
        },
      });

      this.dataForm = data;
    },
  },
  mounted() {
    if (this.$route.params.id) {
      this.getData(this.$route.params.id);
    }
  },
};
</script>

<style lang="less" scoped>
</style>
