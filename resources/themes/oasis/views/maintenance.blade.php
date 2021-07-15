@extends('layouts.app')

@section('title', trans('messages.maintenance'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('messages.maintenance') }}</div>

                    <div class="card-body">
                        @if(theme_config('maintenance'))
                            <div class="timer">
                                <p>
                                    <div class="clock-element">
                                        <span id="days">
                                            <span>0</span>
                                        </span><span class="char">J</span>
                                    </div>
                                    <div class="clock-element">
                                        <span id="hours">
                                            <span>0</span>
                                        </span><span class="char">H</span>
                                    </div>
                                    <div class="clock-element">
                                        <span id="minutes">
                                            <span>0</span>
                                        </span><span class="char">M</span>
                                    </div>
                                    <div class="clock-element">
                                        <span id="seconds">
                                            <span>0</span>
                                        </span><span class="char">S</span>
                                    </div>
                                </p>
                            </div>
                        @endif
                        <h2>{!! $maintenanceMessage !!}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="countdown"></span>

    <script>
        var countDownDate = new Date("{{ theme_config('maintenance') }}").getTime();

        var countdownfunction = setInterval(function() {

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (distance < 0) {
                clearInterval(countdownfunction);
                document.getElementById("days").innerHTML = "0";
                document.getElementById("hours").innerHTML = "0";
                document.getElementById("minutes").innerHTML = "0";
                document.getElementById("seconds").innerHTML = "0";
            }
        }, 1000);
    </script>
@endsection
