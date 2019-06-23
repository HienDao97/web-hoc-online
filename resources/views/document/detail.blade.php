@extends('default')
@section('title', 'Tài liệu')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <section class="team_wthree py-4" id="team">
            <div class="container py-lg-5">
                <div class="sec-main">
                    <span class="sub-line">Tài liệu {{ $course->name }}</span>
                </div>
                @if(count($items) > 0)
                    <div class="container-grid py-4 py-lg-5">
                    @if(count($items)%3 == 0)
                        @foreach($items as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="team-text bg-theme{{ $course->id }}">
                                    <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                    <span class="my-2 d-block">{{ $item->title }}</span>
                                    <p>{{ $item->description }}</p>
                                    <hr>
                                    <div class="footerv4-social d-flex align-items-center">
                                        <a href="{{ $item->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif(count($items)%3 == 1)
                        @foreach($items as $key => $value)
                            @if($key < count($items) - 1)
                                <div class="col-lg-4 col-md-6">
                                    <div class="team-text bg-theme{{ $course->id }}">
                                        <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                        <span class="my-2 d-block">{{ $value->title }}</span>
                                        <p>{{ $value->description }}</p>
                                        <hr>
                                        <div class="footerv4-social d-flex align-items-center">
                                            <a href="{{ $value->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-md-12">
                            <div class="team-text bg-theme{{ $course->id }}">
                                <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                <span class="my-2 d-block">{{ $items[count($items) - 1]->title }}</span>
                                <p>{{ $items[count($items) - 1]->description }}</p>
                                <hr>
                                <div class="footerv4-social d-flex align-items-center">
                                    <a href="{{ $items[count($items) - 1]->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                </div>
                            </div>
                        </div>
                    @elseif(count($items)%3 == 2)
                        @foreach($items as $key => $value)
                            @if($key < count($items) - 2)
                                <div class="col-lg-4 col-md-6">
                                    <div class="team-text bg-theme{{ $course->id }}">
                                        <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                        <span class="my-2 d-block">{{ $value->title }}</span>
                                        <p>{{ $value->description }}</p>
                                        <hr>
                                        <div class="footerv4-social d-flex align-items-center">
                                            <a href="{{ $value->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-md-6">
                            <div class="team-text bg-theme{{ $course->id }}">
                                <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                <span class="my-2 d-block">{{ $items[count($items) - 2]->title }}</span>
                                <p>{{ $items[count($items) - 2]->description }}</p>
                                <hr>
                                <div class="footerv4-social d-flex align-items-center">
                                    <a href="{{ $items[count($items) - 2]->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="team-text bg-theme{{ $course->id }}">
                                <h4 class="text-theme{{ $course->id }}">{{ $course->name }}</h4>
                                <span class="my-2 d-block">{{ $items[count($items) - 1]->title }}</span>
                                <p>{{ $items[count($items) - 1]->description }}</p>
                                <hr>
                                <div class="footerv4-social d-flex align-items-center">
                                    <a href="{{ $items[count($items) - 1]->link }}" onclick="redirect($(this), event)"><button type="button" class="btn btn-outline-secondary"> Tải xuống</button></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>

                @else
                @endif
                {{ $items->links() }}
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

