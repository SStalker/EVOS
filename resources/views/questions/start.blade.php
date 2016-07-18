@extends('layouts.quizbackend')

@section('title', 'Quiz')

@section('content')

        <div id="loading" class="quiz-loading">
            Verbinde mit Server...
        </div>

        <div id="start" class="quiz-normal">
            <h1 id="startQuizTitle">{{ $quiz->title }}</h1>
            <h2 id="startQuizPinText">Bitte gib folgende PIN ein:</h2>
            <h1 id="startQuizPin">{{ $quiz->id }}</h1>

            <div id="footer">
                <div id="startQuizUser"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Teilnehmer: <span id="attendee-count">0</span></div>
                <div class="start-button">
                    <a id="start-button" class="btn btn-primary" href="#">Starten</a>
                </div>
            </div>
        </div>

        <div id="question" class="quiz-question">
            <h1 id="questionTitle"></h1>
            <div id="questionBody"></div>
            <table id="question-answers" class="table table-bordered">
                <tbody>
                <tr style="height:150px; text-align: center; font-size: 24px;">
                    <td id="answerA" class="bg-blue" style="width:50%;"></td>
                    <td id="answerB" class="bg-green"></td>
                </tr>
                <tr style="height:150px; text-align: center; font-size:24px;">
                    <td id="answerC" class="bg-red"></td>
                    <td id="answerD" class="bg-yellow"></td>
                </tr>
                </tbody>
            </table>

            <div id="questionAnswers">Antworten: <span id="answer-count">0</span></div>
            <div id="questionTime">Zeit: <span id="countdown"></span></div>

            <div class="next-button">
                <a id="next-button" class="btn btn-primary" href="#" style="display: none;">Nächste Frage</a>
                <a id="end-button" class="btn btn-danger" href="#" style="display: none;">Quiz beenden</a>
            </div>
        </div>

        <div id="end" class="quiz-end">
            <h1>Das Quiz wurde beendet.</h1>

            <h2 id="allCorrectAnswers"></h2>
            <h2 id="allIncorrectAnswers"></h2>
            <svg id="chart" width="1000" height="500"></svg>

            <div class="end-button">
                <a id="leave-button" class="btn btn-primary" href="{{ url('/categories') }}">Zurück zur Übersicht</a>
            </div>
        </div>

    <style>
        svg {
          font: 10px sans-serif;
          width: 1020px;
          height: 520px;
        }

        path.line {
          fill: none;
          stroke: #666;
          stroke-width: 1.5px;
        }

        path.area {
          fill: #e7e7e7;
        }

        .axis {
          shape-rendering: crispEdges;
        }

        .x.axis line {
          stroke: #000;
        }

        .x.axis .minor {
          stroke-opacity: .5;
        }

        .y.axis line,
        .y.axis path {
          fill: none;
          stroke: #000;
        }

        .dot {
          fill: white;
          stroke: steelblue;
          stroke-width: 1.5px;
        }

        text {
          font: 20px sans-serif;
          pointer-events: none;
          text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
        }

        #label-left{
          margin-left: 20px;
        }

        #label-bottom{
          margin-bottom: 20px;
        }
    </style>

    <script>
        var user_id = {{ Auth::id() }};
        var quiz_id = {{ $quiz->id }};
        var session_id = '{{ Session::getId() }}';
        var next_route = '{!! action('QuizController@next', [$quiz->category->id, $quiz->id]) !!}';
        var url = '{{ env('SYNC_SERVER_URL', 'ws://127.0.0.1:8080/EVOS-Sync/sync') }}';
        var correctAnswers;
        var answers = [];

        function SyncServer(ws_url) {
            this.attendee_count = 0;
            this.questions_count = 0;
            // Answers per question
            this.answer_count = 0;
            this.correctAnswers_count = 0;
            this.incorrectAnswers_count = 0;
            // All answers
            this.allCorrectAnswers_count = 0;
            this.allIncorrectAnswers_count = 0;

            this.ws = new WebSocket(ws_url);
            this.ws.onerror = this.onError;
            this.ws.onclose = this.onClose;
            this.ws.onopen = this.onOpen;
            this.ws.parent = this;
            this.ws.onmessage = this.onMessage;
        }

        SyncServer.prototype.onError = function (ev) {
            console.log('Error');
            console.log(ev);
        };

        SyncServer.prototype.onClose = function (ev) {
            console.log('Close');
            console.log(ev);
        };

        SyncServer.prototype.onOpen = function (ev) {
            console.log('Opened WebSocket');
            console.log(ev);
            this.parent.startQuiz();
        };

        SyncServer.prototype.onMessage = function (ev) {
            console.log(ev);
            var message = JSON.parse(ev.data);
            if (message.type === undefined) {
                console.log('Received invalid message! It didn\'t contain a type!');
                console.log(message);
                return;
            }

            var that = this.parent;
            switch (message.type) {
                case 'start':
                    that.handleStart(message);
                    break;

                case 'logon':
                    that.handleLogon(message);
                    break;

                case 'answer':
                    that.handleAnswer(message);
                    break;

                case 'disconnect':
                    that.handleDisconnect(message);
                    break;

                default:
                    console.log('Received an invalid message.');
                    console.log(message);
                    break;
            }
        };

        SyncServer.prototype.startQuiz = function () {
            console.log('starting quiz');
            var startMessage = {
                type: 'start',
                user_id: user_id,
                quiz_id: quiz_id,
                session_id: session_id
            };
            this.sendMessage(startMessage);
        };

        SyncServer.prototype.handleStart = function (message) {
            console.log('handle start');
            if (message.successful !== undefined && message.successful === false) {
                console.log('QuizStart was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            $('.quiz-loading').hide();
            $('.quiz-normal').show();
        };

        SyncServer.prototype.handleLogon = function (message) {
            if (message.successful !== undefined && message.successful === false) {
                console.log('Logon was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            this.attendee_count++;
            $('#attendee-count').text(this.attendee_count);
        };

        SyncServer.prototype.handleAnswer = function (message) {
            if (message.successful !== undefined && message.successful === false) {
                console.log('Answer was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            if (self.duration <= 0) {
                return;
            }

            this.answer_count++;
            $('#answer-count').text(this.answer_count);

            // counts the correct and incorrect answers
            var chosenAnswer = message.answer[0];
            if (correctAnswers.a && chosenAnswer == 'a'
                    || correctAnswers.b && chosenAnswer == 'b'
                    || correctAnswers.c && chosenAnswer == 'c'
                    || correctAnswers.d && chosenAnswer == 'd') {

                this.correctAnswers_count++;

                // Saves the number of right answers in array for every question
                answers[this.questions_count-1] = {'x': this.questions_count, 'y': this.correctAnswers_count};
            } else {
                this.incorrectAnswers_count++;
            }

            /*if(this.answer_count == this.attendee_count){
             $('#next-button').fadeIn("slow");
             }*/
        };

        SyncServer.prototype.handleDisconnect = function (message) {
            this.attendee_count--;
            $('#attendee-count').text(this.attendee_count);
        };

        SyncServer.prototype.sendMessage = function (msg) {
            try {
                this.ws.send(JSON.stringify(msg));
            }
            catch (e) {
                console.log('Error while sending');
                console.log(e);
            }
        };

        SyncServer.prototype.quiz = function () {
            // Some default settings
            $('#answer-count').text("0");

            $('#answerA').addClass("bg-blue");
            $('#answerB').addClass("bg-green");
            $('#answerC').addClass("bg-red");
            $('#answerD').addClass("bg-yellow");

            $('#answerA').removeClass("correct-answer incorrect-answer");
            $('#answerB').removeClass("correct-answer incorrect-answer");
            $('#answerC').removeClass("correct-answer incorrect-answer");
            $('#answerD').removeClass("correct-answer incorrect-answer");
            $('#next-button').fadeOut("slow");

            this.questions_count++;

            var self = this;
            $.getJSON(next_route, function (data) {
                // For every new question the server must be informed
                self.question();

                self.duration = data.countdown;
                correctAnswers = jQuery.parseJSON(data.correct_answers);

                $('#questionTitle').text(data.title);

                $('#answerA').text(data.answerA || '');
                $('#answerB').text(data.answerB || '');
                $('#answerC').text(data.answerC || '');
                $('#answerD').text(data.answerD || '');

                var images = data.question.match(/\[image\((\d+\.[A-Za-z]{1,4})\)\]/g);
                if (images != null) {
                    images.forEach(function (image) {
                        var matches = image.match(/.*\((\d+\.[A-Za-z]{1,4})\).*/);
                        var html = '<img src="{{ asset('storage/uploads/') }}/' + matches[1] + '">';
                        data.question = data.question.replace(matches[0], html);
                    });
                }

                // for some reason matching over multiple lines doesn't work... So we'll go a different way solving this issue.
                data.question = data.question.replace(/\[code\]/g, '<pre><code>');
                data.question = data.question.replace(/\[\/code\]/g, '</code></pre>');
                $('#questionBody').text(data.question);

                // MathJax refresh
                MathJax.Hub.Typeset();

                // Shows the countdown for the current question
                var that = this;
                this.countdown = setInterval(function () {
                    self.duration--;
                    if (self.duration > 0) {
                        $('#countdown').text(self.duration);
                    } else {
                        var percent_correct = 0;
                        var percent_incorrect = 0;

                        if (self.answer_count != 0) {
                            percent_correct = self.correctAnswers_count / self.answer_count * 100;
                            percent_incorrect = self.incorrectAnswers_count / self.answer_count * 100;

                            self.allCorrectAnswers_count += percent_correct;
                            self.allIncorrectAnswers_count += percent_incorrect;
                        }

                        clearInterval(that.countdown);

                        if (data.last == true) {
                            self.end();
                            $('#end-button').fadeIn("slow");
                        } else {
                            $('#next-button').fadeIn("slow");
                        }

                        $('#countdown').text('Keine verbleibende Zeit');
                        $('#answer-count').text('Richtig: ' + Math.round(percent_correct) + '%, falsch: ' + Math.round(percent_incorrect) + '%');

                        $('#answerA').removeClass("bg-blue");
                        $('#answerB').removeClass("bg-green");
                        $('#answerC').removeClass("bg-red");
                        $('#answerD').removeClass("bg-yellow");

                        correctAnswers.a ? $('#answerA').addClass("correct-answer") : $('#answerA').addClass("incorrect-answer");
                        correctAnswers.b ? $('#answerB').addClass("correct-answer") : $('#answerB').addClass("incorrect-answer");
                        correctAnswers.c ? $('#answerC').addClass("correct-answer") : $('#answerC').addClass("incorrect-answer");
                        correctAnswers.d ? $('#answerD').addClass("correct-answer") : $('#answerD').addClass("incorrect-answer");
                    }
                }, 1000);
            });
        }

        SyncServer.prototype.question = function () {
            // The user sends the messageType 'question' to induce the server to show a new question
            var questionMessage = {
                type: 'question',
                quiz_id: quiz_id,
                session_id: session_id
            };

            this.sendMessage(questionMessage);
            // For every new question answer_count must be set to 0
            this.answer_count = 0;
            this.correctAnswers_count = 0;
            this.incorrectAnswers_count = 0;

            answers[this.questions_count-1] = {'x': this.questions_count, 'y': 0};
        }

        SyncServer.prototype.end = function () {
            var endMessage = {
                type: 'end',
                quiz_id: quiz_id,
                session_id: session_id
            };

            this.sendMessage(endMessage);

            window.onbeforeunload = null;
        }

        $(function () {
            $('.quiz-normal').hide();
            $('.quiz-question').hide();
            $('.quiz-end').hide();

            var hasStarted = false;
            var syncServer = new SyncServer(url);

            $('#start-button').click(function () {
                $('.quiz-normal').hide();
                $('.quiz-question').show();

                hasStarted = true;
                syncServer.quiz();
            });

            $('#next-button').click(function () {
                syncServer.quiz();
            });

            $('#end-button').click(function () {
                var percent_correct = Math.round(syncServer.allCorrectAnswers_count / syncServer.questions_count);
                var percent_incorrect = Math.round(syncServer.allIncorrectAnswers_count / syncServer.questions_count);
                $('#allCorrectAnswers').text("Richtige Antworten insgesamt: " + percent_correct + "%");
                $('#allIncorrectAnswers').text("Falsche Antworten insgesamt: " + percent_incorrect + "%");

                var values = [percent_correct, percent_incorrect];

                var lineData = answers;
                var MARGIN = {top: 20, right: 20, bottom: 20, left: 50},
                    WIDTH = 1000,
                    HEIGHT = 500;

                var vis = d3.select('#chart');

                var xRange = d3.scale.linear().range([MARGIN.left, WIDTH - MARGIN.right]).domain([1, d3.max(lineData, function(d) {
                      return d.x;
                    })]);
                var yRange = d3.scale.linear().range([HEIGHT - MARGIN.top, MARGIN.bottom]).domain([0, syncServer.attendee_count]);

                var xAxis = d3.svg.axis()
                      .scale(xRange)
                      .tickFormat(d3.format("d"))
                      .tickSize(1);

                var yAxis = d3.svg.axis()
                      .scale(yRange)
                      .tickFormat(d3.format("d"))
                      .tickSize(5)
                      .orient('left');

                // Add the text label for the x axis
                vis.append("text")
                     .attr("text-anchor", "middle")
                     .attr("id", "label-bottom")
                     .attr("transform", "translate("+(WIDTH/2)+","+(HEIGHT+10)+")")
                     .text("Fragen");


                // Add the text label for the Y axis
                vis.append("text")
                     .attr("text-anchor", "middle")
                     .attr("id", "label-left")
                     .attr("transform", "translate("+ (MARGIN.left-30) +","+(HEIGHT/2)+")rotate(-90)")
                     .text("Richtige Antworten");

                // Draw the x-axis
                vis.append('svg:g')
                  .attr('class', 'x axis')
                  .attr('transform', 'translate(0,' + (HEIGHT - MARGIN.bottom) + ')')
                  .call(xAxis);

                // Draw the y-axis
                vis.append('svg:g')
                  .attr('class', 'y axis')
                  .attr('transform', 'translate(' + (MARGIN.left) + ',0)')
                  .call(yAxis);

                // Draw and interpolate the line
                var lineFunc = d3.svg.line()
                  .x(function (d) {
                    return xRange(d.x);
                  })
                  .y(function (d) {
                    return yRange(d.y);
                  })
                  .interpolate(interpolateSankey);

                vis.append("svg:path")
                  .attr("d", lineFunc(lineData))
                  .attr("stroke", "blue")
                  .attr("stroke-width", 2)
                  .attr("fill", "none");


                // Add the scatterplot
                vis.selectAll("circle")
                  .data(lineData)
                  .enter().append("circle")
                    .attr("r", 3.5)
                    .attr("class", "dot")
                    .attr("cx", function(d) { return xRange(d.x); })
                    .attr("cy", function(d) { return yRange(d.y); });

                function interpolateSankey(points) {
                    var x0 = points[0][0], y0 = points[0][1], x1, y1, x2,
                        path = [x0, ",", y0],
                        i = 0,
                        n = points.length;
                    while (++i < n) {
                        x1 = points[i][0], y1 = points[i][1], x2 = (x0 + x1) / 2;
                        path.push("C", x2, ",", y0, " ", x2, ",", y1, " ", x1, ",", y1);
                        x0 = x1, y0 = y1;
                    }
                    return path.join("");
                }

                $('.quiz-normal').fadeOut('slow');
                $('.quiz-question').fadeOut('slow', function () {
                    $('.quiz-end').fadeIn('slow');
                });
            });

            // Inform attendees that the quiz has ended.
            window.onbeforeunload = function () {
                if (hasStarted === true) {
                    syncServer.end();
                    return 'Das Quiz läuft noch! Trotzdem die Seite neu laden?';
                }
            };
        });
    </script>

@endsection
