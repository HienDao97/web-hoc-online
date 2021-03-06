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
                                                    {{ $course->class_info }}
                                                </p>

                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                @endphp
                                                @if(!empty(Auth::user()->id))
                                                    @php
                                                        $check = 0;
                                                        $check_date = 0;
                                                    @endphp
                                                    @if(!empty($student_class))
                                                        @foreach($student_class as $cl)
                                                            @if($class->id == $cl->class_room_id)
                                                                @php
                                                                    $cl_st = $cl;
                                                                    $check = 1;
                                                                @endphp
                                                            @endif
                                                            @if(!empty($cl_st->start_date) && !empty($cl_st->end_date))
                                                                @if($now->gt($cl_st->start_date) && $cl_st->end_date->gt($now))
                                                                    @php
                                                                        $check_date = 1;
                                                                    @endphp
                                                                @endif
                                                            @else
                                                                @php
                                                                    $check_date = 1;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if(!empty(Auth::user()->id) && ($check_date || $class->type == 0))
                                                        <a href="{{ route('student.classroom', $class->id) }}" class="text-capitalize servgrid_link btn">Vào học</a>
                                                    @else
                                                        <a href="#" onclick="return login.create()" class="text-capitalize servgrid_link btn">Vào học</a>
                                                    @endif

                                                    @if($class->type == 0)
                                                        <hr>
                                                        <div class="cost">
                                                            <p style="font-size: 16px">Miễn phí</p>
                                                        </div>
                                                    @else
                                                        @if($check == 0)
                                                            <hr>
                                                            @if(empty($class->sale))
                                                                <div class="cost">
                                                                    <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                                </div>
                                                            @else
                                                                <div class="cost-sale">
                                                                    <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                                </div>
                                                                <div class="sale left-sale">
                                                                    <p style="font-size: 16px">GIẢM GIÁ</p><p style="font-size: 20px">{{ round($class->sale/$class->tuition, 3) * 100 }}%</p>
                                                                </div>
                                                                <div class="sale right-sale">
                                                                    @php
                                                                        $end_date = \Carbon\Carbon::parse($class->end_date);

                                                                        $start_date = \Carbon\Carbon::parse($class->begin_date);

                                                                        $diff = $end_date->diffInDays($now);
                                                                    @endphp
                                                                    <p style="font-size: 16px">CÒN</p><p style="font-size: 20px">{{ $diff }} ngày</p>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @php
                                                                $end_date = \Carbon\Carbon::parse($cl_st->class->end_date);

                                                                $start_date = \Carbon\Carbon::parse($cl_st->class->begin_date);

                                                                $diff = $end_date->diffInDays($now);
                                                            @endphp
                                                            @if($now->gt($start_date) && $end_date->gt($now))
                                                            @else
                                                                @if(empty($class->sale))
                                                                    <div class="cost">
                                                                        <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                                    </div>
                                                                @else
                                                                    <div class="cost-sale">
                                                                        <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                                    </div>
                                                                    <div class="sale left-sale">
                                                                        <p style="font-size: 16px">GIẢM GIÁ</p><p style="font-size: 20px">{{ round($class->sale/$class->tuition, 3) * 100 }}%</p>
                                                                    </div>
                                                                    <div class="sale right-sale">
                                                                        @php
                                                                            $end_date = \Carbon\Carbon::parse($class->end_date);

                                                                            $start_date = \Carbon\Carbon::parse($class->begin_date);

                                                                            $diff = $end_date->diffInDays($now);
                                                                        @endphp
                                                                        <p style="font-size: 16px">CÒN</p><p style="font-size: 20px">{{ $diff }} ngày</p>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    <a href="#" onclick="return login.create()" class="text-capitalize servgrid_link btn">Vào học</a>
                                                    @if($class->type == 0)
                                                        <hr>
                                                        <div class="cost">
                                                            <p style="font-size: 16px">Miễn phí</p>
                                                        </div>
                                                    @else
                                                        <hr>
                                                        @if(empty($class->sale))
                                                            <div class="cost">
                                                                <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                            </div>
                                                        @else
                                                            <div class="cost-sale">
                                                                <p style="font-size: 16px">{{ number_format($class->tuition) }}Đ</p>
                                                            </div>
                                                            <div class="sale left-sale">
                                                                <p style="font-size: 16px">GIẢM GIÁ</p><p style="font-size: 20px">{{ round($class->sale/$class->tuition, 3) * 100 }}%</p>
                                                            </div>
                                                            <div class="sale right-sale">
                                                                <p style="font-size: 16px">CÒN</p><p style="font-size: 20px">{{ $diff }} ngày</p>
                                                            </div>
                                                        @endif
                                                    @endif
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
