import Cookie from 'js-cookie'
export default () => {
    return {
        token: Cookie.get('token') || "",
        auth: {}
    };
}
