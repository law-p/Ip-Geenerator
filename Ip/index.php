<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Information</title>
    <style>
        body {
    font-family: Arial, sans-serif;
}

.container {
    text-align: center;
    margin-top: 50px;
}

button {
    font-size: 1.2em;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Hey! Welcome to IP Info</h1>
        <button id="getInfoBtn">Get Info</button>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>IP Information</h2>
            <p><strong>Your Device IP Address:</strong> <span id="ipAddress"></span></p>
            <p><strong>Country:</strong> <span id="country"></span></p>
            <p><strong>Latitude:</strong> <span id="latitude"></span></p>
            <p><strong>Longitude:</strong> <span id="longitude"></span></p>
        </div>
    </div>

    <script>
        document.getElementById('getInfoBtn').addEventListener('click', function() {
    fetch('https://api.ipify.org/?format=json')
        .then(response => response.json())
        .then(data => {
            const ipAddress = data.ip;
            const ipinfoEndpoint = `https://ipinfo.io/${ipAddress}?token=188855f6b214f4`;

            fetch(ipinfoEndpoint)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ipAddress').textContent = ipAddress;
                    document.getElementById('country').textContent = data.country;
                    const [latitude, longitude] = data.loc.split(',');
                    document.getElementById('latitude').textContent = latitude;
                    document.getElementById('longitude').textContent = longitude;

                    document.getElementById('modal').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        })
        .catch(error => console.error('Error:', error));
});

document.getElementsByClassName('close')[0].addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});

    </script>
</body>
</html>
