@extends('user.app')
@section('user_content')
    <style>
        .modal_label_style label {
            font-weight: 600;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Question Start</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
            </ol>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="text-center">Time: {{ $exam->exam_duration }} min</h3>
                    </div>
                    <div class="col-sm-4">
                        <h3><b>Timer</b>: <span class="js-timeout" id="timer">{{ $exam->exam_duration }}:00</span></h3>
                    </div>
                    <div class="col-sm-4">
                        <h3 class="text-right"><b>Status</b>: Running</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('submit.exam') }}" method="POST">
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    @csrf
                    <div class="row">
                        @foreach ($questions as $key => $data)
                            <div class="col-sm-12 mt-4" id="question{{$key+1}}" style="display: {{$key==0 ? 'block' : 'none'}};">
                                <p>{{$key+1}}. {{ $data->question}}</p>
                                    <?php
                                    $options = json_decode(json_decode(json_encode($data->options)),true);
                                    ?>
                                <input type="hidden" name="question{{$key+1}}" value="{{$data->id}}">
                                <ul class="question_options">
                                    <li><input type="radio" value="{{ $options['option1']}}" name="ans{{$key+1}}"> {{ $options['option1']}}</li>
                                    <li><input type="radio" value="{{ $options['option2']}}" name="ans{{$key+1}}"> {{ $options['option2']}}</li>
                                    <li><input type="radio" value="{{ $options['option3']}}" name="ans{{$key+1}}"> {{ $options['option3']}}</li>
                                    <li><input type="radio" value="{{ $options['option4']}}" name="ans{{$key+1}}"> {{ $options['option4']}}</li>
                                    <li><input type="radio" value="{{ $options['option5']}}" name="ans{{$key+1}}"> {{ $options['option5']}}</li>
                                    <li><input type="radio" value="{{ $options['option6']}}" name="ans{{$key+1}}"> {{ $options['option6']}}</li>
                                    <li style="display: none;">
                                        <input value="0" type="radio" checked="checked" name="ans{{$key+1}}"> {{ $options['option6']}}</li>
                                </ul>
                            </div>
                        @endforeach
                        <div class="col-sm-12">
                            <input type="hidden" id="currentIndex" name="index" value="1">
                            <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                            <button type="submit" class="btn btn-primary" id="submitButton" style="display: none;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentIndex = 1;
            var totalQuestions = {!! $questions->count() !!};
            var nextButton = document.getElementById("nextButton");
            var submitButton = document.getElementById("submitButton");

            var duration = {{ $exam->exam_duration }}; // Exam duration in minutes
            var timerElement = document.getElementById("timer");
            var secondsLeft = duration * 60; // Convert minutes to seconds
            var intervalId;

            // Function to update the timer every second
            function updateTimer() {
                var minutes = Math.floor(secondsLeft / 60);
                var seconds = secondsLeft % 60;
                timerElement.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

                if (secondsLeft <= 0) {
                    clearInterval(intervalId);
                    submitButton.style.display = "block"; // Show the submit button when time is up
                    nextButton.style.display = "none"; // Hide the next button
                }
                secondsLeft--;
            }

            // Start the timer
            intervalId = setInterval(updateTimer, 1000);
            nextButton.addEventListener("click", function() {
                var currentQuestion = document.getElementById("question" + currentIndex);
                currentQuestion.style.display = "none";
                currentIndex++;
                if (currentIndex > totalQuestions) {
                    nextButton.style.display = "none"; // Hide the next button
                    submitButton.style.display = "block"; // Show the submit button
                } else {
                    var nextQuestion = document.getElementById("question" + currentIndex);
                    nextQuestion.style.display = "block";
                    document.getElementById("currentIndex").value = currentIndex;
                }
            });
        });
    </script>

@endsection
