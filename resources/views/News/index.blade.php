@extends('default')
@section('title', 'Tin tức')
@section('content')
    <link href="{{ asset('web/css/tin-tuc.css') }}" type="text/css" rel="stylesheet" media="all">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('web/js/tintuc.js') }}"></script>      
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <div class="container" style="max-width: 80%">
            <div class="row" style="margin-top: 1em">
                @foreach($news as $new)
                    <div class="col-lg-4 col-md-6">
                        <div class="post-module">
                            <div class="thumbnail">
                                <img src="{{ env("ADMIN_APP_URL") . "/img/posts/{$new->thumbnail}" }}">
                            </div>
                            <div class="post-content">
                                <div class="category">TIN TỨC</div>
                                <h1 class="title"><a href="" style="color: #0f6eaa">{{ $new->title }}</a></h1>
                                <h2 class="sub_title"><a href="{{ route('home.news.detail', $new->slug) }}" style="color: #e74c3c">Xem tiếp ...</a></h2>
                                <p class="description" style="display: none; height: 75px; opacity: 1;">{{ $new->summary }}:</p>
                                <div class="post-meta"><span class="timestamp"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($new->created_at)->format("Y-m-d") }}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')


@endsection
