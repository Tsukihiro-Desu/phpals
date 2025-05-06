<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

include "connection.php";
include "header.php"; // Include your existing header file
?>

<div class="content">
    <h1>Available PDF Modules</h1>
    <div class="module-grid">
        <div class="card">
            <h2>Communication Skills [ Filipino ]</h2>
            <p></p>
            <div class="pdf-preview-container">
                <embed src="modules/filipino.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="300px">
            </div>
            <a href="modules/filipino.pdf" class="download-btn" download="filipino.pdf">Download PDF</a>
        </div>

        <div class="card">
            <h2>Digital Citizenship</h2>
            <p></p>
            <div class="pdf-preview-container">
                <embed src="modules/life.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="300px">
            </div>
            <a href="modules/life.pdf" class="download-btn" download="life.pdf">Download PDF</a>
        </div>

        <div class="card">
            <h2>Understanding the Self and Society</h2>
            <p></p>
            <div class="pdf-preview-container">
                <embed src="modules/uts.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="300px">
            </div>
            <a href="modules/uts.pdf" class="download-btn" download="uts.pdf">Download PDF</a>
        </div>

        <div class="card">
            <h2>Scientific and Critical Thinking Skills</h2>
            <p></p>
            <div class="pdf-preview-container">
                <embed src="modules/science.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="300px">
            </div>
            <a href="modules/database-design.pdf" class="download-btn" download="Database_Design.pdf">Download PDF</a>
        </div>

        <div class="card">
            <h2>Mathematical & Problem-Solving Skills</h2>
            <p></p>
            <div class="pdf-preview-container">
                <embed src="modules/math.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="300px">
            </div>
            <a href="modules/math.pdf" class="download-btn" download="math.pdf">Download PDF</a>
        </div>

    </div>
</div>

<style>
/* Default styles for larger screens (PC) */
.content {
    padding: 20px;
    margin-top: 80px; /* Adjust based on your header height */
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.module-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Two or more columns on PC */
    gap: 20px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card h2 {
    margin-top: 0;
    margin-bottom: 10px;
    color: #333;
    font-size: 1.2em;
}

.card p {
    color: #666;
    margin-bottom: 10px;
    font-size: 0.95em;
}

.pdf-preview-container {
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden; /* Ensure embed doesn't overflow */
    height: 300px; /* Fixed height for embed on larger screens */
}

.pdf-preview-container embed {
    height: 100%; /* Make embed fill the container height */
}

.download-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
    transition: background-color 0.3s ease;
    text-align: center;
    margin-top: 10px;
}

.download-btn:hover {
    background-color: #0056b3;
}

.file-info {
    color: #777;
    font-size: 0.9em;
    margin-top: 10px;
    text-align: right;
}

/* Media query for screens smaller than 768px (typical mobile devices) */
@media (max-width: 767.98px) {
    .content {
        padding: 15px;
        margin-top: 60px; /* Adjust for smaller header on mobile if needed */
    }

    h1 {
        font-size: 1.5em;
        margin-bottom: 15px;
    }

    .module-grid {
        grid-template-columns: 1fr; /* Single column on mobile */
        gap: 15px;
    }

    .card {
        padding: 15px;
    }

    .card h2 {
        font-size: 1.1em;
        margin-bottom: 8px;
    }

    .card p {
        font-size: 0.9em;
        margin-bottom: 8px;
    }

    .pdf-preview-container {
        height: 200px; /* Smaller height for embed on mobile */
        margin-bottom: 10px;
    }

    .download-btn {
        padding: 8px 12px;
        font-size: 0.9em;
        margin-top: 8px;
    }

    .file-info {
        font-size: 0.8em;
        margin-top: 8px;
        text-align: left; /* Align file info to the left on mobile for better readability */
    }
}

/* Optional: Adjust for very small screens */
@media (max-width: 480px) {
    h1 {
        font-size: 1.3em;
    }
}
</style>

<?php
// Include the footer
include "footer.php";
?>