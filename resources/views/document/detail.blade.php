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
                    <table style="margin-bottom: 10px">
                        <thead>
                        <tr>
                            <th style="text-align: center; ">Danh sách tài liệu</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($items) > 0)
                            @foreach($items as $key => $value)
                                <tr>
                                    <td><a href="{{ $value->link }}" data-id="{{ route('home.document.download', $value->id)  }}" style="color: white;margin-left: 20px" target="_blank" onclick="redirect($(this))">{{ $value->title }}</a></td>
                                </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
                {{ $items->links() }}
            </div>
        </section>
    </div>
@endsection
<script type="text/javascript">
    function redirect(_this) {
        var href = $(_this).data("id");
        $.ajax({
            type: "GET",
            data: {},
            url: href,
            success: function (result) {
                
            }

        })
    }
</script>

