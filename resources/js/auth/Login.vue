<template>
    <div class="d-flex w-50 m-auto align-items-center">
        <div class="card card-body">
            <form>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                            type="text"
                            id="email"
                            name="email"
                            placeholder="enter your e-mail"
                            class="form-control"
                            v-model="email"
                            :class="[{'is-invalid': errorFor('email')}]"
                    >
                    <v-errors :errors="errorFor('email')"></v-errors>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="enter your password"
                            class="form-control"
                            v-model="password"
                            :class="[{'is-invalid': errorFor('password')}]"
                    >
                    <v-errors :errors="errorFor('password')"></v-errors>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" :disabled="loading" @click.prevent="login">Log-in</button>
            </form>
            <hr>
            <span>
                No account yet?
                <router-link :to="{name: 'home'}" class="font-weight-bold">Register</router-link>
            </span>
            <span>
                Forgotten password?
                <router-link :to="{name: 'home'}" class="font-weight-bold">Reset password</router-link>
            </span>
        </div>
    </div>
</template>

<script>
    import validationsError from "../shared/mixins/validationsError";

    export default {
        mixins: [validationsError],
        data() {
            return {
                email: null,
                password: null,
                loading: false,
                errors: null,
            }
        },
        methods: {
            async login() {
                this.loading = true;
                this.errors = null;

                try {
                    await axios.get('/sanctum/csrf-cookie');
                    await axios.post('/login', {
                        email: this.email,
                        password: this.password
                    });
                    await axios.get('/user');
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

                this.loading = false;

            }
        }
    };
</script>