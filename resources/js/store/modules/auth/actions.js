import axios from "axios";
import moment from 'moment'
import Cookie from 'js-cookie'
import {FETCH_AUTH, LOGIN_ACTION, LOGOUT_ACTION, REGISTER_ACTION} from "../../constants/actions";
import {SET_AUTH, SET_TOKEN} from "../../constants/mutations";

export default {
    [REGISTER_ACTION](context, payload) {
        return new Promise(((resolve, reject) => {
            axios.post('register', payload).then(({data}) => {
                context.dispatch("loginRegister", data).then(() => {
                    resolve(data)
                })
                resolve(data)
            }).catch(() => reject())
        }))
    },
    [LOGIN_ACTION](context, auth) {
        return new Promise(((resolve, reject) => {
            axios.post('login', auth).then(({data}) => {
                context.dispatch("loginRegister", data).then(() => {
                    resolve(data)
                })
            }).catch(() => reject())
        }))
    },
    [LOGOUT_ACTION](context) {
        return new Promise((resolve) => {
            Cookie.remove("token");
            delete axios.defaults.headers['Authorization']
            context.commit(SET_TOKEN, null);
            context.commit(SET_AUTH, {});
            resolve();
        });
    },
    [FETCH_AUTH](context) {
        return new Promise(((resolve, reject) => {
            axios.get('user').then(({data}) => {
                context.commit(SET_AUTH, data)
                resolve(data)
            }).catch(() => {
                reject()
            })
        }))
    },
    loginRegister(context, data) {
        return new Promise((resolve => {
            Cookie.set(
                'token',
                data.accessToken,
                {
                    path: '',
                    sameSite: 'strict',
                    expires: Math.round(moment.duration(moment(data.expires_at).diff(moment(new Date()))).asDays())
                }
            )
            axios.defaults.headers['Authorization'] = `Bearer ${Cookie.get('token')}`
            context.commit(SET_TOKEN, data.accessToken)
            resolve()
        }))

    }
}
