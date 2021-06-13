<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game vui</title>
    <link rel="stylesheet" href="./css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
            <div class="button-rating">Rating</div>
            <div class="reset-game" id="button-game" value="Start Game">Start Game</div>
            <div class="time" id="time"></div>
        </div>
    </div>
    <div class="over-game">
        <div class="text text-1">GAME OVER</div>
        <div class="text text-2">YOUR SCORE IS 0.</div>
        <div class="button-over-game quit-save-game">
            <div class="quit-game">Quit</div>
            <div class="save-game">Save score</div>
        </div>
        <div class="button-over-game submit-game">
            <input type="text" placeholder="nhập họ tên của bạn" class="input-submit-score" name="input-submit-score">
            <div class="button-submit">Submit</div>
        </div>
    </div>
    <div class="table-rating">
        <table>
            <tr>
                <th>Name</th>
                <th>Score</th>
            </tr>

        </table>
    </div>

    <script src="js/controller.js" type="module"></script>
    <script src="js/player_rating.js" type="module"></script>
</body>
</html>