<?php
session_start();
include "connection.php";
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date." + $_SESSION[exam_time] minutes"));
include "header.php";
?>

<div class="container" style="margin-top: 50px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg border-0" style="background-color: #f8f9fa;">
                <div class="card-header text-center py-4 bg-info rounded-top">
                    <h2 class="mb-0 font-weight-bold text-uppercase" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #fff;">Quiz Result</h2>
                </div>
                <div class="card-body py-5">
                    <?php
                    $correct = 0;
                    $wrong = 0;

                    if(isset($_SESSION["answer"]))
                    {
                        for($i = 1; $i <= sizeof($_SESSION["answer"]); $i++)
                        {
                            $answer = "";
                            $res = mysqli_query($link, "SELECT answer FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$i");
                            while($row=mysqli_fetch_array($res))
                            {
                                $answer = $row["answer"];
                            }

                            if(isset($_SESSION["answer"][$i]))
                            {
                                if($answer == $_SESSION["answer"][$i])
                                {
                                    $correct = $correct + 1;
                                }
                                else
                                {
                                    $wrong = $wrong + 1;
                                }
                            }
                            else
                            {
                                $wrong = $wrong + 1;
                            }
                        }
                    }

                    $count = 0;
                    $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]'");
                    $count = mysqli_num_rows($res);
                    $wrong = $count - $correct;

                    echo "<div class='text-center'>";
                    echo "<h4 class='mb-4 font-weight-semibold' style='font-family: 'Open Sans', sans-serif; color: #333;'>Your Performance Summary</h4>";
                    echo "<p class='lead'><i class='fas fa-question-circle fa-lg mr-2 text-info'></i> <span class='font-weight-bold' style='font-family: 'Lato', sans-serif; color: #555;'>Total Questions:</span> <span style='color: #777;'>" . $count . "</span></p>";
                    echo "<p class='lead'><i class='fas fa-check-circle fa-lg mr-2 text-success'></i> <span class='font-weight-bold' style='font-family: 'Lato', sans-serif; color: #555;'>Correct Answers:</span> <span style='color: #777;'>" . $correct . "</span></p>";
                    echo "<p class='lead'><i class='fas fa-times-circle fa-lg mr-2 text-danger'></i> <span class='font-weight-bold' style='font-family: 'Lato', sans-serif; color: #555;'>Wrong Answers:</span> <span style='color: #777;'>" . $wrong . "</span></p>";

                    $percentage = ($count > 0) ? round(($correct / $count) * 100, 2) : 0;
                    echo "<h3 class='mt-4 font-weight-bold text-primary' style='font-family: 'Montserrat', sans-serif;'>Percentage: <span style='color: #5bc0de;'>" . $percentage . "%</span></h3>";

                    echo "<div class='mt-5'>";
                    if ($percentage >= 70) {
                        echo "<p class='lead text-success'><i class='fas fa-trophy fa-2x mr-2 align-middle'></i> <span class='font-weight-bold' style='font-family: 'Roboto', sans-serif;'>Congratulations! You Passed!</span></p>";
                    } else {
                        echo "<p class='lead text-danger'><i class='fas fa-exclamation-triangle fa-2x mr-2 align-middle'></i> <span class='font-weight-bold' style='font-family: 'Roboto', sans-serif;'>Better Luck Next Time.</span></p>";
                    }
                    echo "</div>";

                    echo "</div>";
                    ?>
                </div>
                <div class="card-footer bg-light text-center py-4 rounded-bottom">
                    <a href="select_exam.php" class="btn btn-lg btn-primary rounded-pill font-weight-bold" style="font-family: 'Nunito Sans', sans-serif; padding: 15px 40px; font-size: 1.4rem;"><i class="fas fa-redo mr-2"></i> Go back </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_SESSION["exam_start"]))
    {
        $date = date("Y-m-d");
        mysqli_query($link, "INSERT INTO exam_results(id, username, exam_type, total_question, correct_answer, wrong_answer, exam_time) VALUES(NULL,'$_SESSION[username]','$_SESSION[exam_type]','$count','$correct','$wrong','$date')");
    }

    if(isset($_SESSION["exam_start"]))
    {
        unset($_SESSION["exam_start"]);
        ?>
        <script type="text/javascript">
            setTimeout(function(){
                window.location.href=window.location.href;
            }, 50);
        </script>
        <?php
    }
?>

<?php
include "footer.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmRKAgb4Y0Yelqo96zAYWTrBYWXf0csRAjJnJnf9KiVGxiKP+A5hXgjlM2iyem/7PtXHcbNRgFIwhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Nunito+Sans:wght@400;700&family=Open+Sans:wght@400;700&family=Roboto:wght@400;700&family=Segoe+UI&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnF9TbGhV9KaGkpYlYc963GA" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tCwlsaKMso+eqF5lnJGzIzXV/JiAuVo/yGmgJUwdZYMEHlOIpyiHKxi4" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<style>
    body {
        background-color: #e3f2fd; /* Light blue background */
        font-family: 'Nunito Sans', sans-serif; /* Default font */
    }
    .card-header h2 {
        font-size: 2.5rem;
        letter-spacing: 1px;
    }
    .card-body h4 {
        font-size: 2rem;
        margin-bottom: 20px;
    }
    .card-body p {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
    .card-body h3 {
        font-size: 2.2rem;
        margin-top: 30px;
    }
    .btn-primary {
        background-color: #5dade2; /* Blue button */
        border-color: #5dade2;
        padding: 15px 40px; /* Larger button padding */
        font-size: 1.4rem; /* Larger button text */
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #46b8da;
        border-color: #46b8da;
    }
    .text-info {
        color: #5bc0de !important; /* Blue info text */
    }
    .text-success {
        color: #5cb85c !important; /* Green success text */
    }
    .text-danger {
        color: #d9534f !important; /* Red danger text */
    }
    .text-primary {
        color: #5bc0de !important; /* Blue primary text */
    }
</style>