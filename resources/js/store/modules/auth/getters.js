import {GET_AUTH, GET_TOKEN} from "../../constants/getters";

export default {
    [GET_AUTH] (state) {
        return state.auth
    },
    [GET_TOKEN] (state) {
        return state.token
    }
}
