@extends('default')
@section('title', 'Khoá học')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('messages')}}
        </div>
    @endif
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        @foreach($courses as $course)
            <div class="container pt-md-5 pt-4" style="padding-top: 0.5rem !important;">
                <div class="sec-main">
                    <a id="lop{{$course->id}}">
                        <span class="sub-line">{{ $course->name }}</span>
                    </a>
                </div>
                <div class="container" style="margin-bottom:  20px">
                    <div class="row">
                        @if(count($course->class) > 0)
                            @foreach($course->class as $class)
                                <a href="javascript:void(0)">
                                    <div class="col-lg-4">
                                        <div class="w3ls-servgrid card">
                                            <div class="card-header">
                                                <span class="sub-line">{{ $class->class_name }}</span>
                                            </div>
                                            <div class="card-block">
                                                <p class="card-title servgrid-title">
                                                    Cung cấp kiến thức về bảng cửu chương, cộng trừ nhân chia trong phạm vi 10.
                                                </p>
                                                @if(!empty(Auth::user()->id))
                                                    <a href="{{ route('student.classroom', $class->id) }}" class="text-capitalize servgrid_link btn">Vào học</a>
                                                @else
                                                    <a href="#" onclick="return login.create()" class="text-capitalize servgrid_link btn">Vào học</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <a href="javascript:void(0)">
                                <div class="col-lg-4">
                                    <div class="w3ls-servgrid card">
                                        <div class="card-header">
                                            <span class="sub-line">Không có lớp</span>
                                        </div>
                                        <div class="card-block">
                                            <p class="card-title servgrid-title">
                                                Lớp chưa mở
                                            </p>
                                            <a href="#portfolio" class="text-capitalize servgrid_link btn scroll"></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
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
