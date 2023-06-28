 <?php
    // check_email.php

    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Database connection parameters
        $servername = 'localhost';
        $username = 'root';
        $password = ''; // Replace with your database password
        $dbname = 'healteeth';

        // Create a new mysqli instance
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to check if the email exists
        $query = 'SELECT * FROM user WHERE email_address = email';
        $result = $conn->query($query);

        // If the email exists, return 'exists' response
        if ($result->num_rows > 0) {
            echo 'exists';
        } else {
            echo 'notexists';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    ?>