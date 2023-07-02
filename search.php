<?php
// database connection
include('config.php');

if (isset($_POST['query'])) {
    $searchQuery = $_POST['query'];

    // Perform the search query and retrieve the results
    // Replace this with your own search logic and database query

    // Example: Searching for patient records based on name or any other criteria
    $sql = "SELECT * FROM user WHERE full_name LIKE '%$searchQuery%'";
    $result = mysqli_query($con, $sql);

    // Process the search results
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['id'];
            // Display the search results as pressable cards with patient information
            echo '<a href="patient_details.php?id='.$userId.'" class="pressable-card result-card">';
            echo '<h2>'.$row['full_name'].'</h2>';
            echo '<p>Email Address: '.$row['email_address'].'</p>';
            echo '<p>  Contact Number: '.$row['contact_number'].'</p>';
            echo '<p>  Address: '.$row['full_address'].'</p>';
            echo '</a>';
        }
    } else {
        // Display a message when no results are found
        echo "<p>No results found.</p>";
    }
}
?>