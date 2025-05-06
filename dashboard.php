<?php
session_start();
if(!isset($_SESSION["username"]))
{
    ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #121212; /* Dark background */
        color: #e0e0e0; /* Light text */
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .quiz-container {
        background-color: #1e1e1e; /* Darker container */
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3); /* Deeper shadow */
        margin-bottom: 70px;
        overflow: hidden;
        width: 95%;
        max-width: 700px;
    }

    .quiz-header {
        background-color: #2c3e50; /* Darker header */
        color: #fff;
        padding: 20px;
        text-align: center;
        border-bottom: 4px solid #34495e; /* Slightly lighter dark border */
    }

    .quiz-header h2 {
        margin: 0;
        font-size: 2em;
        font-weight: bold;
    }

    .question-info {
        padding: 15px 20px; /* Adjust padding for better spacing */
        background-color: #222; /* Dark background */
        border-bottom: 1px solid #444; /* Border */
        color: #eee; /* Light text */
        font-size: 1.4em; /* Even larger text */
        font-weight: bold; /* Make it stand out */
        display: flex;
        justify-content: flex-end; /* Align content to the right */
        align-items: center;
    }

    .question-area {
        padding: 20px;
        font-size: 1.1em;
        color: #ccc; /* Lighter text */
        line-height: 1.6;
    }

    .options-list {
        list-style: none;
        padding: 0;
        margin-top: 15px;
    }

    .option-item {
        margin-bottom: 10px;
    }

    .option-label {
        display: block;
        padding: 12px;
        background-color: #222; /* Dark option background */
        border: 1px solid #333; /* Darker border */
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        color: #bbb; /* Lighter text */
        font-size: 1em;
    }

    .option-label:hover {
        background-color: #333; /* Slightly lighter dark hover */
        border-color: #5dade2; /* Blue accent on hover */
        color: #eee; /* Light text on hover */
    }

    input[type="radio"] {
        margin-right: 8px;
        vertical-align: middle;
    }

    .quiz-navigation {
        background-color: #222; /* Dark navigation */
        padding: 15px;
        text-align: center;
        border-top: 1px solid #333; /* Darker border */
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-direction: row;
    }

    .quiz-navigation button {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1em;
        transition: transform 0.2s ease-in-out;
        flex-grow: 1;
        min-width: 100px;
    }

    .btn-previous {
        background-color: #f39c12; /* Amber */
        color: #fff;
    }

    .btn-next {
        background-color: #2ecc71; /* Green */
        color: #fff;
    }

    .quiz-navigation button:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Deeper shadow on hover */
    }

    .question-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
    }

    /* Media query for smaller screens (e.g., tablets and phones) */
    @media (max-width: 600px) {
        body {
            padding: 10px;
        }

        .quiz-header h2 {
            font-size: 1.8em;
        }

        .question-info {
            font-size: 0.9em;
        }

        .question-area {
            font-size: 1em;
            padding: 15px;
        }

        .option-label {
            font-size: 0.9em;
            padding: 10px;
        }

        .quiz-navigation {
            flex-direction: column;
            align-items: stretch;
            gap: 8px;
        }

        .quiz-navigation button {
            flex-grow: 0;
            min-width: auto;
        }
    }
</style>
</head>
<body>

    <div class="quiz-container">
        <div class="quiz-header">
            <h2>Quiz in Progress!</h2>
        </div>
        <div class="question-info">
            <span id="current_que">0</span> / <span id="total_que">0</span>
        </div>
        <div class="question-area" id="load_questions">
            </div>
        <div class="quiz-navigation">
            <button class="btn btn-previous" onclick="load_previous();">Previous</button>
            <button class="btn btn-next" onclick="load_next();">Next</button>
        </div>
    </div>

<script type="text/javascript">
    function load_total_que()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState==4 & xmlhttp.status==200) {
                document.getElementById("total_que").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "foarajax/load_total_que.php", true);
        xmlhttp.send(null);
    }

    var questionno="1";
    load_questions(questionno);

    function load_questions(questionno)
    {
        document.getElementById("current_que").innerHTML=questionno;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState == 4 && xmlhttp.status==200) {

                if(xmlhttp.responseText=="over")
                {
                    window.location="result.php";
                }
                else {
                    document.getElementById("load_questions").innerHTML=xmlhttp.responseText;
                    load_total_que();
                }

            }
        };
        xmlhttp.open("GET", "foarajax/load_questions.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    function radioclick(radiovalue, questionno)
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if(xmlhttp.readyState==4 && xmlhttp.status==200) {

            }
        };
        xmlhttp.open("GET", "foarajax/save_answer_in_session.php?questionno=" + questionno + "&value1=" + radiovalue, true);
        xmlhttp.send(null);
    }

    function load_previous()
    {
        if(questionno=="1")
        {
            load_questions(questionno);
        }
        else {
            questionno=eval(questionno)-1;
            load_questions(questionno);
        }
    }

    function load_next()
    {
        questionno=eval(questionno)+1;
        load_questions(questionno);
    }

</script>

</body>
</html>
