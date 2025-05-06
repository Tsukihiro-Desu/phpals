<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Online Quiz System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="css1/bootstrap.min.css">
    <link rel="stylesheet" href="css1/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>

    <div class="all-content-wrapper">

    <div class="header-advance-area" style="padding: 0; background-color: #343a40; border-bottom: 1px solid #555;">
    <div class="header-top-area" style="margin-bottom: 0;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12" style="padding-left: 0; padding-right: 0;">
                    <div class="menu-switcher-pro" style="margin: 0;">
                        <button type="button" id="sidebarCollapse" class="btn btn-link text-light navbar-btn" style="padding: 10px; font-size: 18px;">
                            <i class="educate-icon educate-nav"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left: 0; padding-right: 0;">
                    <div class="header-top-menu tabl-d-n" style="margin: 0;">
                        <ul class="nav navbar-nav mai-top-nav" style="display: flex; flex-direction: row; margin-bottom: 0; padding-left: 0;">
                            <li class="nav-item" style="margin-right: 15px; list-style: none;">
                                <a href="home.php" class="nav-link" style="padding: 10px 12px; font-size: 16px; color: #fff; text-decoration: none;">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item" style="margin-right: 15px; list-style: none;">
                                <a href="select_exam.php" class="nav-link" style="padding: 10px 12px; font-size: 16px; color: #fff; text-decoration: none;">
                                    Quizzes
                                </a>
                            </li>
                            <li class="nav-item" style="margin-right: 15px; list-style: none;">
                                <a href="games.php" class="nav-link" style="padding: 10px 12px; font-size: 16px; color: #fff; text-decoration: none;">
                                    Games
                                </a>
                            </li>
                            <li class="nav-item" style="margin-right: 15px; list-style: none;">
                                <a href="module.php" class="nav-link" style="padding: 10px 12px; font-size: 16px; color: #fff; text-decoration: none;">
                                    Modules
                                </a>
                            </li>
                            <li class="nav-item" style="list-style: none;">
                                <a href="old_exam_results.php" class="nav-link" style="padding: 10px 12px; font-size: 16px; color: #fff; text-decoration: none;">
                                    History
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="padding-left: 0; padding-right: 0;">
                    <div class="header-right-info" style="display: flex; justify-content: flex-end; align-items: center; margin: 0;">
                        <ul class="nav navbar-nav mai-top-nav header-right-menu" style="display: flex; flex-direction: row; margin-bottom: 0; padding-right: 0;">
                            <li class="nav-item" style="list-style: none;">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle" style="padding: 10px 0; display: flex; align-items: center; text-decoration: none;">
                                    <img src="img/avatar-mini2.jpg" alt="User Avatar" style="width: 30px; height: 30px; margin-right: 8px; border-radius: 50%;">
                                    <span class="admin-name" style="font-size: 16px; color: #fff;"><?php echo $_SESSION["username"]; ?></span>
                                    <i class="fa fa-angle-down edu-icon edu-down-arrow" style="margin-left: 5px; color: #fff;"></i>
                                </a>
                                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn" style="margin-top: 0;">
                                    <li style="list-style: none;">
                                        <a href="logout.php" style="padding: 10px 15px; font-size: 14px; color: #333; text-decoration: none; display: block;">
                                            <span class="edu-icon edu-locked author-log-ic" style="margin-right: 5px;"></span>Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-link:hover {
    color: #adb5bd !important; /* Light gray on hover */
}
.dropdown-toggle:hover {
    color: #adb5bd !important;
}
.dropdown-header-top.author-log.dropdown-menu a:hover {
    background-color: #f8f9fa !important; /* Light background on hover */
    color: #333 !important;
}
</style>

<script type="text/javascript">
    setInterval(function(){
        timer();
    }, 1000);

    function timer()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                // Trim whitespace from response
                var response = xmlhttp.responseText.trim();

                if(response == "00:00:01")
                {
                    window.location = "result.php";
                }

                document.getElementById("countdowntimer").innerHTML = response;
            }
        };

        xmlhttp.open("GET", "foarajax/load_timer.php", true);
        xmlhttp.send(null);
    }
</script>