import {AUTH, FILMS} from "./stores";
import {GET_AUTH, GET_ITEM, GET_ITEMS, GET_TOKEN} from "./getters";
import {
    COMMENT_ACTION,
    FETCH_AUTH,
    FETCH_ITEM,
    FETCH_ITEMS,
    LOGIN_ACTION,
    LOGOUT_ACTION,
    REGISTER_ACTION, SAVE_ACTION
} from "./actions";


// AUTH
export const AUTHENTICATED_USER = `${AUTH}/${GET_AUTH}`
export const AUTHENTICATED_TOKEN = `${AUTH}/${GET_TOKEN}`
export const FETCH_AUTHENTICATED_USER = `${AUTH}/${FETCH_AUTH}`
export const LOGIN = `${AUTH}/${LOGIN_ACTION}`
export const LOGOUT = `${AUTH}/${LOGOUT_ACTION}`
export const REGISTER = `${AUTH}/${REGISTER_ACTION}`


// FILMS
export const FETCH_FILMS = `${FILMS}/${FETCH_ITEMS}`
export const FETCH_FILM = `${FILMS}/${FETCH_ITEM}`
export const COMMENT = `${FILMS}/${COMMENT_ACTION}`
export const SAVE_FILM = `${FILMS}/${SAVE_ACTION}`

export const GET_FILMS = `${FILMS}/${GET_ITEMS}`
export const GET_FILM = `${FILMS}/${GET_ITEM}`
