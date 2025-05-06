<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Learning System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --accent: #f72585;
            --accent-light: #ffd6e7;
            --success: #4cc9f0;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #1a1a2e;
            --gray: #6c757d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            overflow-x: hidden;
        }
        
        /* Fixed Header */
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 70px; /* Fixed height */
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        /* Main Content */
        .main-content {
            margin-top: 70px; /* Offset for fixed header */
            min-height: calc(100vh - 70px);
            padding-bottom: 50px;
        }
        
        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-title {
            font-family: 'Fredoka One', cursive;
            font-size: 3rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .emoji-wave {
            font-size: 2.5rem;
            display: inline-block;
            animation: wave 2s infinite;
            transform-origin: 70% 70%;
        }
        
        @keyframes wave {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(-10deg); }
            20% { transform: rotate(12deg); }
            30% { transform: rotate(-10deg); }
            40% { transform: rotate(9deg); }
            50% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }
        
        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            position: relative;
            height: 100%;
        }
        
        .content-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .content-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--accent), var(--primary));
        }
        
        .card-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .card-text {
            color: var(--gray);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        
        /* Carousel */
        .dashboard-carousel {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
        }
        
        .dashboard-carousel .carousel-item img {
            height: 400px;
            object-fit: cover;
        }
        
        .dashboard-carousel .carousel-caption {
            background: rgba(0,0,0,0.6);
            border-radius: 15px;
            padding: 20px;
            bottom: 40px;
            left: 40px;
            right: auto;
            width: auto;
            max-width: 50%;
            text-align: left;
            backdrop-filter: blur(5px);
        }
        
        .dashboard-carousel .carousel-caption h5 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .dashboard-carousel .carousel-caption p {
            font-size: 1.1rem;
        }
        
        /* Action Buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border-radius: 15px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .action-btn:hover {
            transform: scale(1.05);
            color: white;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .action-btn.exam {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .action-btn.results {
            background: linear-gradient(135deg, var(--success) 0%, #4895ef 100%);
        }
        
        .action-btn.games {
            background: linear-gradient(135deg, #7209b7 0%, #b5179e 100%);
        }
        
        .action-btn.modules {
            background: linear-gradient(135deg, var(--warning) 0%, #f3722c 100%);
        }
        
        .action-icon {
            font-size: 2rem;
            margin-right: 15px;
        }
        
        /* Fun Fact Card */
        .fun-fact-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            position: relative;
        }
        
        .fun-fact-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--warning), var(--accent));
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .dashboard-carousel .carousel-item img {
                height: 350px;
            }
        }
        
        @media (max-width: 992px) {
            .welcome-title {
                font-size: 2.5rem;
            }
            
            .dashboard-carousel .carousel-item img {
                height: 300px;
            }
            
            .dashboard-carousel .carousel-caption {
                max-width: 70%;
                bottom: 30px;
                left: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
            
            .dashboard-carousel .carousel-item img {
                height: 250px;
            }
            
            .dashboard-carousel .carousel-caption {
                max-width: 80%;
                bottom: 20px;
                left: 20px;
                padding: 15px;
            }
            
            .dashboard-carousel .carousel-caption h5 {
                font-size: 1.4rem;
            }
            
            .dashboard-carousel .carousel-caption p {
                font-size: 1rem;
            }
            
            .action-btn {
                padding: 1.2rem;
                font-size: 1rem;
            }
            
            .action-icon {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .welcome-section {
                padding: 3rem 0;
                border-radius: 0;
            }
            
            .dashboard-carousel .carousel-item img {
                height: 200px;
            }
            
            .dashboard-carousel .carousel-caption {
                max-width: 90%;
                bottom: 10px;
                left: 10px;
                padding: 10px;
            }
            
            .dashboard-carousel .carousel-caption h5 {
                font-size: 1.2rem;
                margin-bottom: 0.25rem;
            }
            
            .content-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Main Content -->
<main class="main-content">
    <!-- Welcome Section -->
    <section class="welcome-section text-center">
        <div class="container">
            <h1 class="welcome-title animate__animated animate__fadeInDown">
                Hello <?php echo htmlspecialchars($_SESSION["username"]); ?>! <span class="emoji-wave">👋</span>
            </h1>
            <p class="welcome-subtitle animate__animated animate__fadeIn animate__delay-1s">
                Ready for some learning fun today?
            </p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Bootstrap Carousel -->
                <div id="dashboardCarousel" class="dashboard-carousel carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Collaborative learning">
                            <div class="carousel-caption">
                                <h5>Collaborate & Learn</h5>
                                <p>Join study groups and learn together</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Educational games">
                            <div class="carousel-caption">
                                <h5>Play & Learn</h5>
                                <p>Discover our educational games</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Learning modules">
                            <div class="carousel-caption">
                                <h5>Interactive Modules</h5>
                                <p>Explore our learning materials</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                
                <!-- Content Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="content-card text-center animate__animated animate__fadeInLeft">
                            <i class="fas fa-book-open card-icon"></i>
                            <h4 class="card-title">ALS</h4>
                            <p class="card-text">Comprehensive learning system with interactive content</p>
                            <a href="#" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="content-card text-center animate__animated animate__fadeInUp">
                            <i class="fas fa-trophy card-icon"></i>
                            <h4 class="card-title">Gamification</h4>
                            <p class="card-text">Engaging game-based learning experiences</p>
                            <a href="#" class="btn btn-primary">Play Now</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="content-card text-center animate__animated animate__fadeInRight">
                            <i class="fas fa-users card-icon"></i>
                            <h4 class="card-title">Solo Content</h4>
                            <p class="card-text">Self-paced learning modules for individual study</p>
                            <a href="#" class="btn btn-primary">Start Learning</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Quick Actions -->
            <div class="col-lg-4">
                <h3 class="mb-4 animate__animated animate__fadeIn">Quick Actions</h3>
                
                <a href="select_exam.php" class="action-btn exam animate__animated animate__fadeInRight animate__delay-1s">
                    <i class="fas fa-play-circle action-icon"></i>
                    <span>Start New Exam</span>
                </a>
                
                <a href="old_exam_results.php" class="action-btn results animate__animated animate__fadeInRight animate__delay-2s">
                    <i class="fas fa-chart-bar action-icon"></i>
                    <span>View Results</span>
                </a>
                
                <a href="games.php" class="action-btn games animate__animated animate__fadeInRight animate__delay-3s">
                    <i class="fas fa-gamepad action-icon"></i>
                    <span>Educational Games</span>
                </a>
                
                <a href="module.php" class="action-btn modules animate__animated animate__fadeInRight animate__delay-4s">
                    <i class="fas fa-puzzle-piece action-icon"></i>
                    <span>Learning Modules</span>
                </a>
                
                <!-- Fun Fact Card -->
                <div class="fun-fact-card mt-4 animate__animated animate__fadeIn animate__delay-2s">
                    <div class="text-center">
                        <i class="fas fa-lightbulb card-icon" style="color: var(--warning)"></i>
                        <h4 class="card-title">Did You Know?</h4>
                        <p class="card-text">Students who use interactive learning methods retain 75% of what they learn, compared to just 5% from lectures alone!</p>
                        <button class="btn btn-sm btn-outline-primary">More Tips</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Initialize carousel
    var carousel = new bootstrap.Carousel(document.getElementById('dashboardCarousel'), {
        interval: 5000,
        wrap: true,
        pause: "hover"
    });
    
    // Add hover effects to cards
    document.querySelectorAll('.content-card, .fun-fact-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>
</body>
</html>