@extends('default')
@section('title', 'Tin tức')
@section('content')
    <link href="{{ asset('web/css/tin-tuc.css') }}" type="text/css" rel="stylesheet" media="all">
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="container" style="max-width: 80%">
            <div class="post-wrapper" style="margin-bottom: 50px">
                <div class="w3-display-container">
                    <img src="{{ env("ADMIN_APP_URL") . "/img/posts/{$new_detail->images}" }}" style="width:100%; max-height: 400px; object-fit: cover;" alt="Vishnu">
                    <div class="w3-display-bottomleft w3-container w3-text-white">
                        <h2 style="text-shadow: 4px 0 0 #248ab2, -4px 0 0 #248ab2, 0 4px 0 #248ab2, 0 -4px 0 #248ab2, 2px 2px #248ab2, -2px -2px 0 #248ab2, 2px -2px 0 #248ab2, -2px 2px 0 #248ab2; font-size: 35px; text-transform: uppercase;">{{ $new_detail->title }}</h2>
                    </div>
                </div>
                <hr>
                <p>
                    <?php echo $new_detail->data?>
                </p>

            </div>
        </div>
    </div>
@endsection
@section('scripts')


@endsection
