// login.js

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("login-form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", async(e) => {
        e.preventDefault(); // stop default form submit

        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        // Basic validation
        if (username === "" || password === "") {
            alert("Please enter both username and password.");
            return;
        }

        // OPTIONAL: send data using fetch (AJAX)
        try {
            const response = await fetch("login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
            });

            const result = await response.text();

            // Handle server response
            if (result === "success") {
                alert("Login successful!");
                window.location.href = "dashboard.html"; // redirect after login
            } else {
                alert("Invalid username or password.");
            }

        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        }
    });
});