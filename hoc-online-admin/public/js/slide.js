var slideHelper = (function () {
    return {
        editSlide: function (id, check) {
            btn_loading.loading("post_table");
            $.ajax({
                method: 'GET',
                url: '/project-laravel/public/product/editSlide',
                data:{
                    'id': id,
                    'check': check
                },
                success: function (result) {
                    if (result.result == 1) {
                        alert(result.message);
                        btn_loading.hide("post_table");
                        window.location.reload();
                    } else {
                        alert(result.message);
                    }
                }
            })
        },
        createSlide: function (id) {
            btn_loading.loading("post_table");
            $.get('/project-laravel/public/product/createSlide/'+id, null, function (result) {
                btn_loading.hide("post_table");
                dialog.show('Slide', result);
            });
        },
        list: function (id) {
            btn_loading.loading("comment_table");
            $.get('/project-laravel/public/product/comment/list/'+id, null, function (result) {
                btn_loading.hide("comment_table");
                dialog.show('Bình luận', result);
            });
        },
        delete: function (id,isChild,_this) {
            var confirm = window.confirm("Bạn có muốn xóa bình luận này không ?");
            if(confirm == true){
                if(isChild == 1){
                    btn_loading.loading("form-input");
                }
                else{
                    btn_loading.loading("comment_table");
                }
                $.get('/project-laravel/public/product/comment/del/'+id+'/'+isChild, null, function (result) {
                    $(_this).parent().parent().remove();
                    if(isChild == 1){
                        alert("Xóa thành công");
                        if($("tbody tr").length <= 0){
                            window.location.reload();
                        }
                        btn_loading.hide("form-input");
                    }
                    else{
                        alert("Xóa thành công");
                        btn_loading.hide("comment_table");
                    }
                });
            }
        }
    };
})();
