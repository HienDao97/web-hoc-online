<p style="color: #80cd33">{{ $text }}</p>
<p>Số câu đúng: <b style="color: #00bcd4;">{{ $point }}/{{ count($answers) }}</b> câu</p>
<p>Điểm: <b style="color: #00bcd4">{{ round($point/count($answers), 3) * 10 }}</b></p>
<p></p>
<p><b>Đáp án:<b></p>
<p class="room-question-answers">
    @for ($i = 0; $i < count($answers); $i++)
        @if($answers[$i] == $params['answer'][$i][0])
            <span style="color: #80cd33">{{ $i + 1 }}. {{ $list_answer[$answers[$i]] }}</span>
        @else
            <span style="color: #dd4b39">{{ $i + 1 }}. {{ $list_answer[$answers[$i]] }}</span>
        @endif
    @endfor
</p>
<!-- Button colse when this is not the last lesson -->
<div class="complete-button">
    <button type="button" class="btn bg-theme mt-4 w3_pvt-link-bnr scroll bg-theme3 text-white" data-dismiss="modal" aria-label="Close">Đã hiểu</button>
</div>
