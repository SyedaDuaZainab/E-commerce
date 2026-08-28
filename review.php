<?php 
include "Element/navbar.php";

if (!empty($_POST)) { // Check if the POST array is not empty
    $order = $_POST['od_id']; // Get the order ID from the POST data
    echo "
    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='styles.css'>
        <title>The Product Review and Rating</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                background-color: darkgray;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                text-align: center;
            }
            .rating {
                text-align: center;
                margin-bottom: 20px;
            }
            .stars {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            .star {
                font-size: 30px;
                cursor: pointer;
                color: #ccc;
            }
            .star.selected {
                color: gold;
            }
            textarea {
                width: 100%;
                height: 100px;
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: black;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #444;
            }
            .reviews {
                margin-top: 20px;
            }
            .review {
                background-color: white;
                padding: 10px;
                margin: 10px 0;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body>
        <main class='review'>
            <div class='container'>
                <h1>Review Form</h1>
                <div class='rating'>
                    <span id='rating'>0</span>/5
                </div>
                <form action='cus_backend/addReview.php' method='POST'>
                    <div class='stars' id='stars'>
                        <span class='star' data-value='1'>★</span>
                        <span class='star' data-value='2'>★</span>
                        <span class='star' data-value='3'>★</span>
                        <span class='star' data-value='4'>★</span>
                        <span class='star' data-value='5'>★</span>
                    </div>
                    <input type='text' value='" . htmlspecialchars($order) . "' name='od_id' hidden>
                    <p>Share your review:</p>
                    <textarea id='review' name='det' placeholder='Write your review here'></textarea>
                    <button type='button' id='submit'>Submit</button>
                </form>
                <div class='reviews' id='reviews'></div>
            </div>
        </main>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.star');
                const rating = document.getElementById('rating');
                const reviewText = document.getElementById('review');
                const submitBtn = document.getElementById('submit');
                const reviewsContainer = document.getElementById('reviews');

                stars.forEach((star) => {
                    star.addEventListener('click', () => {
                        const value = parseInt(star.getAttribute('data-value'));
                        rating.innerText = value;

                        stars.forEach((s) => s.classList.remove('selected'));
                        for (let i = 0; i < value; i++) {
                            stars[i].classList.add('selected');
                        }
                    });
                });

                submitBtn.addEventListener('click', () => {
                    const review = reviewText.value;
                    const userRating = parseInt(rating.innerText);

                    if (!userRating || !review) {
                        alert(' Please select a rating and provide a review before submitting.');
                        return;
                    }

                    const reviewElement = document.createElement('div');
                    reviewElement.classList.add('review');
                    reviewElement.innerHTML = `<p><strong>Rating: ${userRating}/5</strong></p><p>${review}</p>`;
                    reviewsContainer.appendChild(reviewElement);

                    reviewText.value = '';
                    rating.innerText = '0';
                    stars.forEach((s) => s.classList.remove('selected'));
                });
            });
        </script>
    </body>
    </html>";
}
?>