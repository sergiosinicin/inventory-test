class Token {
    isValid(token){
        const payload = this.payload(token);

        if(payload) {
            let login_url = window.location.origin + "/api/auth/login";
            let register_url = window.location.origin + "/api/auth/register";

            return payload.iss = !!(login_url || register_url);
        }

        return false;
    }

    payload(token) {

        const payload = token.split('.')[1];

        return this.decode(payload);
    }

    decode(payload) {
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();
