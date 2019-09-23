@extends('default')
@section('title', 'Thông tin học sinh')
@section('content')
    <link rel="icon" href="{{ asset('web/images/logo-3.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="w3-content w3-margin-top" style="max-width:1400px;">

            <!-- The Grid -->
            <div class="w3-row-padding container">

                <!-- Left Column -->
                <div class="w3-third">

                    <div class="w3-white w3-text-grey w3-card-4">
                        <div class="w3-display-container">
                            @php
                                $avatar = !empty($student->avatar) ? $student->avatar : "logo-3.png"
                            @endphp
                            <img src="{{ asset("img/".$avatar) }}" style="width:100%" alt="Vishnu">
                            <div class="w3-display-bottomleft w3-container w3-text-white">
                                <h2 style="text-shadow: 2px 0 0 #248ab2, -2px 0 0 #248ab2, 0 2px 0 #248ab2, 0 -2px 0 #248ab2, 1px 1px #248ab2, -1px -1px 0 #248ab2, 1px -1px 0 #248ab2, -1px 1px 0 #248ab2; font-size: 26px">{{ $student->name }}</h2>
                            </div>
                        </div>
                        <br>
                        <div class="w3-container">

                            <!--   Upload file -->
                            <input type="file" id="file" style="display:none;" />
                            <button type="button" class="btn btn-primary" style="font-size: 13px;color: rgba(58, 133, 191, 0.75);letter-spacing: 1px;line-height: 15px; border: 2px solid rgba(58, 133, 191, 0.75);  border-radius: 40px;  background: transparent;  transition: all 0.3s ease 0s; margin-right: 5px; margin-bottom: 5px" value="Upload" onclick="return avatarHelper.editAvatar({{ $student->id }})">Đổi ảnh đại diện</button>
                            <script>
                                function thisFileUpload() {
                                    document.getElementById("file").click();
                                };
                            </script>
                            <!--  End of Upload file -->


                            <button type="button" class="btn btn-primary" style="font-size: 13px;color: rgba(58, 133, 191, 0.75);letter-spacing: 1px;line-height: 15px; border: 2px solid rgba(58, 133, 191, 0.75);  border-radius: 40px;  background: transparent;  transition: all 0.3s ease 0s; margin-right: 5px; margin-bottom: 5px" onclick="return changePassword.create()">Đổi mật khẩu</button>

                            <button type="button" class="btn btn-primary" style="font-size: 13px;color: rgba(58, 133, 191, 0.75);letter-spacing: 1px;line-height: 15px; border: 2px solid rgba(58, 133, 191, 0.75);  border-radius: 40px;  background: transparent;  transition: all 0.3s ease 0s; margin-right: 5px; margin-bottom: 5px" onclick="return comment.create()">Để lại cảm nghĩ về trang web</button>

                            <hr>
                            <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $student->email }}</p>
                            <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $student->mobile }}</p>

                            <hr>

                            <div style="margin-bottom: 10px">
                                <p class="w3-large w3-text-theme"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Khóa học</b></p>
                                @foreach($studentClass as $key => $value)
                                    @foreach($value as $k => $v)
                                        <p>{{ $key }} - {{ $v->classroom_name }}</p>
                                        {{--<div class="w3-light-grey w3-round-xlarge">--}}
                                            {{--<div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>--}}
                                        {{--</div>--}}
                                    @endforeach
                                @endforeach
                            </div>
                            <hr>

                            <div style="margin-bottom: 10px">
                                <p class="w3-large w3-text-theme"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Điểm trung bình</b></p>
                                @foreach($studentClass as $key => $value)
                                    @foreach($value as $k => $v)
                                        <p>{{ $key }} - {{ $v->classroom_name }}</p>
                                        @php
                                            $exercise = $classExercise->where('classroom_id', $v->class_room_id);
                                            $sumpoint = 0;
                                            $count = 0;
                                            if(!empty($exercise)){
                                                foreach ($exercise as $ex){
                                                    $sumpoint += $ex->point;
                                                    $count++;
                                                }
                                            }
                                        @endphp
                                        <div class="w3-light-grey w3-round-xlarge">
                                            <div class="w3-round-xlarge w3-center w3-teal" style="height:24px;width:100%">{{ ($count == 0 ) ? 0 : round($sumpoint/$count, 3) }}</div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <hr>

                        </div>
                    </div><br>

                    <!-- End Left Column -->
                </div>

                <!-- Right Column -->
                <div class="w3-twothird">
                    <div class="w3-container w3-card-2 w3-white w3-margin-bottom"><br>
                        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Kết quả học</b></p>
                        <div class="container-full-width">
                            <div class="col-sm-6" style="background-color: white;">
                                @foreach($studentClass as $key => $value)
                                    <h5 class="w3-opacity"><b><span class="glyphicon glyphicon-share-alt"></span>{{ $key }}</b></h5>
                                    @foreach($value as $k => $v)
                                        <p>{{ $v->classroom_name }}</p>
                                        @php
                                            $studentTheoryCount = \App\Models\ClassroomUnitExercise::where('classroom_id', $v->class_room_id)->count();
                                            $max = \App\Models\Theory::where('classroom_id', $v->class_room_id)->count();
                                        @endphp
                                        <div class="w3-light-grey w3-round-xlarge w3-small">
                                            <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:{{ ($max == 0) ? 100 :round($studentTheoryCount/$max, 3) * 100 }}%">{{ ($max == 0) ? 100 :round($studentTheoryCount/$max, 3) * 100 }}%</div>
                                        </div>
                                    @endforeach
                                @endforeach
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Grid -->
            </div>

            <!-- End Page Container -->
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
@endsection


