import axios from 'axios'
import Cookie from 'js-cookie'
import {BASE_URL} from "../constants/config";

axios.defaults.baseURL = BASE_URL
if (Cookie.get('token'))
    axios.defaults.headers['Authorization'] = `Bearer ${Cookie.get('token')}`
