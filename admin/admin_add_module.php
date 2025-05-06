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
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add New Module</h1>
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
                        <div class="col-lg-6">
                            <form name="form1" action="" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header"><strong>Add New Module Details</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">Title</label>
                                            <input type="text" name="title" placeholder="Enter Module Title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="form-control-label">Description (Optional)</label>
                                            <input type="text" name="description" placeholder="Enter Module Description" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pdf_file" class="form-control-label">Upload PDF File</label>
                                            <input type="file" name="pdf_file" class="form-control-file" accept="application/pdf" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Upload Module" class="btn btn-success">
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
</div>

<?php
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);

    $file_name = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = array("pdf");

    echo "<script>console.log('File name: " . $file_name . "');</script>";
    echo "<script>console.log('File temp: " . $file_tmp . "');</script>";
    echo "<script>console.log('File ext: " . $file_ext . "');</script>";
    

    if (in_array($file_ext, $allowed_ext)) {
        $upload_dir = "../uploads/";
        $new_file_name = uniqid() . "." . $file_ext;
        $file_path_on_server = $upload_dir . $new_file_name;
        $file_path_in_db = "uploads/" . $new_file_name;

        echo "<script>console.log('Upload path: " . $file_path_on_server . "');</script>";

        if (move_uploaded_file($file_tmp, $file_path_on_server)) {
            echo "<script>console.log('File moved successfully');</script>";
            //  Insert, but upload_date is a VARCHAR, so we'll insert the filename.
            $query = "INSERT INTO modules (title, description, file_path, upload_date) VALUES ('$title', '$description', '$file_path_in_db', '$new_file_name')";
            echo "<script>console.log('SQL Query: " . $query . "');</script>";
            $result = mysqli_query($link, $query);
            if($result){
                echo "<script>console.log('Query executed successfully');</script>";
                 ?>
                <script type="text/javascript">
                    alert("Module uploaded successfully!");
                    window.location = "admin_modules.php";
                </script>
                <?php
            }
            else{
                echo "<script>console.log('Query failed: " . mysqli_error($link) . "');</script>";
                 ?>
                <script type="text/javascript">
                    alert("Error uploading to database!");
                    window.location.href = window.location.href;
                </script>
                <?php
            }
           
        } else {
            $php_err_code = $_FILES['pdf_file']['error'];
            $upload_error_message = "File upload failed. ";
            switch ($php_err_code) {
                case UPLOAD_ERR_INI_SIZE:
                    $upload_error_message .= "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $upload_error_message .= "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $upload_error_message .= "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $upload_error_message .= "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $upload_error_message .= "Missing a temporary folder.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $upload_error_message .= "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $upload_error_message .= "File upload stopped by extension.";
                    break;
                default:
                    $upload_error_message .= "Unknown upload error.";
            }
            echo "<script>console.log('move_uploaded_file failed. Error Code: " . $php_err_code . "');</script>";
            ?>
            <script type="text/javascript">
                alert("<?php echo $upload_error_message; ?>");
                window.location.href = window.location.href;
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Invalid file type. Only PDF files are allowed.");
            window.location.href = window.location.href;
        </script>
        <?php
    }
}
?>

<?php
include "footer.php";
?>