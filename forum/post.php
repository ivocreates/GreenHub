<?php
session_start();
include '../php/database.php';

// Fetch post details from the database
$post_id = $_GET['id'];
$sql_post = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql_post);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

// Fetch replies for the post
$sql_replies = "SELECT * FROM replies WHERE post_id = ? ORDER BY created_at ASC";
$stmt_replies = $conn->prepare($sql_replies);
$stmt_replies->bind_param("i", $post_id);
$stmt_replies->execute();
$replies = $stmt_replies->get_result();
?>

<section class="post-details">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p><strong>Posted by:</strong> <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></p>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

    <h3>Replies</h3>
    <div class="replies">
        <?php if ($replies->num_rows > 0): ?>
            <?php while ($reply = $replies->fetch_assoc()): ?>
                <div class="reply">
                    <p><strong><?php echo htmlspecialchars($reply['username']); ?>:</strong></p>
                    <p><?php echo nl2br(htmlspecialchars($reply['content'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No replies yet. Be the first to reply!</p>
        <?php endif; ?>
    </div>

    <!-- Form to submit a reply -->
    <h3>Post a Reply</h3>
    <form action="submit-reply.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <label for="reply-content">Your Reply:</label>
        <textarea id="reply-content" name="content" rows="4" required></textarea>
        <button type="submit" class="btn">Submit Reply</button>
    </form>
</section>
