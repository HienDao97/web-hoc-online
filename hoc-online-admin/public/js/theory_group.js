var theoryGroupHelper = (function () {
    return {
        edit: function (id) {
            btn_loading.loading("post_table");
            $.get('/theory/group/edit/'+id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Sửa loại khoá học ', result);
            });
        },
        create: function () {
            btn_loading.loading("post_table");
            $.get('/theory/group/create', null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Tạo mới loại khoá học', result);
            });
        }
    };
})();
var classroomHelper = (function () {
    return {
        edit: function (id) {
            btn_loading.loading("post_table");
            $.get('/classroom/edit/'+id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Sửa lớp học', result);
            });
        },
        create: function () {
            btn_loading.loading("post_table");
            $.get('/classroom/create', null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Tạo mới lớp học', result);
            });
        }
    };
})();
var theoryHelper = (function () {
    return {
        edit: function (id) {
            btn_loading.loading("post_table");
            $.get('/theory/edit/'+id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Sửa bài học', result);
            });
        },
        create: function () {
            btn_loading.loading("post_table");
            $.get('/theory/create', null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Tạo mới bài học', result);
            });
        }
    };
})();
