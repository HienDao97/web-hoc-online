@extends('default')
@section('title', 'Góc phụ huynh')
@section('content')
    <link rel="icon" href="{{ asset('web/images/logo-3.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="w3-content w3-margin-top" style="max-width:1400px;">

            <!-- The Grid -->
            <div class="w3-row-padding">

                <!-- Left Column -->
                <div class="w3-third">

                    <div class="w3-white w3-text-grey w3-card-4">
                        <div class="w3-display-container">
                            <img src="https://scontent-hkg3-1.xx.fbcdn.net/v/t31.0-8/28516773_1329146550518162_4611222763409806500_o.jpg?_nc_cat=105&_nc_oc=AQkKisPKJlwS6ONPUOp1pjKvFOCgyUtyNhRa0bWfxIACm9Lqqn_RZVPZQJtopVxH1wC0RQnFgM3CgkGjZKGfveez&_nc_ht=scontent-hkg3-1.xx&oh=20895158d43156a6438f26c84ea42806&oe=5D558C4B" style="width:100%" alt="Vishnu">
                            <div class="w3-display-bottomleft w3-container w3-text-white">
                                <h2>{{ $student->name }}</h2>
                            </div>
                        </div>
                        <br>
                        <div class="w3-container">

                            <!--   Upload file -->
                            <input type="file" id="file" style="display:none;" />
                            <button type="button" class="btn btn-primary" style="font-size: 13px;color: rgba(58, 133, 191, 0.75);letter-spacing: 1px;line-height: 15px; border: 2px solid rgba(58, 133, 191, 0.75);  border-radius: 40px;  background: transparent;  transition: all 0.3s ease 0s; margin-right: 5px; margin-bottom: 5px" value="Upload" onclick="thisFileUpload();">Đổi ảnh đại diện</button>
                            <script>
                                function thisFileUpload() {
                                    document.getElementById("file").click();
                                };
                            </script>
                            <!--  End of Upload file -->


                            <button type="button" class="btn btn-primary" style="font-size: 13px;color: rgba(58, 133, 191, 0.75);letter-spacing: 1px;line-height: 15px; border: 2px solid rgba(58, 133, 191, 0.75);  border-radius: 40px;  background: transparent;  transition: all 0.3s ease 0s; margin-right: 5px; margin-bottom: 5px" onclick="return changePassword.create()">Đổi mật khẩu</button>
                            <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $student->email }}</p>
                            <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ $student->mobile }}</p>

                            <hr>

                            <div style="margin-bottom: 10px">
                                <p class="w3-large w3-text-theme"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Khóa học</b></p>
                                <p>Khóa cơ bản lớp 1</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                                </div>
                                <p>Khóa nâng cao lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
                                </div>
                                <p>Khóa cơ bản lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                                </div>
                                <p>Khóa luyện đề lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                                </div>
                            </div>
                            <hr>

                            <div style="margin-bottom: 10px">
                                <p class="w3-large w3-text-theme"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Điểm trung bình</b></p>
                                <p>Khóa cơ bản lớp 1</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-center w3-teal" style="height:24px;width:100%">10.0</div>
                                </div>
                                <p>Khóa nâng cao lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-center w3-teal" style="height:24px;width:55%">5.5</div>
                                </div>
                                <p>Khóa cơ bản lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-center w3-teal" style="height:24px;width:25%">2.5</div>
                                </div>
                                <p>Khóa luyện đề lớp 2</p>
                                <div class="w3-light-grey w3-round-xlarge">
                                    <div class="w3-round-xlarge w3-center w3-teal" style="height:24px;width:25%">2.5</div>
                                </div>
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

                                <h5 class="w3-opacity"><b><span class="glyphicon glyphicon-share-alt"></span> Khóa cơ bản lớp 1</b></h5>
                                <p>Bài 1</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:70%">70%</div>
                                </div>

                                <p>Bài 2</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:60%">60%</div>
                                </div>

                                <p>Bài 3</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:70%">70%</div>
                                </div>

                                <p>Bài 4</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:40%">40%</div>
                                </div>

                                <p>Bài 5</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:40%">40%</div>
                                </div>

                                <p>Bài 6</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                                </div>
                                <br>
                            </div>
                            <div class="col-sm-6">

                                <h5 class="w3-opacity"><b><span class="glyphicon glyphicon-share-alt"></span> Khóa nâng cao lớp 2</b></h5>

                                <p>Bài 1</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:65%">65%</div>
                                </div>

                                <p>Bài 2</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
                                </div>

                                <p>Bài 3</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:60%">60%</div>
                                </div>

                                <p>Bài 4</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:65%">65%</div>
                                </div>

                                <p>Bài 5</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:60%">60%</div>
                                </div>

                                <p>Bài 6</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                                </div>

                                <p>Bài 7</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:65%">65%</div>
                                </div>

                                <br>
                            </div>
                        </div>

                        <div class="container-full-width">
                            <div class="col-sm-6">
                                <h5 class="w3-opacity"><b><span class="glyphicon glyphicon-share-alt"></span> Khóa cơ bản lớp 2</b></h5>

                                <p>Bài 1</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:70%">70%</div>
                                </div>

                                <p>Bài 2</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                                </div>
                                <br>

                            </div>
                            <div class="col-sm-6">
                                <h5 class="w3-opacity"><b><span class="glyphicon glyphicon-share-alt"></span> Khóa luyện đề lớp 2</b></h5>

                                <p>Bài 1</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:60%">60%</div>
                                </div>

                                <p>Bài 2</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                                </div>

                                <p>Bài 3</p>
                                <div class="w3-light-grey w3-round-xlarge w3-small">
                                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:30%">30%</div>
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>

                    <!-- End Right Column -->
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


