@extends('default')
@section('title', 'Tài liệu')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <section class="team_wthree py-4" id="team">
            <div class="container py-lg-5">
                <div class="sec-main">
                    <span class="sub-line">Tài liệu {{ $course->name }}</span>
                </div>
                <div class="container-grid py-4 py-lg-5">
                    @foreach($items as $item)
                        {{--<div class="col-lg-4 col-md-6">--}}
                            {{--<div class="team-text bg-theme1">--}}
                                {{--<h4 class="text-theme2">{{ $course->name }}</h4>--}}
                                {{--<span class="my-2 d-block">{{ $item->title }}</span>--}}
                                {{--<p>{{ $item->description }}</p>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            {{--<div class="footerv4-social d-flex align-items-center">--}}
                                {{--<a href="{{ $item->link }}"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="team-text bg-theme3">
                            <h4 class="text-theme3">{{ $course->name }}</h4>
                            <span class="my-2 d-block">{{ $item->title }}</span>
                            <p>{{ $item->description }}</p>
                            <hr>
                            <div class="footerv4-social d-flex align-items-center">
                                <a href="{{ $item->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                            </div>
                        </div>
                    @endforeach
                    {{ $items->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
<script type="text/javascript">
    function redirect(_this, e) {
        e.preventDefault();
        var link  = $(_this).attr("href");
        window.open(link);
    }
</script>

