<?php
// Include the database connection
include '../php/database.php'; // Ensure this file contains the connection setup for $conn
include '../templates/header.php';

// Prepare and execute the query to fetch the articles
$stmt = $conn->prepare("SELECT id, title, content, image FROM articles ORDER BY created_at DESC LIMIT 2");
$stmt->execute();
$articles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch articles as an array
$stmt->close();
?>


<section class="articles"> 
    <?php foreach ($articles as $article): ?> <!-- Loop through each article -->
        <article>
            <h2><?php echo htmlspecialchars($article['title']); ?></h2>
            <p><?php echo htmlspecialchars($article['content']); ?></p>
            <?php if (!empty($article['image'])): ?>
                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Article Image" class="article-image">
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</section>

<section class="highlight">
    <h3>Why Choose GreenHub?</h3>
    <p>At GreenHub, we believe in empowering individuals to make sustainable choices. Our platform provides you with:</p>
    <ul>
        <li><strong>In-Depth Guides:</strong> Comprehensive articles and tips on living sustainably.</li>
        <li><strong>Expert Advice:</strong> Insights from environmental experts and enthusiasts.</li>
        <li><strong>Product Reviews:</strong> Recommendations for eco-friendly products that meet high standards.</li>
        <li><strong>Community Engagement:</strong> Connect with like-minded individuals and participate in local events.</li>
    </ul>
    <a href="community.php" class="btn">Join Our Community</a>
</section>

<section class="call-to-action">
    <h3>Get Involved</h3>
    <p>Every small action counts. Start making a difference today by exploring our eco-tips, reading about renewable energy, and finding out how you can get involved in your community.</p>
    <a href="contact.php" class="btn">Contact Us</a>
</section>

<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<?php
include '../templates/footer.php';
?>
