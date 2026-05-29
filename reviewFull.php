<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db.php';

$result = $conn->query("SELECT * FROM reviews WHERE status = 'pending' ORDER BY id DESC");
$pending_reviews = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pending_reviews[] = $row;
    }
}
?>

<html>
<head>
    <title>Pending Reviews</title>
    <link rel="icon" href="img\BLogo.jpg" type="image/x-icon">
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<div class="admin-dashboard">
<div class="container">
    <div class="sidebar">
        <div class="logo">
            <img src="img/BLogo.jpg" alt="Logo">
        </div>
        <nav class="navLinks">
            <a href="dashboard.php">Dashboard</a>
          <!--  <a href="#">Messages</a> -->
            <a href="reviewFull.php" class="active">Reviews</a>
        </nav>
        <div class="logout">
            <a href="login.php">Logout</a>
        </div>
    </div>

    <div class="mainContent">
        <h1>Reviews</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Approval</th>
            </tr>
            <?php foreach ($pending_reviews as $review): ?>
                <tr>
                    <td><?= htmlspecialchars($review['name']) ?></td>
                    <td class="stars">
                        <?php for ($i = 0; $i < $review['rating']; $i++) echo '&#9733;'; ?>
                        <?php for ($i = $review['rating']; $i < 5; $i++) echo '<span style="color:#ccc">&#9733;</span>'; ?>
                    </td>
                    <td><?= nl2br(htmlspecialchars($review['message'])) ?></td>
                    <td>
                        <form method="post" style="display:inline;" action="dashboard.php">
                            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                            <button type="submit" name="approve">Yes</button>
                        </form>
                        <form method="post" style="display:inline;" action="dashboard.php">
                            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                            <button type="submit" name="reject">No</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($pending_reviews)): ?>
                <tr><td colspan="4">No pending reviews.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>
</div>

</body>
</html>
