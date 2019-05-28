@extends('default')
@section('title', 'Đăng kí khoá học')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <section class="team_wthree py-4" id="team">
            <div class="container py-lg-5">
                <div class="sec-main">
                    <span class="sub-line">Đăng ký khóa học</span>
                </div>
                <hr>
                <h5>Bạn chưa đăng ký khóa học này, làm theo hướng dẫn dưới đây để đăng ký học "Khóa học cơ bản lớp 1" </h5>
                <br>
                <div style="background-color: #cccccc7a; padding: 10px">
                    <h5>Chuyển khoản tới số tài khoản 0293838391029 - Ngân hàng BIDV chi nhánh Hà Thành, Hà Nội</h5>
                    <br>
                    <h5>Số tiền chuyển khoản chuyển khoản: 1 000 000 đồng</h5>
                    <br>
                    <h5>Nội dung chuyển khoản:</h5>
                    <br>
                    <h5 style="font-style: italic;">[Dang ky khoa 1001 So dien thoai 0987654321]</h5>
                    <br>
                    <h5>Để kích hoạt khóa học cho tài khoản của bạn</h5>
                </div>
                <br>
                <div style="background-color: #cccccc7a; padding: 10px">
                    <h5>Khóa học sẽ được kích hoạt sau khi chuyển tiền từ 1 đến 2 giờ (trong giờ hành chỉnh). Bạn sẽ nhận được mail thông báo khi khóa học được kích hoạt.</h5>
                    <h5>Liên lạc hỗ trợ: 0978654321. Hoặc chat qua ứng dụng Facebook.</h5>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ "js/login.js" }}"></script>
    <script type="text/javascript">
        <?php if(!empty($id)){ ?>
        $('html,body').animate({
            scrollTop: $("#lop<?php echo $id?>").offset().top
        }, 1000);
        <?php } ?>
        <?php if(session()->has('messages')){?>
        toastr.error("{{ session('messages') }}");
        <?php }?>

    </script>

@endsection
