class Notification {

    success(msg = '') {
        let message = msg ? msg : 'Successfully Done!';
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: message,
            timeout: 1000,
        }).show();
    }

    alert(msg = '') {
        let message = msg ? msg : 'Are you Sure?';
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: message,
            timeout: 1000,
        }).show();
    }

    error(msg = '') {
        let message = msg ? msg : 'Something Went Wrong ! ';
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: message,
            timeout: 1000,
        }).show();
    }

    warning(msg = '') {
        let message = msg ? msg : 'Opps Wrong!';
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: message,
            timeout: 1000,
        }).show();
    }
}

export default Notification = new Notification()
