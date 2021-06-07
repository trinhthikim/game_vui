<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game vui</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="correct" id="correct" hidden="true">Correct</div>
            <div class="score" id="score"></div>
        </div>
        <div class="content">
            <div class="question" id="question"></div>
            <div class="text-question">Click on the correct answer</div>
            <div class="answer">
                <div class="item-answer answer-a" id="answer-a"></div>
                <div class="item-answer answer-b" id="answer-b"></div>
                <div class="item-answer answer-c" id="answer-c"></div>
                <div class="item-answer answer-d" id="answer-d"></div>
            </div>
        </div>
        <div class="footer">
            <div class="reset-game" id="buttom-game" value="Start Game">Start Game</div>
            <div class="time" id="time"></div>
        </div>
    </div>
    <div class="over-game" hidden = "true">
        <div class="text text-1">GAME OVER</div>
        <div class="text text-2"></div>
    </div>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
        //khoi tao ban dau
        $(".over-game").hide();
        $(".time").hide();
        var time_max = 0;
        var score = 0;
        var timeout;
        var i;

        //su ly su kien click vao nut bat dau
        $(document).ready(function() {
            $(".reset-game").click(function(event){
                if($(".reset-game").text() == "Start Game") {
                    setStartGame();
                }
                else {
                    setResetGame();
                }
            });
        });

        //su ly su kien click chon ket qua
        $(document).ready(function() {
            $(".item-answer").click(function(event){
                var a = $(this).text();
                postData(a);
            });
        });

        //ham khoi tao game
        function setStartGame(){
            async await getData();
            $(".reset-game").text("Reset Game");
            $(".over-game").hide();
            $(".score").text(setScore(score));
            console.log(time_max);
            $(".time").text(setTime(time_max));
            $(".time").show();
            i = setInterval(function () {
                time_max = time_max - 1;
                $(".time").text(setTime(time_max));
                $(".time").show();
                if(time_max == 0){
                    clearInterval(i);
                    $(".text-2").text(setOverGame(score));
                    $(".over-game").show();
                }
            },1000);
        }

        //ham reset game
        function setResetGame() {
            $(".reset-game").text("Start Game");
            $(".question").text("");
            $(".item-answer").text("");
            $(".over-game").hide();
            $(".time").hide();

            score = 0;
            clearInterval(i);
            clearTimeout(timeout);
        }

        //get data khi khoi tao game
        function getData() {
            $.ajax({
                url: './game_controller.php',
                type: 'GET',
                dataType: "json",
            }).done(function(ketqua) {
                console.log(ketqua);
                loadQuestion(ketqua);
                time_max = ketqua.time_max;
                $(".time").text(setTime(time_max));
                $(".time").show();
            });
        }
        //post du lieu khi click chon ket qua
        function postData(data){
            $.ajax({
                url: './game_controller.php',
                type: 'POST',
                data: {"data": data},
                dataType: "json",
            }).done(function(ketqua) {
                console.log(ketqua);

                if(ketqua.so_sanh == true)
                {
                    score = score + 1;

                    $(".score").text(setScore(score));
                    $(".correct").show();
                    timeout = setTimeout(function () {
                        $(".correct").hide();
                        if(score == ketqua.score) {
                            $(".text-1").text("YOU WIN");
                            $(".text-2").text(setOverGame(score));
                            $(".over-game").show();
                            clearInterval(i);
                        }else {
                            loadQuestion(ketqua);
                        }
                    },500);
                }
                if(ketqua.so_sanh == false || time_max == 0) {
                    $(".text-2").text(setOverGame(score));
                    $(".over-game").show();
                    clearInterval(i);
                }
            });
        }

        //load cau hoi len man hinh
        function loadQuestion(data) {
            $('.question').text(data.phep_toan);
            $('.answer-a').text(data.bo_ket_qua[0]);
            $('.answer-b').text(data.bo_ket_qua[1]);
            $('.answer-c').text(data.bo_ket_qua[2]);
            $('.answer-d').text(data.bo_ket_qua[3]);
        }

        //mot so ham phu
        function setScore(x){
            var string = "Score:".concat(x.toString());
            return string;
        }
        function setOverGame(x){
            var string = "YOUR SCORE IS ".concat(x.toString());
            string = string.concat(".");
            return string;
        }
        function setTime(x) {
            var string = "Time remaining: ".concat(time_max.toString());
            string = string.concat(" sec");
            return string;
        }
    </script>
</body>
</html>