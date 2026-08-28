<?php 
include "Element/navbar.php";

if (!empty($_POST)) { 
    $product = $_POST['pro_id']; 
    $od = $_POST['od_id']; 
    $customer = $_POST['cus_id']; 
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Review</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        main {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .stars {
            display: flex;
            justify-content: center;
            gap: 5px;
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
    </style>
</head>
<main>
    <div class="container">
        <form action="cus_backend/addReview.php" method="POST">
            <div class="rating">
                <h2>Rate this product</h2>
                <div class="stars">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" name="rating" id="rating" value="0" required>
            </div>
            
            <div class="feedback">
                <h2>Your Feedback</h2>
                <textarea id="feedback" placeholder="Write your review here..." name='desc' required></textarea>
            </div>
            
            <input type='text' value='<?php echo $product; ?>' name='pro_id' hidden>
            <input type='text' value='<?php echo $customer; ?>' name='cus_id' hidden>
            <input type='text' value='<?php echo $od; ?>' name='od_id' hidden>
            <button type="submit">Submit Review</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-value');
                document.getElementById('rating').value = rating;
                document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < rating; i++) {
                    document.querySelectorAll('.star')[i].classList.add('selected');
                }
            });
        });
    </script>
</main>
</html>
