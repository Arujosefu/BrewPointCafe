<?php
session_start();
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['Name']);
    $message = trim($_POST['message']);
    $rating = intval($_POST['rate']);

    if (!empty($name) && !empty($rating)) {
        $stmt = $conn->prepare("INSERT INTO reviews (name, message, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $message, $rating);
        $stmt->execute();
        $stmt->close();
        $_SESSION['review_success'] = "Thank you! Your review has been submitted and is pending approval.";
        header("Location: review.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BrewPointCafe | Reviews</title>
	<link rel="icon" href="img\BLogo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
	<div class="navLogo">
		<img class="logoW" src="img/BLogo.jpg">
	</div>
	
	<div class="hamburger">&#9776;</div> 
	
	<div class="navLink">
		<a href="index.html">Home</a>
		<a href="about.html">About Us</a>
		<a href="menu.html">Menu</a>
		<a href="gallery.html">Gallery</a>
		<a href="contact.html">Contact & Location</a>
		<a class="active" href="review.php">Review</a>
	</div>		
</div>

<div class="navOverlay"></div>

<div class="reviewTitle"><h1>What our customers say</h1></div>
<div class="reviewCarouselContainer">
    <button class="reviewPrevBtn">&#9664;</button>
<div class="reviewDisplay reviewSlidesWrapper">

<?php
$result = $conn->query("SELECT * FROM reviews WHERE status = 'approved' ORDER BY id DESC");
$counter = 0;
echo '<div class="slide active">';
while ($row = $result->fetch_assoc()) {
    if ($counter > 0 && $counter % 3 == 0) {
        echo '</div><div class="slide">';
    }
    echo '<div class="reviewPost">';
    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
    echo '<p>' . nl2br(htmlspecialchars($row['message'])) . '</p>';
    echo '<div class="starRating">';
    for ($i = 0; $i < $row['rating']; $i++) {
        echo '<span style="color:#D2BC72;">&#9733;</span>';
    }
    for ($i = $row['rating']; $i < 5; $i++) {
        echo '<span style="color:#E6E6E6;">&#9733;</span>';
    }
    echo '</div>';
    echo '</div>';
    $counter++;
}
echo '</div>';
?>
</div>

    <button class="reviewNextBtn">&#9654;</button>
</div>

<div class="line"></div>

<div class="reviewBox">
	<h2>Tell others what you think</h2>
	<h3>How would you rate your overall experience?</h3>
	<form method="post" action="review.php">
		<div class="reviewForm">
		<?php
            if (isset($_SESSION['review_success'])) {
                echo '<div class="reviewSuccessMessage">' . $_SESSION['review_success'] . '</div>';
                unset($_SESSION['review_success']);
            }
        ?>
			<div class="starRating" id="starRating">
              <input type="radio" id="star1" name="rate" value="1" required />
              <label for="star1" data-value="1">&#9733;</label>
              <input type="radio" id="star2" name="rate" value="2" />
              <label for="star2" data-value="2">&#9733;</label>
              <input type="radio" id="star3" name="rate" value="3" />
              <label for="star3" data-value="3">&#9733;</label>
              <input type="radio" id="star4" name="rate" value="4" />
              <label for="star4" data-value="4">&#9733;</label>
              <input type="radio" id="star5" name="rate" value="5" />
              <label for="star5" data-value="5">&#9733;</label>
			</div>
			<input type="text" name="Name" placeholder="Name" required><br>
			<textarea name="message" rows="9" placeholder="Describe your experience"></textarea>
			<button type="submit">Submit</button>
		</div>
	</form>
</div>

<div class="footlink">
	<div class="footContainer">
		<div>
			<img class="logoB" src="img/BLogo.jpg">
		</div>
		<div class="footContact">
			<h2>Contact Us</h2>
			<p>brewpointcafe23@gmail.com</p>
		</div>
		<div class="footSocial">
			<h2>Follow Us</h2>
			<a href="https://www.facebook.com/ILoveBrewPointCafe" target="_blank">
				<img src="img/FBW.png">
			</a>
			<a href="https://www.instagram.com/brewpointcafe" target="_blank">
				<img src="img/IGW.png">
			</a>
		</div>
		<div class="footNav">
			<a class="footlink2" href="index.html">Home</a><br><br>
			<a class="footlink2" href="about.html">About Us</a><br><br>
			<a class="footlink2" href="menu.html">Menu</a><br><br>
			<a class="footlink2" href="gallery.html">Gallery</a><br><br>
			<a class="footlink2" href="contact.html">Contact & Location</a><br><br>
			<a class="footlink2" href="review.php">Review</a><br><br>
		</div>
	</div>
	<footer>
		<center>&copy; 2025 BrewPointCafe. All rights reserved. | Developed by: Mickyla Martinez & Aljoseph Dimaandal</center>
	</footer>
</div>

<script src="script.js"></script>
</body>
</html>