// signup.js

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("signup-form");
    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", async(e) => {
        e.preventDefault(); // stop normal form submit

        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        // Basic validation
        if (!username || !email || !password) {
            alert("All fields are required.");
            return;
        }

        // Email format validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        // Password strength check
        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return;
        }

        try {
            const response = await fetch("signup.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `username=${encodeURIComponent(username)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            });

            const result = await response.text();

            if (result === "success") {
                alert("Account created successfully!");
                window.location.href = "login.html";
            } else if (result === "exists") {
                alert("Username or email already exists.");
            } else {
                alert("Signup failed. Please try again.");
            }

        } catch (error) {
            console.error("Error:", error);
            alert("Server error. Please try later.");
        }
    });
});