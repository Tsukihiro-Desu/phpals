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

$res = mysqli_query($link, "SELECT * FROM modules ORDER BY title ASC");
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Manage Modules</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Module List</strong>
                        <p class="text-right mb-0"><a href="admin_add_module.php" class="btn btn-success btn-sm rounded"><i class="fas fa-plus mr-2"></i> Add New Module</a></p>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['module_message'])) {
                            echo '<div class="alert alert-' . $_SESSION['module_message_type'] . '">' . $_SESSION['module_message'] . '</div>';
                            unset($_SESSION['module_message']);
                            unset($_SESSION['module_message_type']);
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Upload Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["title"] . "</td>";
                                        echo "<td>" . $row["description"] . "</td>";
                                        // Display the filename from the upload_date column.
                                        echo "<td>" . $row["upload_date"] . "</td>";
                                        echo "<td>";
                                        echo "<a href='admin_edit_module.php?id=" . $row["id"] . "' class='btn btn-sm btn-primary mr-2'><i class='fas fa-edit'></i> Edit</a>";
                                        echo "<a href='admin_delete_module.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this module?\")'><i class='fas fa-trash-alt'></i> Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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