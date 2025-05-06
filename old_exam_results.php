<?php
session_start();
include "header.php";
include "connection.php";

if(!isset($_SESSION["username"])) {
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
    <title>Exam Results History | Learning System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --accent: #f72585;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #fd7e14;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f9ff;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .results-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .results-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }
        
        .card-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
            margin: 0;
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        
        .card-body {
            padding: 2rem;
            background-color: white;
        }
        
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 0;
        }
        
        .empty-state h4 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .empty-state p {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }
        
        .btn-start-quiz {
            background-color: var(--success);
            border-color: var(--success);
            font-size: 1.2rem;
            font-weight: 500;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            transition: var(--transition);
        }
        
        .btn-start-quiz:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        
        /* Performance Metrics */
        .performance-metrics {
            margin-bottom: 3rem;
        }
        
        .metric-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
            transition: var(--transition);
        }
        
        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .metric-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .metric-value {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .accuracy-metric .metric-value {
            color: var(--primary);
        }
        
        .correct-metric .metric-value {
            color: var(--success);
        }
        
        .wrong-metric .metric-value {
            color: var(--danger);
        }
        
        .progress {
            height: 20px;
            border-radius: 10px;
            background-color: #e9ecef;
            margin-bottom: 1rem;
        }
        
        .progress-bar {
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 20px;
        }
        
        /* Results Table */
        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 2rem;
        }
        
        .results-table thead th {
            background-color: var(--primary);
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1rem;
            border: none;
            position: sticky;
            top: 0;
        }
        
        .results-table tbody tr {
            transition: var(--transition);
        }
        
        .results-table tbody tr:hover {
            background-color: var(--primary-light);
            transform: translateX(5px);
        }
        
        .results-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            font-size: 1rem;
            vertical-align: middle;
        }
        
        .results-table tr:last-child td {
            border-bottom: none;
        }
        
        .exam-type {
            font-weight: 500;
            color: var(--dark);
        }
        
        .correct-count {
            color: var(--success);
            font-weight: 500;
        }
        
        .wrong-count {
            color: var(--danger);
            font-weight: 500;
        }
        
        .exam-date {
            color: var(--gray);
        }
        
        /* Badges */
        .badge-percent {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.9em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50px;
        }
        
        .badge-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }
        
        .badge-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }
        
        /* Footer */
        .card-footer {
            background-color: var(--light);
            border-top: 1px solid #eee;
            padding: 1.5rem;
            text-align: center;
        }
        
        .btn-back {
            background-color: white;
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            transition: var(--transition);
        }
        
        .btn-back:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .card-header h2 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.6rem;
            }
            
            .metric-value {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .card-header h2 {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.4rem;
            }
            
            .empty-state h4 {
                font-size: 1.5rem;
            }
            
            .empty-state p {
                font-size: 1.1rem;
            }
            
            .results-table thead th {
                font-size: 1rem;
                padding: 0.8rem;
            }
            
            .results-table td {
                padding: 0.8rem;
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 576px) {
            .card-header h2 {
                font-size: 1.6rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .metric-card {
                padding: 1.2rem;
            }
            
            .metric-title {
                font-size: 1.1rem;
            }
            
            .metric-value {
                font-size: 1.8rem;
            }
            
            .results-table thead th {
                font-size: 0.9rem;
                padding: 0.6rem;
            }
            
            .results-table td {
                padding: 0.6rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div class="results-container">
    <div class="results-card">
        <div class="card-header">
            <h2><i class="fas fa-chart-line me-2"></i>Exam Results History</h2>
        </div>
        
        <div class="card-body">
            <?php
            $count = 0;
            $res = mysqli_query($link, "SELECT * FROM exam_results WHERE username='$_SESSION[username]' ORDER BY id DESC");
            $count = mysqli_num_rows($res);

            if($count == 0) {
                ?>
                <div class="empty-state">
                    <div class="mb-4">
                        <i class="fas fa-clipboard-list" style="font-size: 4rem; color: #ddd;"></i>
                    </div>
                    <h4>No Exam History Found</h4>
                    <p>You haven't completed any exams yet. Start your learning journey now!</p>
                    <a href="quiz.php" class="btn btn-start-quiz">
                        <i class="fas fa-play me-2"></i>Start a New Quiz
                    </a>
                </div>
                <?php
            } else {
                echo "<h3 class='section-title'><i class='fas fa-trophy me-2'></i>Overall Performance</h3>";
                echo "<div class='performance-metrics'>";
                
                $total_questions_answered = 0;
                $total_correct_answers = 0;
                $total_wrong_answers = 0;
                $total_exams_taken = $count;

                mysqli_data_seek($res, 0);
                while($row = mysqli_fetch_array($res)) {
                    $total_questions_answered += $row["total_question"];
                    $total_correct_answers += $row["correct_answer"];
                    $total_wrong_answers += $row["wrong_answer"];
                }

                $overall_accuracy_percent = ($total_questions_answered > 0) ? round(($total_correct_answers / $total_questions_answered) * 100) : 0;
                $correct_percent = ($total_questions_answered > 0) ? round(($total_correct_answers / $total_questions_answered) * 100) : 0;
                $wrong_percent = ($total_questions_answered > 0) ? round(($total_wrong_answers / $total_questions_answered) * 100) : 0;
                $average_score = ($total_exams_taken > 0) ? round($total_correct_answers / $total_exams_taken) : 0;

                echo "<div class='row g-4'>";
                    echo "<div class='col-md-3'>";
                        echo "<div class='metric-card accuracy-metric'>";
                            echo "<div class='metric-title'>Overall Accuracy</div>";
                            echo "<div class='metric-value'>" . $overall_accuracy_percent . "%</div>";
                            echo "<div class='progress'>";
                                echo "<div class='progress-bar bg-primary' role='progressbar' style='width: " . $overall_accuracy_percent . "%' aria-valuenow='" . $overall_accuracy_percent . "' aria-valuemin='0' aria-valuemax='100'></div>";
                            echo "</div>";
                            echo "<div class='text-center small'>Based on " . $total_questions_answered . " questions</div>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class='col-md-3'>";
                        echo "<div class='metric-card correct-metric'>";
                            echo "<div class='metric-title'>Correct Answers</div>";
                            echo "<div class='metric-value'>" . $total_correct_answers . "</div>";
                            echo "<div class='text-center'>";
                                echo "<span class='badge-percent badge-success'>+" . $correct_percent . "%</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class='col-md-3'>";
                        echo "<div class='metric-card wrong-metric'>";
                            echo "<div class='metric-title'>Wrong Answers</div>";
                            echo "<div class='metric-value'>" . $total_wrong_answers . "</div>";
                            echo "<div class='text-center'>";
                                echo "<span class='badge-percent badge-danger'>-" . $wrong_percent . "%</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class='col-md-3'>";
                        echo "<div class='metric-card'>";
                            echo "<div class='metric-title'>Exams Completed</div>";
                            echo "<div class='metric-value'>" . $total_exams_taken . "</div>";
                            echo "<div class='text-center small'>Average score: " . $average_score . "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</div>"; // End performance-metrics

                echo "<h3 class='section-title'><i class='fas fa-list-alt me-2'></i>Detailed Exam Breakdown</h3>";
                echo "<div class='table-responsive'>";
                echo "<table class='table results-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th><i class='fas fa-graduation-cap me-2'></i>Exam Type</th>";
                echo "<th><i class='fas fa-question-circle me-2'></i>Questions</th>";
                echo "<th><i class='fas fa-check-circle me-2'></i>Correct</th>";
                echo "<th><i class='fas fa-times-circle me-2'></i>Wrong</th>";
                echo "<th><i class='fas fa-percentage me-2'></i>Score</th>";
                echo "<th><i class='fas fa-calendar-alt me-2'></i>Date</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                mysqli_data_seek($res, 0);
                while($row = mysqli_fetch_array($res)) {
                    $score_percent = ($row["total_question"] > 0) ? round(($row["correct_answer"] / $row["total_question"]) * 100) : 0;
                    $exam_date = date("M j, Y", strtotime($row["exam_time"]));
                    
                    echo "<tr>";
                    echo "<td class='exam-type'>" . htmlspecialchars($row["exam_type"]) . "</td>";
                    echo "<td>" . $row["total_question"] . "</td>";
                    echo "<td class='correct-count'>" . $row["correct_answer"] . "</td>";
                    echo "<td class='wrong-count'>" . $row["wrong_answer"] . "</td>";
                    echo "<td>";
                        echo "<div class='progress' style='height: 20px;'>";
                            echo "<div class='progress-bar' role='progressbar' style='width: " . $score_percent . "%; background-color: " . ($score_percent >= 70 ? 'var(--success)' : ($score_percent >= 50 ? 'var(--warning)' : 'var(--danger)')) . ";' aria-valuenow='" . $score_percent . "' aria-valuemin='0' aria-valuemax='100'>" . $score_percent . "%</div>";
                        echo "</div>";
                    echo "</td>";
                    echo "<td class='exam-date'>" . $exam_date . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            ?>
        </div>
        
        <div class="card-footer">
            <a href="home.php" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Home
            </a>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>