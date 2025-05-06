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
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Quiz Category</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #1a1a2e;
            --gray: #6c757d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .page-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .page-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 0 auto;
        }
        
        .category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            border: none;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        
        .category-card .card-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }
        
        .category-card h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0;
            color: var(--dark);
            transition: color 0.3s ease;
        }
        
        .category-card .card-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary);
            transition: all 0.3s ease;
        }
        
        .category-card:hover .card-icon {
            transform: scale(1.1);
        }
        
        .category-card .card-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-light);
            opacity: 0.3;
            z-index: 1;
        }
        
        /* Animation delays for cards */
        .category-card:nth-child(1) { animation-delay: 0.1s; }
        .category-card:nth-child(2) { animation-delay: 0.2s; }
        .category-card:nth-child(3) { animation-delay: 0.3s; }
        .category-card:nth-child(4) { animation-delay: 0.4s; }
        .category-card:nth-child(5) { animation-delay: 0.5s; }
        .category-card:nth-child(6) { animation-delay: 0.6s; }
        .category-card:nth-child(7) { animation-delay: 0.7s; }
        .category-card:nth-child(8) { animation-delay: 0.8s; }
        
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .page-header h2 {
                font-size: 2rem;
            }
            
            .category-card h3 {
                font-size: 1.2rem;
            }
            
            .category-card .card-icon {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="page-header animate__animated animate__fadeInDown">
        <h2>Choose Your Quiz Category</h2>
    </div>
    
    <div class="category-grid">
        <?php
            $res = mysqli_query($link, "SELECT * FROM exam_category");
            $icons = ['fa-brain', 'fa-atom', 'fa-flask', 'fa-calculator', 'fa-book', 'fa-globe', 'fa-code', 'fa-history'];
            $color_palette = ['#4361ee', '#3f37c9', '#7209b7', '#f72585', '#4895ef', '#4cc9f0', '#560bad', '#3a0ca3'];
            $index = 0;
            
            while($row = mysqli_fetch_array($res)) {
                $category = ucfirst(strtolower($row["category"]));
                $icon = $icons[$index % count($icons)];
                $color = $color_palette[$index % count($color_palette)];
                ?>
                <div class="category-card animate__animated animate__fadeIn" 
                     onclick="set_exam_type_session('<?php echo $row["category"]; ?>');"
                     style="--primary: <?php echo $color; ?>;">
                    <div class="card-bg" style="background-color: <?php echo $color; ?>;"></div>
                    <div class="card-content">
                        <i class="fas <?php echo $icon; ?> card-icon"></i>
                        <h3><?php echo $category; ?></h3>
                    </div>
                </div>
                <?php
                $index++;
            }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    function set_exam_type_session(exam_category) {
        // Add click animation
        const card = event.currentTarget;
        card.style.transform = 'scale(0.95)';
        setTimeout(() => {
            card.style.transform = 'translateY(-8px)';
        }, 150);
        
        // Make AJAX request
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "dashboard.php";
            }
        };
        xmlhttp.open("GET", "foarajax/set_exam_type_session.php?exam_category=" + exam_category, true);
        xmlhttp.send(null);
    }
</script>
</body>
</html>