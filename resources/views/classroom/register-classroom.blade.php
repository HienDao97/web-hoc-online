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
                <h5>Bạn chưa đăng kí khóa học, vui lòng làm theo hướng dẫn dưới đây để đăng kí khóa học "{{ $classroom->class_name }}" </h5>
                <br>
                <div style="background-color: #cccccc7a; padding: 10px">
                    <h5>Chuyển khoản tới 1 trong các số tài khoản sau</h5>
                    <br>
                    <h5>1) Số tài khoản NH Viettinbank: 100877955888(Chi nhánh Nam Thăng Long)– Chủ TK Vũ Tiến Thành</h5>
                    <br>
                    <h5>2) Số tài khoản NH BIDV : 11610000121056 (Chi nhánh Hoài Đức, HN)– Chủ TK Vũ Tiến Thành</h5>
                    <br>
                    <h5>Số tiền chuyển khoản chuyển khoản: {{ number_format($classroom->tuition - $classroom->sale) }} đồng</h5>
                    <br>
                    <h5>Nội dung chuyển khoản:</h5>
                    <br>
                    <h5 style="font-style: italic;">[Dang ky khoa {{ $classroom->code }} So dien thoai {{ Auth::user()->mobile }}]</h5>
                    <br>
                    <h5>Để kích hoạt khóa học cho tài khoản của bạn</h5>
                </div>
                <br>
                <div style="background-color: #cccccc7a; padding: 10px">
                    <h5>Vutienthanh.com sẽ tạo và kích hoạt tài khoản, sau đó gửi lại thông tin qua điện thoại (hoặc email) sau muộn nhất là 12 giờ.</h5>
                    <h5>Sau 12 giờ nếu PHHS chưa nhận được tin nhắn/email trả lời, vui lòng liên hệ số hotline 0976131472!</h5>
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
