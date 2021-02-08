<template>
	<div class="q-pa-md" style="max-width: 400px">

    <q-form
      @submit="onSubmit"
      @reset="onReset"
      class="q-gutter-md"
    >
		<q-input
        filled
        v-model="login.email"
        label="E-mail *"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Digite seu email']"
      />

      <q-input
        type="password"
        filled
        v-model="login.password"
        label="Senha *"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Digite sua Senha']"
      />
			<div>
        <q-btn @onclick="onSubmit()" label="Submit" type="submit" color="primary"/>
        <q-btn @onclick="onReset()" label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
      </div>
		</q-form>
	</div>
</template>

<script>
export default {
	data () {
    return {
      login: {
        email: null,
        password: null,
      }
    }
  },

  methods: {
    onSubmit () {

      return this.$axios({
        method: 'post',
        url: 'http://127.0.0.1:8000/api/auth',
        data: this.login
      }).then (resp => {

        this.$q.sessionStorage.set('gp_token', resp.data)

        this.$router.push({name: 'index'})

        return resp
      }
      )
    },

    onReset () {
      this.email = null
      this.password = null
    }
  }
}
</script>

<style>

</style>
