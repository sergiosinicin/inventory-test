import Token from './Token';
import AppStorage from './AppStorage';

class User {
    responseAfterLogin(response) {
        const access_token = response.data.access_token;
        const username = response.data.name;

        if(Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
        }
    }

    hasToken() {
        const storeToken = localStorage.getItem('token');
        console.log(storeToken);
        if(storeToken) {
            return !!Token.isValid(storeToken);
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    name() {
        if(this.loggedIn()) {
  		return localStorage.getItem('user');
        }
    }

    id() {
        if(this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub;
        }

        return false;
    }
}

export default User = new User();
