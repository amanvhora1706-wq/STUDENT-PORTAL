<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form submitted is the "Forgot Password" form
    if (isset($_POST["forgot_password_submit"])) {
        // Retrieve the user's email from the form
        $email = $_POST["email"];

        // TODO: Validate the email and check if it exists in your user database.
        // If the email is valid and exists, generate a unique verification code.

        // For demonstration purposes, generate a random 6-digit verification code
        $verificationCode = sprintf('%06d', rand(0, 999999));

        // TODO: Send the verification code to the user's email.
        // You can use a library like PHPMailer or the mail() function for this purpose.

        // For demonstration purposes, print the verification code to the screen
        echo "Verification code sent to your email: $verificationCode";

        // Store the verification code and the user's email in a session
        $_SESSION["verification_code"] = $verificationCode;
        $_SESSION["user_email"] = $email;
    }

    // Check if the form submitted is the "Reset Password" form
    if (isset($_POST["reset_password_submit"])) {
        $enteredVerificationCode = $_POST["verification_code"];
        $newPassword = $_POST["new_password"];

        // Check if the entered verification code matches the one stored in the session
        if ($enteredVerificationCode === $_SESSION["verification_code"]) {
            // TODO: Update the user's password in your user database with the new password.
            // You should use the user's email (stored in $_SESSION["user_email"]) to identify the user.

            // For demonstration purposes, just print a success message
            echo "Password reset successfully!";
        } else {
            // Verification code is incorrect, display an error message
            echo "Verification code is incorrect. Please try again.";
        }
    }
}
?>
