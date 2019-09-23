var slideHelper = (function () {
    return {
        editSlide: function (id) {
            btn_loading.loading("post_table");
            $.get('/public/slide/edit/'+ id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Slide', result);
            });
        },
        createSlide: function () {
            btn_loading.loading("post_table");
            $.get('/public/slide/create', null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Slide', result);
            });
        },
    };
})();
var commentHelper = (function () {
    return {
        edit: function (id) {
            btn_loading.loading("post_table");
            $.get('/public/comment/edit/'+ id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Comment', result);
            });
        },
    };
})();
