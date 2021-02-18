<template>
  <div class="q-pa-md" style="max-width: 400px">
    <q-toolbar-title>
      <div>Tipo de Usuário</div>
    </q-toolbar-title>

    <div class="q-gutter-md q-my-lg">
      <q-form @submit="onSubmit">
        <q-input
          outlined
          v-model="dataForm.name"
          label="Tipo de Usuário"
          hint="Cadastre Tipo de Usuário"
          lazy-rules
          :rules="[
            (val) => (val && val.length > 0) || 'Cadastre Tipo de Usuário',
          ]"
        />

        <q-input
          outlined
          v-model="dataForm.level"
          label="Nível de Usuário"
          hint="Digite Nível de Permissão de Usuário"
          lazy-rules
          :rules="[
            (val) =>
              (val && val.length > 0) || 'Digite Nível de Permissão de Usuário',
          ]"
        />

        <div class="row justify-end q-my-sm">
          <q-btn label="Salvar" type="submit" color="pink-6" />
          <q-btn
            label="Cancelar"
            type="reset"
            color="purple-9"
            flat
            class="q-ml-sm"
            to="/tipo_usuario"
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
      let url = "";

      if (this.dataForm.id) {
        method = "put";
        url = "/" + this.dataForm.id;
      } else {
        method = "post";
      }

      this.$axios({
        method: method,
        url: "http://127.0.0.1:8000/api/userType" + url,
        headers: {
          "gp-token": this.$q.sessionStorage.getItem("gp_token"),
        },
        data: this.dataForm,
      }).then(() => {
        this.$q.notify({
          message: "Tipo de Usuário Cadastrado com Sucesso!",
          color: "positive",
          icon: "cloud_done",
        });

        this.$router.push({ name: "userType_list" });
      });
    },
    async getData(id) {
      const { data } = await this.$axios({
        method: "get",
        url: "http://127.0.0.1:8000/api/userType/" + id,
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
