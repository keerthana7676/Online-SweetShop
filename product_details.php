<?php

include 'config.php';

session_start();

if ( isset($_POST['submit_review'])) {
    $rating = intval($_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Insert the review into the database
    $insert_review_sql = "INSERT INTO reviews (product_id, user_id, rating, comment) VALUES ('$product_id', '$user_id', '$rating', '$comment')";
    if ($conn->query($insert_review_sql) === true) {
        $message[] = 'Review submitted successfully!';
    } else {
        $message[] = 'Error: ' . $insert_review_sql . '<br>' . $conn->error;
    }
}
?>

<!-- ... -->

<section class="product-reviews">
    <h2>Product Reviews</h2>
    <?php
    $select_reviews_sql = "SELECT * FROM reviews WHERE product_id = $product_id ORDER BY created_at DESC";
    $result_reviews = $conn->query($select_reviews_sql);
    if ($result_reviews->num_rows > 0) {
        while ($review = $result_reviews->fetch_assoc()) {
            echo "<p><strong>User ID: {$review['user_id']}</strong><br>";
            echo "Rating: {$review['rating']} stars<br>";
            echo "Comment: {$review['comment']}</p>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }
    ?>
</section>

<!-- Add Review Form -->
<section class="add-review">
    <h2>Add Your Review</h2>
    <form action="" method="post">
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>

        <label for="comment">Comment:</label><br>
        <textarea name="comment" rows="4" required></textarea><br>

        <input type="submit" name="submit_review" value="Submit Review">
    </form>
</section>

<!-- ... -->
