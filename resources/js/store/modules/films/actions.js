import axios from "axios";
import {COMMENT_ACTION, FETCH_ITEM, FETCH_ITEMS, SAVE_ACTION} from "../../constants/actions";
import {PUSH_COMMENT_TO_ITEM, SET_ITEM, SET_ITEMS} from "../../constants/mutations";

export default {
    [FETCH_ITEMS](context) {
        return new Promise(((resolve) => {
            axios.get('/films')
                .then(({data}) => {
                    context.commit(SET_ITEMS, data)
                    resolve(data)
                })
        }))
    },
    [FETCH_ITEM](context, payload) {
        return new Promise((resolve) => {
            axios.get(`/films/${payload}`)
                .then(({data}) => {
                    context.commit(SET_ITEM, data)
                    resolve(data);
                })

        });
    },
    [COMMENT_ACTION](context, payload) {
        return new Promise((resolve, reject) => {
            axios.post('comment', payload).then(({data}) => {
                context.commit(PUSH_COMMENT_TO_ITEM, data)
                resolve(data)
            }).catch(() => {
                reject()
            })
        })
    },
    [SAVE_ACTION](context, payload) {
        return new Promise(((resolve, reject) => {
            axios.post('films', payload, {
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
        }))
    }
}
