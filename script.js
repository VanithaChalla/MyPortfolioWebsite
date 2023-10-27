document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    var email = document.getElementById("email").value;
    var messageElement = document.getElementById("message");

    // Check if the email format is valid
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showMessage("Invalid email address.");
        return false;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_email.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.trim() == "exists") {
                showMessage("Email already exists.");
            } else {
                showMessage("Email is available.");
            }
        }
    }
    xhr.send("email=" + email);
});

function showMessage(message) {
    var messageElement = document.getElementById("message");
    messageElement.innerHTML = message;
    messageElement.style.display = "block";

    setTimeout(function() {
        messageElement.style.display = "none";
    }, 5000);
}
