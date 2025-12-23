document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgot-password-form');

    forgotPasswordForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;

        // TODO: Implement client-side validation, e.g., check for a valid email format.
        // If validation passes, you can submit the form to the server using AJAX or a fetch request.

        // For now, just log the input for demonstration purposes.
        console.log('Email:', email);

        // Simulate a successful submission for demonstration purposes
        // In a real application, you should handle this on the server side and send a password reset email.
        const isSubmissionSuccessful = true; // Set this to true upon successful email submission

        if (isSubmissionSuccessful) {
            // Redirect to the next page for the password reset process
            window.location.href = 'forgot password.html'; // Replace with the actual password reset page
        } else {
            // Display an error message if email submission fails
            alert('Email submission failed. Please try again.');
        }
    });
});