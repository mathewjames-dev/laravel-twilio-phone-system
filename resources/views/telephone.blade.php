@extends('layout')

@section('css')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Lato:400,400italic,700);

        body {
            background-color: #2196F2;
            font-family: Lato;
            font-weight: 400;
            letter-spacing: 1px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .pad {
            width: 400px;
            height: 700px;
            background-color: #232323;
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            box-shadow: 0 30px 35px -25px black;
            animation: showPad 1s ease forwards 1;
        }

        .pad .dial-pad .contact {
            width: 60%;
            position: relative;
            margin-left: 20%;
            margin-top: 40px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .pad .dial-pad .contact.showContact {
            opacity: 1;
        }

        .pad .dial-pad .contact .avatar {
            background-repeat: no-repeat;
            background-size: auto 100%;
            background-position: center center;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            box-shadow: 0 15px 30px -10px black;
            position: absolute;
            left: 0px;
            top: 8px;
        }

        .pad .dial-pad .contact .contact-info {
            border-radius: 8px;
            width: 85%;
            margin-left: 15%;
            background-color: #2D2D2D;
            height: 76px;
            overflow: hidden;
        }

        .pad .dial-pad .contact .contact-info>div {
            width: 80%;
            margin-left: 20%;
            font-size: 12px;
            margin-top: 3px;
        }

        .pad .dial-pad .contact .contact-info .contact-name {
            color: #FDFDFD;
            margin-top: 12px;
        }

        .pad .dial-pad .contact .contact-info .contact-position {
            font-style: italic;
            color: #AEAEAE;
        }

        .pad .dial-pad .contact .contact-info .contact-number {
            color: white;
        }

        .pad .dial-pad .contact .contact-info .contact-number span {
            color: #3DE066;
            display: inline;
        }

        .pad .dial-pad .contact .contact-buttons {
            position: absolute;
            right: -5px;
            top: 0px;
            width: 40px;
            height: 76px;
        }

        .pad .dial-pad .contact .contact-buttons button {
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 100%;
            box-shadow: 0 12px 25px -5px black;
            display: block;
            position: absolute;
            right: 0px;
            background-size: 75% auto;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .pad .dial-pad .contact .contact-buttons button:focus {
            outline: none;
        }

        .pad .dial-pad .contact .contact-buttons button.icon-message {
            background-color: #FFC44E;
            top: 5px;
        }

        .pad .dial-pad .contact .contact-buttons button.icon-video {
            background-color: #A529F9;
            bottom: 5px;
        }

        .pad .dial-pad .phoneString {
            width: 100%;
            height: 80px;
            background-color: #2D2D2D;
            margin-top: 40px;
        }

        .pad .dial-pad .phoneString input {
            background-color: transparent;
            width: 60%;
            margin-left: 20%;
            height: 80px;
            border: none;
            font-size: 30px;
            color: white;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .pad .dial-pad .phoneString input:focus {
            outline: none;
        }

        .pad .dial-pad .digits {
            overflow: hidden;
            width: 60%;
            margin-left: 20%;
            margin-top: 20px;
        }

        .pad .dial-pad .digits .dig-spacer {
            width: 60px;
            margin: 10px calc(50% - 90px);
            float: left;
        }

        .pad .dial-pad .digits .dig {
            color: white;
            font-size: 30px;
            float: left;
            background-color: #2D2D2D;
            text-align: center;
            width: 60px;
            height: 56px;
            border-radius: 100%;
            margin: 10px 0px;
            padding-top: 4px;
            font-weight: 700;
            cursor: pointer;
        }

        .pad .dial-pad .digits .dig.clicked {
            animation: pulse-gray linear 0.5s 1;
        }

        .pad .dial-pad .digits .dig:nth-child(3n-1) {
            margin: 10px calc(50% - 90px);
        }

        .pad .dial-pad .digits .dig.astrisk {
            padding-top: 17px;
            height: 43px;
        }

        .pad .dial-pad .digits .dig.pound {
            padding-top: 10px;
            height: 50px;
        }

        .pad .dial-pad .digits .dig .sub-dig {
            font-size: 8px;
            font-weight: 300;
            position: relative;
            top: -2px;
        }

        .pad .dial-pad .digits .dig.addPerson,
        .pad .dial-pad .digits .dig.goBack {
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 55% auto;
            margin-bottom: 25px;
            box-shadow: 0px 25px 30px -15px black;
        }

        .pad .dial-pad .digits .dig.addPerson {
            background-color: #285EFA;
            background-image: url(https://s16.postimg.org/4u2rbu85t/add_Person.png);
        }

        .pad .dial-pad .digits .dig.addPerson.clicked {
            animation: pulse-blue linear 0.5s 1;
        }

        .pad .dial-pad .digits .dig.goBack {
            background-color: #FA4A5D;
            background-image: url(https://s4.postimg.org/x6g6auu7d/back_Arrow.png);
        }

        .pad .dial-pad .digits .dig.goBack.clicked {
            animation: pulse-red linear 0.5s 1;
        }

        .pad .call-pad {
            opacity: 0;
            /* height: 0px; */
            /* pointer-events: none; */
            background-image: url(https://s21.postimg.org/x4te7wpo7/call_Background.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center center;
            transition: opacity 0.3s ease;
            position: absolute;
            width: 100%;
            left: 0px;
            top: 0px;
            transition: opacity 0.3s ease;
        }

        .pad .call-pad.in-call {
            height: 100%;
            opacity: 1;
            pointer-events: all;
        }

        .pad .call-pad .pulsate {
            opacity: 0;
            width: 150px;
            height: 0px;
            overflow: visible;
            position: relative;
            display: block;
            margin: 0 auto 0;
            top: 120px;
            transition: opacity 0.5s ease;
        }

        .pad .call-pad .pulsate.active-call {
            animation: pulsator 2s ease infinite;
            opacity: 1;
        }

        .pad .call-pad .pulsate div {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.06);
            border-radius: 100%;
            margin: auto;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
        }

        .pad .call-pad .pulsate div:nth-child(1) {
            width: 110px;
            height: 110px;
        }

        .pad .call-pad .pulsate div:nth-child(2) {
            width: 122px;
            height: 122px;
        }

        .pad .call-pad .pulsate div:nth-child(3) {
            width: 134px;
            height: 134px;
        }

        .pad .call-pad .ca-avatar {
            width: 100px;
            height: 100px;
            margin: 70px auto;
            margin-bottom: 30px;
            display: block;
            background-color: #111111;
            border-radius: 100%;
            box-shadow: 0px 20px 25px -10px rgba(0, 0, 0, 0.8);
            background-position: center center;
            background-size: 100% auto;
            background-repeat: no-repeat;
            transition: opacity 1s ease, transform 1s ease;
            opacity: 0.5;
            transform: scale(0.5, 0.5);
        }

        .pad .call-pad .ca-avatar.in-call {
            transform: scale(1, 1);
            opacity: 1;
        }

        .pad .call-pad .ca-name,
        .pad .call-pad .ca-number,
        .pad .call-pad .ca-status {
            width: 60%;
            margin-left: 20%;
            color: white;
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .pad .call-pad .ca-name {
            font-size: 18px;
        }

        .pad .call-pad .ca-number {
            font-size: 28px;
            letter-spacing: 2px;
        }

        .pad .call-pad .ca-status {
            font-size: 30px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .pad .call-pad .ca-status:after {
            content: attr(data-dots);
            position: absolute;
        }

        .pad .call-pad .ca-buttons {
            width: 70%;
            margin-left: 15%;
        }

        .pad .call-pad .ca-buttons .ca-b-single {
            float: left;
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 100%;
            position: relative;
            margin-bottom: 40px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: 55% auto;
        }

        .pad .call-pad .ca-buttons .ca-b-single:nth-child(3n-1) {
            margin-left: calc(100% - 230px);
            margin-right: calc(100% - 230px);
        }

        .pad .call-pad .ca-buttons .ca-b-single:after {
            content: attr(data-label);
            color: white;
            position: absolute;
            text-align: center;
            font-size: 10px;
            width: 100px;
            bottom: -20px;
            left: -18px;
            letter-spacing: 2px;
        }

        .call,
        .end-call {
            color: white;
            font-size: 30px;
            text-align: center;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            margin: 10px 0px;
            font-weight: 700;
            cursor: pointer;
            position: absolute;
            left: calc(50% - 30px);
            bottom: 25px;
            box-shadow: 0px 25px 30px -15px black;
            background-color: #3DE066;
        }

        .call .call-icon,
        .end-call .call-icon {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            background-size: 60% auto;
            background-repeat: no-repeat;
            background-position: center center;
            background-image: url(https://s13.postimg.org/sqno4q8sj/call.png);
            transition: transform 0.3s ease;
        }

        .call .call-icon.in-call,
        .end-call .call-icon.in-call {
            -ms-transform: rotate(134deg);
            -webkit-transform: rotate(134deg);
            transform: rotate(134deg);
        }

        .call .call-change,
        .end-call .call-change {
            width: 60px;
            height: 60px;
            border-radius: 100%;
            overflow: hidden;
        }

        .call .call-change span,
        .end-call .call-change span {
            width: 70px;
            height: 67px;
            display: block;
            background-color: #FA4A5D;
            position: relative;
            top: 70px;
            left: 70px;
            border-radius: 100%;
            transition: left 0.3s ease, top 0.3s ease;
        }

        .call .call-change.in-call span,
        .end-call .call-change.in-call span {
            top: -5px;
            left: -5px;
        }

        .call.clicked,
        .end-call.clicked {
            animation: pulse-green linear 0.5s 1 forwards;
        }

        @keyframes pulse-gray {
            0% {
                box-shadow: inset 0 0 0px 30px #2D2D2D, inset 0 0 0px 30px white;
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            10% {
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            30% {
                box-shadow: inset 0 0 0px 10px #2D2D2D, inset 0 0 0px 30px white;
            }

            60% {
                box-shadow: inset 0 0 0px 0px #2D2D2D, inset 0 0 0px 0px white;
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            100% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }
        }

        @keyframes pulse-blue {
            0% {
                box-shadow: inset 0 0 0px 30px #285EFA, inset 0 0 0px 30px white;
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            10% {
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            30% {
                box-shadow: inset 0 0 0px 10px #285EFA, inset 0 0 0px 30px white;
            }

            60% {
                box-shadow: inset 0 0 0px 0px #285EFA, inset 0 0 0px 0px white;
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            100% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }
        }

        @keyframes pulse-green {
            0% {
                box-shadow: inset 0 0 0px 30px #3DE066, inset 0 0 0px 30px white;
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            10% {
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            30% {
                box-shadow: inset 0 0 0px 10px #3DE066, inset 0 0 0px 30px white;
            }

            60% {
                box-shadow: inset 0 0 0px 0px #3DE066, inset 0 0 0px 0px white;
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            100% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }
        }

        @keyframes pulse-red {
            0% {
                box-shadow: inset 0 0 0px 30px #FA4A5D, inset 0 0 0px 30px white;
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            10% {
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            30% {
                box-shadow: inset 0 0 0px 10px #FA4A5D, inset 0 0 0px 30px white;
            }

            60% {
                box-shadow: inset 0 0 0px 0px #FA4A5D, inset 0 0 0px 0px white;
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            100% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }
        }

        @keyframes pulsator {
            0% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }

            40% {
                -ms-transform: scale(0.8, 0.8);
                -webkit-transform: scale(0.8, 0.8);
                transform: scale(0.8, 0.8);
            }

            100% {
                -ms-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
                transform: scale(1, 1);
            }
        }

        @keyframes showPad {
            0% {
                top: 50px;
                opacity: 0;
            }

            100% {
                top: 0px;
                opacity: 1;
            }
        }

        p {
            position: fixed;
            bottom: 0px;
            left: 15px;
            color: white;
            font-family: Lato;
            font-weight: 300;
            overflow: hidden;
        }

        p a:link,
        p a:visited {
            color: white;
        }

        p a:hover {
            opacity: 0.5;
        }

        p img {
            width: 20px;
            height: 20px;
            position: relative;
            top: 6px;
        }

        .accept-call {
            background: #3DE066 !important;
        }

        .reject-call {
            background: #FA4A5D !important;
        }

        .incoming-call-container {
            position: absolute;
            bottom: 0;
        }

        .unmute {
            background: #FA4A5D !important;
        }
    </style>
@stop

@section('content')
    <div class="pad">
        <div class="dial-pad">
            <div class="contact">
                <div class="avatar"
                    style="background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/378978/profile/profile-80_1.jpg')">
                </div>
                <div class="contact-info">
                    <div class="contact-name">Matt Sich</div>
                    <div class="contact-position">CodePenner</div>
                    <div class="contact-number">
                        (123) 456 - 7890
                    </div>
                </div>
                <div class="contact-buttons">
                    <button class="icon-message"
                        style="background-image: url(https://s2.postimg.org/bpik42e39/comment_Bubble.png)"></button>
                    <button class="icon-video"
                        style="background-image: url(https://s10.postimg.org/e7vjpqao5/camera.png)"></button>
                </div>
            </div>
            <div class="phoneString">
                <input type="text" disabled>
            </div>

            <div class="digits digits-container">
                <div class="dig pound number-dig" name="1">1</div>
                <div class="dig number-dig" name="2">2
                    <div class="sub-dig">ABC</div>
                </div>
                <div class="dig number-dig" name="3">3
                    <div class="sub-dig">DEF</div>
                </div>
                <div class="dig number-dig" name="4">4
                    <div class="sub-dig">GHI</div>
                </div>
                <div class="dig number-dig" name="5">5
                    <div class="sub-dig">JKL</div>
                </div>
                <div class="dig number-dig" name="6">6
                    <div class="sub-dig">MNO</div>
                </div>
                <div class="dig number-dig" name="7">7
                    <div class="sub-dig">PQRS</div>
                </div>
                <div class="dig number-dig" name="8">8
                    <div class="sub-dig">TUV</div>
                </div>
                <div class="dig number-dig" name="9">9
                    <div class="sub-dig">WXYZ</div>
                </div>
                <div class="dig number-dig astrisk" name="*">*</div>
                <div class="dig number-dig pound" name="0">0</div>
                <div class="dig number-dig pound" name="#">#</div>

                <div class="dig addPerson action-dig"></div>
                <div class="dig-spacer"></div>
                <div class="dig goBack action-dig"></div>
            </div>

            <div class="digits incoming-call-container" style="display:none;">
                <div class="dig reject-call"></div>
                <div class="dig-spacer"></div>
                <div class="dig accept-call"></div>
            </div>
        </div>

        <div class="call-pad">
            <div class='pulsate'>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="ca-avatar"
                style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/378978/profile/profile-80_1.jpg);">
            </div>
            <div class="ca-name">Matt Sich</div>
            <div class="ca-number">123 456 7890</div>
            <div class="ca-status" data-dots="...">Calling</div>
            <div class="ca-buttons">
                <div class="ca-b-single" data-label="Add Contact"
                    style="background-image: url(https://s1.postimg.org/gqfpipyy3/add_People.png)">
                </div>

                <!-- Mute/Unmute -->
                <div class="ca-b-single mute"></div>
                <div class="ca-b-single unmute" style="display:none;"></div>

                <div class="ca-b-single" data-label="Face to Face"
                    style="background-image: url(https://s4.postimg.org/s5xyjztd5/facetoface.png)">
                </div>
                <div class="ca-b-single" data-label="Chat"
                    style="background-image: url(https://s29.postimg.org/tlddup9nn/message_Bubble.png)">
                </div>
                <div class="ca-b-single" data-label="Keypad"
                    style="background-image: url(https://s7.postimg.org/uxqt9hw5z/keypad.png)">
                </div>
            </div>
        </div>



        <div class="call action-dig">
            <div class="call-change"><span></span></div>
            <div class="call-icon"></div>
        </div>

        <div class="end-call clicked" style="display:none;">
            <div class="call-change in-call"><span></span></div>
            <div class="call-icon in-call"></div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.number-dig').click(function() {
            //add animation
            addAnimationToButton(this);
            //add number
            var currentValue = $('.phoneString input').val();
            var valueToAppend = $(this).attr('name');
            $('.phoneString input').val(currentValue + valueToAppend);
        });


        var timeoutTimer = true;
        var timeCounter = 0;
        var timeCounterCounting = true;

        $('.action-dig').click(function() {
            //add animation
            addAnimationToButton(this);
            if ($(this).hasClass('goBack')) {
                var currentValue = $('.phoneString input').val();
                var newValue = currentValue.substring(0, currentValue.length - 1);
                $('.phoneString input').val(newValue);
            } else {
                // Hide the call button
                $(this).hide();

                // Show the end call button.
                $('.end-call').show();

                // Hide dial page initially.
                $('.dial-pad').hide();

                $('.call-pad').css('opacity', 1);

                $('.ca-status').text('Calling');
                setTimeout(function() {
                    timeoutTimer = true;
                    looper();
                    //showActiveCallAfterAFewSeconds
                    setTimeout(function() {
                        timeoutTimer = false;
                        timeCounterCounting = true;
                        timeCounterLoop();

                        $('.pulsate').toggleClass('active-call');
                        $('.ca-status').animate({
                            opacity: 0,
                        }, 1000, function() {
                            $(this).text('00:00');
                            $('.ca-status').attr('data-dots', '');

                            $('.ca-status').animate({
                                opacity: 1,
                            }, 1000);
                        });
                    }, 3000);
                }, 500);
            }
        });

        var timeCounterLoop = function() {

            if (timeCounterCounting) {
                setTimeout(function() {
                    var timeStringSeconds = '';
                    var minutes = Math.floor(timeCounter / 60.0);
                    var seconds = timeCounter % 60;
                    if (minutes < 10) {
                        minutes = '0' + minutes;
                    }
                    if (seconds < 10) {
                        seconds = '0' + seconds;
                    }
                    $('.ca-status').text(minutes + ':' + seconds);

                    timeCounter += 1;

                    timeCounterLoop();
                }, 2000);
            }
        };

        var dots = 0;
        var looper = function() {
            if (timeoutTimer) {

                setTimeout(function() {
                    if (dots > 3) {
                        dots = 0;
                    }
                    var dotsString = '';
                    for (var i = 0; i < dots; i++) {
                        dotsString += '.';
                    }
                    $('.ca-status').attr('data-dots', dotsString);
                    dots += 1;

                    looper();
                }, 500);
            }
        };

        var hangUpCall = function() {
            timeoutTimer = false;
        };

        var addAnimationToButton = function(thisButton) {
            //add animation
            $(thisButton).removeClass('clicked');
            var _this = thisButton;
            setTimeout(function() {
                $(_this).addClass('clicked');
            }, 1);
        };

        var showUserInfo = function(userInfo) {
            $('.avatar').attr('style', "background-image: url(" + userInfo.image + ")");
            if (!$('.contact').hasClass('showContact')) {
                $('.contact').addClass('showContact');
            }
            $('.contact-name').text(userInfo.name);
            $('.contact-position').text(userInfo.desc);
            var matchedNumbers = $('.phoneString input').val();
            var remainingNumbers = userInfo.number.substring(matchedNumbers.length);
            $('.contact-number').html("<span>" + matchedNumbers + "</span>" + remainingNumbers);

            //update call elements
            $('.ca-avatar').attr('style', 'background-image: url(' + userInfo.image + ')');
            $('.ca-name').text(userInfo.name);
            $('.ca-number').text(userInfo.number);

        };

        var hideUserInfo = function() {
            $('.contact').removeClass('showContact');
        };

        /**
         * Global Variables
         */
        var token; // Twilio access token
        var identity; // Agent identity
        var device; // Twilio deice

        // Get twilio access token.
        getTwilioAccessToken();

        // Setup twilio device.


        /**
         * Functions
         */

        // Get the twilio access token.
        async function getTwilioAccessToken() {
            console.log("Requesting an access token for twilio..");

            try {
                // Get the data from our backend / access token.
                const data = await (await fetch("/phone/access-token")).json();

                console.log('Got the twilio access token');

                // Set the token.
                token = data.token;

                // Set the identity.
                identity = data.identity;

                // Initialize the device.
                initializeDevice();
            } catch (error) {
                console.log(error);
            }
        }

        // Function to initialzie the twilio device.
        function initializeDevice() {
            console.log('Initilizing twilio device!');

            // Init device.
            device = new Twilio.Device(token, {
                logLevel: 1,
                codecPreferences: ['opus', 'pcmu'],
                maxCallSignalingTimeoutMs: 30000
            });

            // Register Event Listeners
            registerPhoneEventListeners();

            // Register the device.
            device.register();

            console.log('Twilio device successfully initialized');
        }

        // Function for the phone front-end specific event listeners.
        async function registerPhoneEventListeners() {

            // For when the call button has been clicked. (OUTBOUND CALL)
            $('.call').on('click', async function() {
                // Get the phone number to call.
                var phoneNumberToCall = $('input[type="text"]').val();

                // Set the twilio parameters up.
                var params = {
                    To: phoneNumberToCall,
                    agent: identity,
                    callerId: '+441156477288',
                    Location: 'US1'
                }

                // If device exists, call the client/customer etc.
                if (device) {
                    // Call the agent/customer
                    const call = await device.connect({
                        params
                    });

                    // Register call event listeners
                    call.on("disconnect", updateUiDisconnectedOutgoingCall);

                    // Register hangup button listener.
                    $('.end-call').on('click', function() {
                        hangupTelephoneCall(call);
                    });

                    // Register mute button listener.
                    $('.mute').on('click', function() {
                        muteTelephoneCall(call);
                    });

                    // Register unmute button listener.
                    $('.unmute').on('click', function() {
                        unmuteTelephoneCall(call);
                    });
                }
            });

            // For when an inbound call is coming.
            device.on("incoming", handleIncomingPhoneCall);
        }

        // Function to hangup the telephone call
        function hangupTelephoneCall(call) {
            console.log('Hanging up the call from our end.');

            // Disconnect the call.
            call.disconnect();

            // Update the UI.
            updateUiDisconnectedOutgoingCall();
        }

        // Function to mute a telephone call.
        function muteTelephoneCall(call) {
            console.log('Muting ourselves on the call');

            call.mute(true); // Mute the call.

            // Update the classes.
            $('.mute').hide();
            $('.unmute').show();
        }

        // Function to unmute a telephone call.
        function unmuteTelephoneCall(call) {
            console.log('Unmuting ourselves on the call');

            call.mute(false); // Unmute the call.

            // Update the classes.
            $('.mute').show();
            $('.unmute').hide();
        }

        // Function to handle the ui when the other user disconnects the call.
        function updateUiDisconnectedOutgoingCall() {
            // Handle ui.
            $('.end-call').hide(); // Hide the button

            // Show the call button
            $('.call').show();

            // Show the dial pad
            $('.dial-pad').show();

            // Hide the call pad
            $('.call-pad').css('opacity', 0);

            timeCounterCounting = false;
            timeCounter = 0;
            hangUpCall();

            $('.pulsate').toggleClass('active-call');

            $('.phoneString input').val('');
        }

        // Function to handle the inbound phone call.
        function handleIncomingPhoneCall(call) {
            console.log("inbound phone call from " + call.parameters.From);

            // Hide the digits container
            $('.digits-container').hide();

            // Hide the call button
            $('.call').hide();

            // Show the incoming call container
            $('.incoming-call-container').show();

            // Show the call pad.
            $('.call-pad').css('opacity', 1);

            // Listen for the reject call button to be clicked.
            $('.reject-call').on('click', function() {
                rejectIncomingCall(call);
            });

            // Listen for the accept incoming call button to be clicked.
            $('.accept-call').on('click', function() {
                acceptIncomingCall(call);
            });
        }

        // Function to handle incoming call rejection.
        function rejectIncomingCall(call) {
            // Reject the call.
            call.reject();

            console.log("Rejecting incoming phone call");

            // Update the ui.

            // Hide the call pad.
            $('.call-pad').css('opacity', 0);

            // Hide the incoming call container
            $('.incoming-call-container').hide();

            // show the digits container
            $('.digits-container').show();

            // show the call button
            $('.call').show();
        }

        // Function to accept incoming call
        function acceptIncomingCall(call) {
            // Accept the call
            call.accept();

            console.log("Accepted the incoming telephone call");

            // Update the ui.

            // Hide incoming call buttons.
            $('.incoming-call-container').hide();

            // Show end call button.
            $('.end-call').show();

            // Register hangup button listener.
            $('.end-call').on('click', function() {
                hangupTelephoneCall(call);
            })

            // Register mute button listener.
            $('.mute').on('click', function() {
                muteTelephoneCall(call);
            });

            // Register unmute button listener.
            $('.unmute').on('click', function() {
                unmuteTelephoneCall(call);
            });

            setTimeout(function() {
                timeoutTimer = true;
                looper();
                //showActiveCallAfterAFewSeconds
                setTimeout(function() {
                    timeoutTimer = false;
                    timeCounterCounting = true;
                    timeCounterLoop();

                    $('.pulsate').toggleClass('active-call');
                    $('.ca-status').animate({
                        opacity: 0,
                    }, 1000, function() {
                        $(this).text('00:00');
                        $('.ca-status').attr('data-dots', '');

                        $('.ca-status').animate({
                            opacity: 1,
                        }, 1000);
                    });
                }, 500);
            }, 500);
        }
    </script>
@stop
