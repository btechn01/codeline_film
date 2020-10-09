import {PUSH_COMMENT_TO_ITEM, SET_ITEM, SET_ITEMS} from "../../constants/mutations";

export default {
    [SET_ITEMS](state, items) {
        state.items = items;
    },
    [SET_ITEM](state, item) {
        state.item = item
    },
    [PUSH_COMMENT_TO_ITEM](state, comment) {
      state.item.comments.push(comment)
    }
}
