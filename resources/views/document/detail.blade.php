@extends('default')
@section('title', 'Tài liệu')
@section('content')
    <div class="portfolio-wthree py-lg-5" id="portfolio" style="background-color: #eee">
        <section class="team_wthree py-4" id="team">
            <div class="container py-lg-5">
                <div class="sec-main">
                    <span class="sub-line">Tài liệu {{ $course->name }}</span>
                </div>
                <div class="mw-container">
                    <table style="border-radius: 10px">
                        <thead>
                        <tr>
                            <th style="text-align: center; border-radius: 10px">Danh sách tài liệu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $key => $value)
                            <tr>
                                <td><a href="{{ $value->link }}" style="color: white" onclick="redirect($(this), event)">{{ $value->description }}</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
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

