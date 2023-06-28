<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
    // check_email.php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $stmt = $conn->prepare('SELECT * FROM user WHERE email_address = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the email exists, display a success message and provide a button to trigger the password reset
        if ($result->num_rows > 0) {
            echo '<p style="color: green;">This email exists in our records. Proceeding with password reset...</p>';
        } else {
            echo '<p style="color: red;">This email does not exist in our records. Please try again.</p>';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button id="resetButton">Reset Password</button>
    </form>

    <script>
    $(document).ready(function() {
        // Button click event handler
        $('#resetButton').click(function() {
            var email = $('#email').val();
            
            // Send the email value to send_reset_link.php using jQuery AJAX
            $.ajax({
                url: 'send_reset_link.php',
                method: 'POST',
                data: { email: email },
                success: function(response) {
                    console.log('Reset link sent successfully.');
                }
            });
        });
    });
    </script>
</body>
</html>
