<?php 
include '../templates/header.php';
include '../php/database.php'; // Database connection

if(!isset($_SESSION)) 
{ 
    session_start(); 
}  // Start the session

// Check if user is logged in
if (!isset($_SESSION['user']['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if a new post or comment has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['post-title']) && isset($_POST['post-content'])) {
        // Handle new post submission
        $title = $_POST['post-title'];
        $content = $_POST['post-content'];
        $username = $_SESSION['user']['username']; // Use the logged-in user's username

        // Insert new post into the database
        $sql = "INSERT INTO posts (title, content, username, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $content, $username);
        if ($stmt->execute()) {
            echo "New post created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['comment-content']) && isset($_POST['post_id'])) {
        // Handle new comment submission
        $post_id = $_POST['post_id'];
        $comment_content = $_POST['comment-content'];
        $username = $_SESSION['user']['username']; // Use the logged-in user's username

        // Insert new comment into the database
        $sql = "INSERT INTO replies (post_id, content, username, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $post_id, $comment_content, $username);
        if ($stmt->execute()) {
            echo "Reply posted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<section class="forum">
    <h2>Community Forum</h2>

    <!-- Display all posts -->
    <div class="forum-posts">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($post = $result->fetch_assoc()): ?>
                <article class="post-card">
                    <div class="post-header">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><strong>Posted by:</strong> <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></p>
                    </div>
                    <div class="post-body">
                        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                    </div>

                    <!-- Display comments/replies for this post -->
                    <div class="post-replies">
                        <h4>Replies:</h4>
                        <?php
                            $sql_replies = "SELECT * FROM replies WHERE post_id = ? ORDER BY created_at ASC";
                            $stmt = $conn->prepare($sql_replies);
                            $stmt->bind_param("i", $post['id']);
                            $stmt->execute();
                            $replies = $stmt->get_result();
                        ?>
                        <?php if ($replies->num_rows > 0): ?>
                            <ul class="replies">
                                <?php while ($reply = $replies->fetch_assoc()): ?>
                                    <li class="reply-card">
                                        <strong><?php echo htmlspecialchars($reply['username']); ?>:</strong>
                                        <p><?php echo nl2br(htmlspecialchars($reply['content'])); ?></p>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p>No replies yet. Be the first to reply!</p>
                        <?php endif; ?>
                    </div>

                    <!-- Minimized reply form icon -->
                    <button class="reply-toggle" data-post-id="<?php echo $post['id']; ?>">
                        <i class="fas fa-reply"></i> Reply
                    </button>

                    <!-- Hidden reply form -->
                    <div class="reply-form-box" id="reply-form-<?php echo $post['id']; ?>" style="display: none;">
                        <form action="forum.php" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <label for="comment-content">Your Reply:</label>
                            <textarea id="comment-content" name="comment-content" rows="4" required></textarea>
                            <button type="submit" class="btn">Submit Reply</button>
                        </form>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts yet. Be the first to start a discussion!</p>
        <?php endif; ?>
    </div>

    <!-- Floating Action Button to Add New Post -->
    <button class="fab" id="add-post-btn">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Modal for adding a new post -->
    <div class="modal" id="add-post-modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Start a New Discussion</h2>
            <form action="forum.php" method="POST">
                <label for="post-title">Title:</label>
                <input type="text" id="post-title" name="post-title" required>

                <label for="post-content">Content:</label>
                <textarea id="post-content" name="post-content" rows="6" required></textarea>

                <button type="submit" class="btn">Submit Post</button>
            </form>
        </div>
    </div>
</section>


<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<?php
include '../templates/footer.php';
?>

<style>
/* General Styling */
.forum {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.forum h2 {
    text-align: center;
    color: #333;
}

/* Post and Reply Card Styles */
.post-card, .reply-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #fefefe;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.post-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.post-header h3 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.post-header p {
    margin: 5px 0;
    color: #777;
}

.post-body {
    margin-bottom: 10px;
}

.post-replies h4 {
    margin-top: 20px;
    font-size: 1.2rem;
    color: #4CAF50;
}

/* Reply Form and Button Styles */
.reply-toggle {
    background-color: #4CAF50;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
    padding: 10px 20px;
    border-radius: 5px;
    margin-top: 10px;
}

.reply-toggle i {
    margin-right: 5px;
}

.reply-form-box {
    margin-top: 10px;
}

.reply-form-box textarea {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
}

.reply-form-box .btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
}

/* Floating Action Button */
.fab {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 56px;
    height: 56px;
    background-color: #4CAF50;
    border-radius: 50%;
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.fab:hover {
    background-color: #45a049;
}

/* Modal Styling */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

.go-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border-radius: 50%;
    display: none;
}

.go-to-top i {
    font-size: 20px;
}

</style>

<script>
// Toggle reply form visibility
document.querySelectorAll('.reply-toggle').forEach(button => {
    button.addEventListener('click', function() {
        const postId = this.getAttribute('data-post-id');
        const replyForm = document.getElementById('reply-form-' + postId);
        replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
    });
});

// Open modal for adding a new post
const addPostBtn = document.getElementById('add-post-btn');
const addPostModal = document.getElementById('add-post-modal');
const closeModal = document.querySelector('.close-btn');

addPostBtn.onclick = function() {
    addPostModal.style.display = 'block';
};

closeModal.onclick = function() {
    addPostModal.style.display = 'none';
};

// Close the modal if clicked outside of it
window.onclick = function(event) {
    if (event.target == addPostModal) {
        addPostModal.style.display = 'none';
    }
};
</script>
