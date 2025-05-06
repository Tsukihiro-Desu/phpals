<?php 
session_start();
include "header.php";
include "../connection.php";

if(!isset($_SESSION["admin"]))
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                               
                            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">
                
                <center>
                    <h1> Exam Results History </h1>
                </center>
                <?php
                    $count = 0;
                    $res=mysqli_query($link, "SELECT * FROM exam_results where username='$_SESSION[username]' ORDER BY id desc");
                    $count=mysqli_num_rows($res);

                    if($count==0)
                    {
                        ?>
                        <center>
                            <h1> No Results Found </h1>
                        </center>
                        <?php
                    } else {

                        echo "<table class='table table-bordered'>";

                        echo "<tr style='background-color: #006df0; color:white'>";
                        echo "<th>"; echo "username"; echo "</th>";
                        echo "<th>"; echo "exam_type"; echo "</th>";
                        echo "<th>"; echo "total_question"; echo "</th>";
                        echo "<th>"; echo "correct_answer"; echo "</th>";
                        echo "<th>"; echo "wrong_answer"; echo "</th>";
                        echo "<th>"; echo "exam_time"; echo "</th>";
                        echo "</tr>";

                        while($row=mysqli_fetch_array($res))
                        {
                            echo "<tr>";
                            echo "<td>"; echo $row["username"]; echo "</td>";
                            echo "<td>"; echo $row["exam_type"]; echo "</td>";
                            echo "<td>"; echo $row["total_question"]; echo "</td>";
                            echo "<td>"; echo $row["correct_answer"]; echo "</td>";
                            echo "<td>"; echo $row["wrong_answer"]; echo "</td>";
                            echo "<td>"; echo $row["exam_time"]; echo "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    }

                ?>

            </div>

                            </div>
                        </div> 

                    </div>
                    

                
                </div>
            </div>
        </div>


<?php
include "footer.php";
?>
