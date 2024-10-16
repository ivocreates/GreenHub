<?php
include '../templates/header.php';
?>
        <section class="article">
            <h2>The Importance of Recycling</h2>
            <p>Recycling is crucial for reducing waste and conserving natural resources. By recycling materials like paper, plastic, and metal, we can reduce the amount of waste that ends up in landfills and decrease the need for raw materials.</p>
            <img src="../images/recycling.jpg" alt="Recycling bins" class="article-image">
            <h3>How to Recycle Properly</h3>
            <p>To recycle effectively, make sure to separate recyclables from non-recyclables. Rinse out containers to remove food residues and follow local recycling guidelines for proper sorting.</p>
            <h3>Benefits of Recycling</h3>
            <ul>
                <li>Reduces landfill waste</li>
                <li>Conserves natural resources</li>
                <li>Reduces pollution and greenhouse gas emissions</li>
            </ul>
            <p>Recycling also promotes sustainability by reusing materials and reducing the environmental impact of waste disposal.</p>
        </section>
    </main>

<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>



<?php
include '../templates/footer.php';
?>

<style>
    /* Add this to your styles.css */

/* Back button styling */
.back-to-home {
    position: absolute; /* Absolute positioning within the header */
    top: 10px;
    left: 10px;
    background-color: #4CAF50; /* Solid background color */
    color: white; /* White color for the icon */
    padding: 8px; /* Slightly larger padding */
    border: 2px solid white; /* White border to define the button */
    border-radius: 50%;
    font-size: 1.2em; /* Adjust font size as needed */
    text-align: center;
    text-decoration: none;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2); /* Subtle shadow for depth */
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
    z-index: 1000;
}

.back-to-home i {
    vertical-align: middle;
}

.back-to-home:hover {
    background-color: #4CAF50; /* Change background color on hover */
    color: white; /* Maintain white color for the icon */
    border-color: #4CAF50; /* Change border color on hover */
    transform: scale(1.1); /* Slightly larger on hover */
    box-shadow: 0 4px 8px rgba(0,0,0,0.3); /* Enhanced shadow effect */
}

.back-to-home:active {
    transform: scale(1.05); /* Slightly smaller scale when clicked */
}

/* Ensure header has relative positioning */
header {
    position: relative;
    padding: 20px;
    background-color: #4CAF50; /* Ensure header background is solid */
    color: white;
}

</style>