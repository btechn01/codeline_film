import {GET_ITEM, GET_ITEMS} from "../../constants/getters";

export default {
    [GET_ITEMS](state) {
        return state.items
    },
    [GET_ITEM](state) {
        return state.item
    }
}
