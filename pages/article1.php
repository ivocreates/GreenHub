<?php
include '../templates/header.php';
?>
        <section class="article">
            <h2>Understanding Solar Energy</h2>
            <p>Solar energy is a clean and renewable source of energy that harnesses the power of the sun. By converting sunlight into electricity or heat, solar energy systems can help reduce our reliance on fossil fuels and lower greenhouse gas emissions.</p>
            <img src="../images/solar-energy.jpg" alt="Solar panels" class="article-image">
            <h3>How Solar Panels Work</h3>
            <p>Solar panels consist of photovoltaic cells that capture sunlight and convert it into electricity. These panels are typically mounted on rooftops or in open areas to maximize exposure to sunlight.</p>
            <h3>Benefits of Solar Energy</h3>
            <ul>
                <li>Reduces electricity bills</li>
                <li>Decreases carbon footprint</li>
                <li>Provides energy independence</li>
            </ul>
            <p>In addition to these benefits, solar energy can also contribute to job creation and economic growth in the renewable energy sector.</p>
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