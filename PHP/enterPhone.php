<?php
session_start();

if ($_SESSION['loggedin'] == false) {
    header("Location:./loginPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Phone Number</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>

<body>
    <h1 class="white-title">Geben Sie Ihre Telefon Nummer ein und sichern Sie sich 10% Rabatt</h1>
    <input type="range" name="phone" id="phone" min="000000000000" max="9999999999999" value="0">
    <p id="value"></p>
    <div class="flex-center">
        <button onclick="openCaptcha()" class="login-button">Bestätigen</button>
    </div>

    
</body>

<script>
    const value = document.querySelector("#value");
    const input = document.querySelector("#phone");
    value.textContent = "+" + input.value;
    input.addEventListener("input", (event) => {
        value.textContent = "+" + event.target.value;
    });

    function openCaptcha() {
        document.body.innerHTML += `
        <div id="captcha">
        <h2 class="black-title">Bestätigen Sie, dass Sie kein Roboter sind indem Sie diese einfache Gleichung lösen.</h2>
        <img width="100%" src="../Img/captchaImg.jpg" alt="">
        <input type="number" name="result" id="result">
        <button onclick="submitCaptcha()" class="login-button">Prüfen</button>
    </div>
        `;
    }

    function submitCaptcha() {
        if (document.getElementById("result").value == 3) {
            window.open("../Img/unknown.png", "_self");
        } else {
            alert("Falsche Antwort");
        }
    }
</script>

</html>