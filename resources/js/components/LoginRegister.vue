<template>
    <v-dialog
        v-model="dialog"
        max-width="600px"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                outlined
                v-bind="attrs"
                v-on="on"
            >
                Login/Register
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <v-tabs v-model="tab" fixed-tabs color="red">
                    <v-tabs-slider/>
                    <v-tab>
                        LOGIN
                    </v-tab>
                    <v-tab>
                        REGISTER
                    </v-tab>
                </v-tabs>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-tabs-items v-model="tab">
                        <v-tab-item>
                            <v-form ref="login" @submit.prevent="attempt_login" lazy-validation>
                                <v-card flat>
                                    <v-card-text>
                                        <v-text-field validate-on-blur label="Email" :rules="rules.email"
                                                      prepend-inner-icon="mdi-email" type="email"
                                                      v-model="auth.email"/>
                                        <v-text-field validate-on-blur label="Password" :rules="rules.required"
                                                      prepend-inner-icon="mdi-lock" type="password"
                                                      v-model="auth.password"/>
                                        <v-btn outlined color="success" type="submit" :loading="loading">
                                            login
                                        </v-btn>
                                    </v-card-text>
                                </v-card>
                            </v-form>
                        </v-tab-item>
                        <v-tab-item>
                            <v-form ref="register" @submit.prevent="attempt_register" lazy-validation>
                                <v-card flat>
                                    <v-card-text>
                                        <v-text-field validate-on-blur label="Name" :rules="rules.required"
                                                      prepend-inner-icon="mdi-face" v-model="auth.name"/>
                                        <v-text-field validate-on-blur label="Email" :rules="rules.email"
                                                      prepend-inner-icon="mdi-email" v-model="auth.email"/>
                                        <v-text-field validate-on-blur label="Password" :rules="rules.required"
                                                      prepend-inner-icon="mdi-lock" type="password"
                                                      v-model="auth.password"/>
                                        <v-text-field validate-on-blur label="Confirm Password" :rules="rules.required"
                                                      prepend-inner-icon="mdi-lock" type="password"
                                                      v-model="auth.c_password"/>
                                        <v-btn outlined color="info" type="submit" :loading="loading">
                                            Register
                                        </v-btn>
                                    </v-card-text>
                                </v-card>
                            </v-form>
                        </v-tab-item>
                    </v-tabs-items>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {mapActions} from "vuex";
import {LOGIN, REGISTER} from "../store/constants/access_store";

export default {
    name: "LoginRegister",
    data: () => ({
        dialog: false,
        tab: null,
        loading: false,
        rules: {
            email: [
                v => !!v || 'Email is required',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            required: [
                v => !!v || 'Password is required'
            ]
        },
        auth: {
            email: null,
            password: null
        }
    }),
    watch: {
        dialog(n) {
            if (!n) {
                this.$refs.login ? this.$refs.login.reset() : null
                this.$refs.register ? this.$refs.register.reset() : null
            }
        }
    },
    methods: {
        ...mapActions({
            login: LOGIN,
            register: REGISTER
        }),
        attempt_login() {
            if (this.$refs.login.validate()) {
                this.loading = true
                this.login(this.auth)
                    .then(() => {
                        this.dialog = false
                    }).finally(() => {
                    this.loading = false
                })

            }
        },
        attempt_register() {
            if (this.$refs.register.validate()) {
                this.loading = true
                this.register(this.auth)
                    .then(() => {
                        this.dialog = false
                    }).finally(() => {
                    this.loading = false
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
