<?php
session_start();
include "header.php";
include "../connection.php";
if (!isset($_SESSION["admin"])) {
    ?>
    <script type="text/javascript">
        window.location = "index.php";
    </script>
    <?php
}
$id = $_GET["id"];
$id1 = $_GET["id1"];

$res = mysqli_query($link, "select * from questions where id=$id");
$row = mysqli_fetch_array($res);

$question = $row["question"];
$pdf_path = $row["pdf_path"]; // Assuming you have a 'pdf_path' column in your 'questions' table
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit Question with PDF</h1>
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
                        <form name="form1" action="" method="post" enctype="multipart/form-data">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><strong>Edit Question with PDF</strong> </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label class="form-control-label">Question</label>
                                            <input type="text" name="fquestion" placeholder="Add Question" class="form-control" value="<?php echo $question; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Current PDF</label>
                                            <?php if ($pdf_path): ?>
                                                <p><a href="<?php echo $pdf_path; ?>" target="_blank">View Current PDF</a></p>
                                            <?php else: ?>
                                                <p>No PDF uploaded.</p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Upload New PDF</label>
                                            <input type="file" name="fpdf" class="form-control-file" accept="application/pdf" style="padding-bottom:35px">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit2" value="Update Question" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit2"])) {

    $question = mysqli_real_escape_string($link, $_POST['fquestion']);
    $pdf_name = $_FILES["fpdf"]["name"];
    $pdf_tmp = $_FILES["fpdf"]["tmp_name"];
    $tm = md5(time());

    if ($pdf_name != "") {
        $pdf_ext = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));
        if ($pdf_ext == "pdf") { //check file type
            $upload_dir = "./question_pdfs/"; // Create this directory
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true); //create directory if not exists
            }
            $new_pdf_name = $tm . $pdf_name;
            $pdf_path_on_server = $upload_dir . $new_pdf_name;
            $pdf_path_in_db = "question_pdfs/" . $new_pdf_name;

            if (move_uploaded_file($pdf_tmp, $pdf_path_on_server)) {
                //update query
                $query = "update questions set question='$question', pdf_path='$pdf_path_in_db' where id=$id";
                if (mysqli_query($link, $query)) {
                     ?>
                    <script type="text/javascript">
                        alert("Question and PDF updated successfully!");
                        window.location = "add_edit_questions.php?id=<?php echo $id1 ?>";
                    </script>
                    <?php
                } else {
                    echo "Error updating database: " . mysqli_error($link); //show the error
                }
               
            } else {
                echo "Failed to upload PDF file.";
            }
        } else {
            echo "Invalid file type.  Only PDF files are allowed";
        }
       
    } else {
         $query = "update questions set question='$question' where id=$id";
        if (mysqli_query($link, $query)) {
             ?>
            <script type="text/javascript">
                alert("Question  updated successfully!");
                window.location = "add_edit_questions.php?id=<?php echo $id1 ?>";
            </script>
            <?php
        } else {
            echo "Error updating database: " . mysqli_error($link); //show the error
        }
    }
}

?>

<?php
include "footer.php";
?>
