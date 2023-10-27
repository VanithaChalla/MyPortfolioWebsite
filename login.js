function loginUser() {
    console.log("Login button clicked");

    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.trim() == "success") {
                window.location.href = "dashboard.php";
            } else {
                displayMessage(xhr.responseText.trim());
            }
        }
    }
    xhr.send("username=" + username + "&email=" + email + "&password=" + password);

    return false; // Prevent form submission
}

function displayMessage(message) {
    var messageElement = document.getElementById("message");
    messageElement.innerHTML = message;
    messageElement.style.display = "block";

    setTimeout(function() {
        messageElement.style.display = "none";
        location.reload();
    }, 5000); // Hide message after 5 seconds

    
}
