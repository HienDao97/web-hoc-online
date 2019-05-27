var login = (function () {
    return {
        create: function () {
            btn_loading.loading("body");
            $.get('/login', null, function (result) {
                btn_loading.hide("body");
                dialog.show('Đăng nhập', result);
            });
        }
    };
})();
var register = (function () {
    return {
        create: function () {
            btn_loading.loading("body");
            $.get('/register', null, function (result) {
                btn_loading.hide("body");
                dialog.show('Đăng ký tài khoản', result);
            });
        }
    };
})();
var forgotPassword= (function () {
    return {
        create: function () {
            dialog.close();
            btn_loading.loading("body");
            $.get('/forgot-password', null, function (result) {
                btn_loading.hide("body");
                dialog.show('Đăng ký tài khoản', result);
            });
        }
    };
})();

