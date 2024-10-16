<?php 
session_start();
include 'database.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $bio = $_POST['bio'];  // User input bio
    $user_id = $_SESSION['user']['id'];  // Current user ID
    
    // Handle profile picture upload
    $profile_pic = $_FILES['profile_pic'];
    $profile_pic_path = '';

    if ($profile_pic['name']) {
        $target_dir = "../uploads/";  // Change this to your desired directory
        $target_file = $target_dir . basename($profile_pic['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($profile_pic["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($profile_pic["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($profile_pic["tmp_name"], $target_file)) {
                $profile_pic_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update the user's profile in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, bio = ?, profile_pic = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $bio, $profile_pic_path, $user_id);

    if ($stmt->execute()) {
        // Update the session with new details
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['bio'] = $bio;
        $_SESSION['user']['profile_pic'] = $profile_pic_path;  // Save profile picture in the session
        header("Location: profile.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your styles.css -->
</head>
<body>
    <!-- Header -->
    <?php include '../templates/header.php'; ?>

    <div class="profile-container">
        <h2>Edit Profile</h2>

        <div class="profile-card">
            <!-- Form to update user info -->
            <form action="edit-profile.php" method="post" enctype="multipart/form-data">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['user']['username']); ?>" required>

                <label for="bio">Bio:</label>
                <!-- Check if the user has a bio and set a default empty value if not -->
                <textarea name="bio" required><?php echo isset($_SESSION['user']['bio']) ? htmlspecialchars($_SESSION['user']['bio']) : ''; ?></textarea>

                <label for="profile_pic">Profile Picture:</label>
                <input type="file" name="profile_pic" accept="image/*">

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../templates/footer.php'; ?>
</body>
</html>
