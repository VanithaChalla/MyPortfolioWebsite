
function registerUser() {
    console.log("Register button clicked");

    // Retrieve values
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var messageElement = document.getElementById("message");

    // Check if the email format is valid
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showMessage("Invalid email address.");
        return false;
    }
    function showMessage(message) {
        var messageElement = document.getElementById("message");
        messageElement.innerHTML = message;
        messageElement.style.display = "block";
    
        setTimeout(function() {
            messageElement.style.display = "none";
            location.reload(); // Reload the page after 3 seconds
        }, 3000); // Hide message after 3 seconds
    }
    
    // Your other functions go here, like registerUser(), checkEmailExists(), etc.
    

    // Check if the email already exists
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkemail.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.trim() == "exists") {
                showMessage("Email already exists. Please try another email.");
            } else {
                // Proceed with registration
                var xhr2 = new XMLHttpRequest();
                xhr2.open("POST", "register.php", true);
                xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr2.onreadystatechange = function() {
                    if (xhr2.readyState == 4 && xhr2.status == 200) {
                        if (xhr2.responseText.trim() == "success") {
                            showMessage("Registration successful!");
                        } else {
                            showMessage(" " + xhr2.responseText);
                        }
                    }
                }
                xhr2.send("username=" + username + "&email=" + email + "&password=" + password);
            }
        }
    }
    xhr.send("email=" + email);

    return false; // Prevent form submission
}
