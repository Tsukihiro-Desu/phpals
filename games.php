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
    <h1>Available Games</h1>
    <div class="game-grid">
        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/memory_match_thumbnail.png" alt="Memory Match Game">
            </div>
            <h2>Memory Match</h2>
            <p>Test your memory skills with this classic card matching game.</p>
            <a href="memory_match.php" class="play-button">Play Now</a>
        </div>

        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/quiz_challenge_thumbnail.png" alt="Quiz Challenge Game">
            </div>
            <h2>Quiz Challenge</h2>
            <p>Answer trivia questions from different categories and earn points.</p>
            <a href="quiz_game.php" class="play-button">Play Now</a>
        </div>

        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/word_scramble_thumbnail.png" alt="Word Scramble Game">
            </div>
            <h2>Word Scramble</h2>
            <p>Unscramble the letters to form valid words.</p>
            <a href="word_scramble.php" class="play-button">Play Now</a>
        </div>

        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/hangman_thumbnail.png" alt="Hangman Game">
            </div>
            <h2>Hangman</h2>
            <p>Guess the hidden word before the hangman is completed.</p>
            <a href="hangman.php" class="play-button">Play Now</a>
        </div>

        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/puzzle_slider_thumbnail.png" alt="Puzzle Slider Game">
            </div>
            <h2>Puzzle Slider</h2>
            <p>Slide the tiles to rearrange the picture.</p>
            <a href="puzzle_slider.php" class="play-button">Play Now</a>
        </div>

        <div class="game-card">
            <div class="game-thumbnail">
                <img src="img/connect_four_thumbnail.png" alt="Connect Four Game">
            </div>
            <h2>Connect Four</h2>
            <p>Be the first to connect four of your colored discs in a row.</p>
            <a href="connect_four.php" class="play-button">Play Now</a>
        </div>
    </div>
</div>

<style>
/* Styles for the games page */
.content {
    padding: 20px;
    margin-top: 80px; /* Adjust based on your header height */
    text-align: center;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

.game-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.game-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
    text-align: center; /* Center text within the card */
}

.game-thumbnail {
    width: 120px; /* Adjusted thumbnail size */
    height: 120px; /* Adjusted thumbnail size */
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 15px; /* Increased margin below thumbnail */
    border: 2px solid #bbb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.game-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.game-card h2 {
    color: #333;
    margin-top: 0;
    margin-bottom: 10px;
    font-size: 1.3em; /* Adjusted font size */
}

.game-card p {
    color: #666;
    margin-bottom: 15px;
    font-size: 0.95em; /* Adjusted font size */
}

.play-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: inline-block;
    margin-top: 10px; /* Added margin above the button */
}

.play-button:hover {
    background-color: #1e7e34;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .content {
        padding: 15px;
        margin-top: 60px;
    }

    h1 {
        font-size: 1.6em;
        margin-bottom: 15px;
    }

    .game-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .game-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
    text-align: center; /* Center text within the card */
    justify-content: space-between; /* Distribute space vertically */
    height: 280px; /* Set a minimum height for even distribution - adjust as needed */
}

.game-thumbnail {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #bbb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px; /* Add some top margin */
}

.game-card h2 {
    color: #333;
    margin-top: 0;
    margin-bottom: 5px;
    font-size: 1.3em;
}

.game-card p {
    color: #666;
    margin-bottom: 10px;
    font-size: 0.95em;
}

.play-button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    display: inline-block;
    margin-bottom: 10px; /* Add some bottom margin */
}

}
</style>

<?php
include "footer.php"; // Include your existing footer file
?>