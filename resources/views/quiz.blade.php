@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
<link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
<style>
    @keyframes spinner {
        0% {
        transform: translate3d(-50%, -50%, 0) rotate(0deg);
        }
        100% {
        transform: translate3d(-50%, -50%, 0) rotate(360deg);
        }
    }

    .spin::before {
        animation: 1.5s linear infinite spinner;
        animation-play-state: inherit;
        border: solid 5px #cfd0d1;
        border-bottom-color: #1c87c9;
        border-radius: 50%;
        content: "";
        height: 20px;
        width: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%, 0);
        will-change: transform;
    }

    .spin .spin_text {
        opacity: 100;
    }
</style>
@endpush

@section('pageContent')

<!-- Page Content -->
<div class="prize-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
    </div>
</div>
<!-- start Quiz button -->
<div class="quiz__wrapper">
<div class="start_btn"><button>Mulai Quiz</button></div>
<!-- Info Box -->
<div class="info_box">
    <div class="info-title"><span>Some Rules of this Quiz</span></div>
    <div class="info-list">
        <div class="info">1. You will have only <span>5 seconds</span> per each question.</div>
        <div class="info">2. Once you select your answer, it can't be undone.</div>
        <div class="info">3. You can't select any option once time goes off.</div>
        <div class="info">4. You can't exit from the Quiz while you're playing.</div>
        <div class="info">5. You'll get points on the basis of your correct answers.</div>
    </div>
    <div class="buttons">
        <button class="quit">Exit Quiz</button>
        <div class="spinners">
            <button class="restart spin_text">Continue</button>
        </div>
    </div>
</div>
<!-- Quiz Box -->
<div class="quiz_box">
    <div class="quiz__header">
        <div class="title">Awesome Quiz Application</div>
        <div class="timer">
            <div class="time_left_txt">Time Left</div>
            <div class="timer_sec">05</div>
        </div>
        <div class="time_line"></div>
    </div>
    <section class="quiz__content">
        <div class="que_text">
            <!-- Here I've inserted question from JavaScript -->
        </div>
        <div class="option_list">
            <!-- Here I've inserted options from JavaScript -->
        </div>
    </section>
    <!-- footer of Quiz Box -->
    <div class="quiz__footer">
        <div class="total_que">
            <!-- Here I've inserted Question Count Number from JavaScript -->
        </div>
        <button class="next_btn">Next Que</button>
    </div>
</div>
<!-- Result Box -->
<div class="result_box">
    <div class="icon">
        <i class="fas fa-crown"></i>
    </div>
    <div class="complete_text">You've completed the Quiz!</div>
    <div class="score_text">
        <!-- Here I've inserted Score Result from JavaScript -->
    </div>
    <div class="buttons">
        <button class="restart">Replay Quiz</button>
        <button class="quit">Quit Quiz</button>
    </div>
</div>
</div>
@endsection

@push('scripts')

<script>
    {{-- let dataQues = '{!! $quiz !!}'; --}}
    let hrefQues = "{{ route('question', Auth::user()->username) }}";
    let hrefTries = "{{ route('tries', Auth::user()->username) }}";
    let hrefSave = "{{ route('quiz.save', Auth::user()->username) }}";

    function get_ques(statusQuiz){
        // let data = '';
        $.ajax({
            url: hrefQues,
            type: 'GET',
            async: false,
            success: function(result){
                settingQues(JSON.parse(result));
                checkTries(statusQuiz);
            },
            error: function(e){
                console.log(e);
            }
        });
        // $.get(href, function(result){
        //     set_ques(JSON.parse(result));
        //     // console.log(result);
        // })
        // .fail( function(e) {
        //     console.log(e);
        // });
        // return data;
    }

    function checkTries(statusQuiz){
        $.ajax({
            url: hrefTries,
            type: 'GET',
            async: false,
            success: function(result){
                console.log(result);
                if(result != 0){
                    if(statusQuiz === "start"){
                        startQuiz();
                    }
                    else if(statusQuiz === "restart"){
                        restartQuiz();
                    }
                    else{
                        console.log('Error: Checking Quiz Tries Status');
                    }
                }
                else if(result == 0){
                    alert('Maaf anda sudah menjawab quiz 5x hari ini silahkan kembali lagi besok hari.')
                }
                else{
                    console.log('Error: Checking Quiz Tries Result From Controller');
                }
            },
            error: function(e){
                console.log(e);
            }
        });
    }

    function historyQuiz(result){
        $.ajax({
            url: hrefSave,
            type: "POST",
            async: false,
            data: {result:result},
            success: function(result){

            },
            error: function(e){
                console.log(e);
            }
        });
    }
</script>

<script>
    $(document).ready(function(){
        // dataQues = get_ques();
        // console.log(get_ques());
    });

</script>

{{-- if there is a new scripts for this specific page --}}
<!-- Inside this JavaScript file I've coded all Quiz Codes -->
<script src="{{ asset('js/quiz.js') }}"></script>
<!-- Inside this JavaScript file I've inserted Questions and Options only -->
<script src="{{ asset('js/quiz_question.js') }}"></script>
@endpush
