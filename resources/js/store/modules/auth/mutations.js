import {SET_AUTH, SET_TOKEN} from "../../constants/mutations";

export default {
    [SET_AUTH](state, auth) {
        state.auth = auth;
    },
    [SET_TOKEN](state, token) {
        state.token = token
    }
}
