document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.getElementById('profileForm');
    const saveChangesButton = document.getElementById('saveChanges');

    saveChangesButton.addEventListener('click', function() {
        const fullName = document.getElementById('fullName').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const formData = new FormData();
        formData.append('fullName', fullName);
        formData.append('email', email);
        formData.append('password', password);

        // Send an AJAX request to save_profile.php
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'edit profile.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Profile changes saved successfully.');
                // Optionally, you can update the user interface here.
            } else {
                alert('Error saving profile changes.');
            }
        };

        xhr.onerror = function() {
            alert('Request failed. Please try again later.');
        };

        xhr.send(formData);
    });
});