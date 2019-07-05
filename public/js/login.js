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
var changePassword= (function () {
    return {
        create: function () {
            dialog.close();
            btn_loading.loading("body");
            $.get('/student/change-password', null, function (result) {
                btn_loading.hide("body");
                dialog.show('Đổi mật khẩu', result);
            });
        }
    };
})();
var comment= (function () {
    return {
        create: function () {
            dialog.close();
            btn_loading.loading("body");
            $.get('/student/comment', null, function (result) {
                btn_loading.hide("body");
                dialog.show('Để lại cảm nghĩ về trang web', result);
            });
        }
    };
})();
var avatarHelper = (function () {
    return {
        editAvatar: function (id) {
            btn_loading.loading("body");
            $.get('/student/change-avatar/'+id, null, function (result) {
                btn_loading.hide("body");
                dialog.show('Đổi ảnh đại diện', result);
            });
        },
    };
})();

