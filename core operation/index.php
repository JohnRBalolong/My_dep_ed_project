<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Reader</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div>
        <label for="fileInput">Choose Excel File:</label>
        <input type="file" id="fileInput">
        <label for="sheetName">Sheet Name:</label>
        <input type="text" id="sheetName" placeholder="Enter sheet name">
        <button onclick="getData()">Get Data</button>
    </div>

    <div id="result"></div>
    <div id="totals"></div>

    <script>
       function getData() {
    var sheetName = $('#sheetName').val();
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];

    var formData = new FormData();
    formData.append('file', file);
    formData.append('sheetName', sheetName);

    $.ajax({
        type: 'POST',
        url: 'read_excel.php',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            // Check if 'data' is an array
            if (Array.isArray(response.data)) {
                displayData(response.data);
            } else {
                console.error('Invalid data format:', response.data);
            }

            // Display totals
            if (response.totals) {
                $('#totals').html('Total L: ' + response.totals.totalL + ', Total O: ' + response.totals.totalO + ', Total R: ' + response.totals.totalR);
            }
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

function displayData(data) {
    var resultDiv = $('#result');
    var html = '<table border="1"><tr><th>B</th><th>L</th><th>O</th><th>R</th><th>Total</th></tr>';
    
    // Variables to store totals
    var totalL = 0;
    var totalO = 0;
    var totalR = 0;

    data.forEach(function(row) {
        var bValue = row[0];
        var lValue = row[1];
        var oValue = row[2];
        var rValue = row[3];

        // Calculate the total for the row
        var totalValue = parseFloat(oValue) + parseFloat(rValue);

        // Add the values to the totals
        totalL += parseFloat(lValue);
        totalO += parseFloat(oValue);
        totalR += parseFloat(rValue);

        // Display values in the table
        html += '<tr><td>' + bValue + '</td><td>' + lValue + '</td><td>' + oValue + '</td><td>' + rValue + '</td><td>' + totalValue + '</td></tr>';
    });

    html += '</table>';
    resultDiv.html(html);
}

    </script>

</body>
</html>

 -->



<!-- 
This is the correct reading from all file and total each file data.  -->



 <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Reader</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div>
        <label for="fileInput" multiple>Choose Excel Files:</label>
        <input type="file" id="fileInput" multiple>
        <button onclick="getData()">Get Data</button>
    </div>

    <div id="result"></div>

    <script>
       function getData() {
    var fileInput = document.getElementById('fileInput');
    var files = fileInput.files;

    var formData = new FormData();
    for (var i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }

    $.ajax({
        type: 'POST',
        url: 'read_excel.php',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(responses) {
            responses.forEach(function(response) {
                // Check if 'data' is an array
                if (Array.isArray(response.data)) {
                    displayData(response.data, response.totals, response.filename);
                } else {
                    console.error('Invalid data format:', response.data);
                }
            });
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

function displayData(data, totals, filename) {
    var resultDiv = $('#result');
    var html = '<h2>Table for ' + filename + '</h2><table border="1"><tr><th>B</th><th>L</th><th>O</th><th>R</th><th>Total</th></tr>';
    
    // Variables to store totals
    var totalL = 0;
    var totalO = 0;
    var totalR = 0;

    data.forEach(function(row) {
        var bValue = row[0];
        var lValue = row[1];
        var oValue = row[2];
        var rValue = row[3];

        // Calculate the total for the row
        var totalValue = parseFloat(oValue) + parseFloat(rValue);

        // Add the values to the totals
        totalL += parseFloat(lValue);
        totalO += parseFloat(oValue);
        totalR += parseFloat(rValue);

        // Display values in the table
        html += '<tr><td>' + bValue + '</td><td>' + lValue + '</td><td>' + oValue + '</td><td>' + rValue + '</td><td>' + totalValue + '</td></tr>';
    });

    html += '</table>';
    html += '<p>Total L: ' + totals.totalL + ', Total O: ' + totals.totalO + ', Total R: ' + totals.totalR + '</p>';
    
    resultDiv.append(html);
}

    </script>

</body>
</html> -->




<!-- 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Reader</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div>
        <label for="fileInput" multiple>Choose Excel Files:</label>
        <input type="file" id="fileInput" multiple>
        <button onclick="getData()">Get Data</button>
    </div>

    <div id="result"></div>
    <div id="overallTotals"></div>

    <script>
        var overallTotals = { totalL: 0, totalO: 0, totalR: 0 };

        function getData() {
            var fileInput = document.getElementById('fileInput');
            var files = fileInput.files;

            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            $.ajax({
                type: 'POST',
                url: 'read_excel.php',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(responses) {
                    responses.forEach(function(response) {
                        // Check if 'data' is an array
                        if (Array.isArray(response.data)) {
                            displayData(response.data, response.totals, response.filename);
                            updateOverallTotals(response.totals);
                        } else {
                            console.error('Invalid data format:', response.data);
                        }
                    });

                    displayOverallTotals();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function displayData(data, totals, filename) {
            var resultDiv = $('#result');
            var html = '<h2>Table for ' + filename + '</h2><table border="1"><tr><th>B</th><th>L</th><th>O</th><th>R</th><th>Total</th></tr>';
            
            // Variables to store totals
            var totalL = 0;
            var totalO = 0;
            var totalR = 0;

            data.forEach(function(row) {
                var bValue = row[0];
                var lValue = row[1];
                var oValue = row[2];
                var rValue = row[3];

                // Calculate the total for the row
                var totalValue = parseFloat(oValue) + parseFloat(rValue);

                // Add the values to the totals
                totalL += parseFloat(lValue);
                totalO += parseFloat(oValue);
                totalR += parseFloat(rValue);

                // Display values in the table
                html += '<tr><td>' + bValue + '</td><td>' + lValue + '</td><td>' + oValue + '</td><td>' + rValue + '</td><td>' + totalValue + '</td></tr>';
            });

            html += '</table>';
            html += '<p>Total L: ' + totalL + ', Total O: ' + totalO + ', Total R: ' + totalR + '</p>';
            
            resultDiv.append(html);
        }

        function updateOverallTotals(totals) {
            overallTotals.totalL += totals.totalL;
            overallTotals.totalO += totals.totalO;
            overallTotals.totalR += totals.totalR;
        }

        function displayOverallTotals() {
            var overallTotalsDiv = $('#overallTotals');
            var html = '<h2>Overall Totals</h2>';
            html += '<p>Total L: ' + overallTotals.totalL + ', Total O: ' + overallTotals.totalO + ', Total R: ' + overallTotals.totalR + '</p>';
            
            overallTotalsDiv.html(html);
        }
    </script>

</body>
</html> -->




<!-- 


Mao ni and working complete reading -->



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Reader</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        #loading-bar {
            display: none;
            height: 20px;
            background-color: #ddd;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }

        #progress {
            height: 100%;
            width: 0;
            background-color: #4caf50;
        }
    </style>
</head>
<body>

    <div>
        <label for="fileInput" multiple>Choose Excel Files:</label>
        <input type="file" id="fileInput" multiple>
        <button onclick="getData()">Get Data</button>
    </div>

    <div id="result"></div>
    <div id="overallTotals"></div>

    <div id="loading-bar">
        <div id="progress"></div>
    </div>

    <script>
        var overallTotals = { totalL: 0, totalO: 0, totalR: 0 };

        function getData() {
            var fileInput = document.getElementById('fileInput');
            var files = fileInput.files;

            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            $.ajax({
                type: 'POST',
                url: 'read_excel.php',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    // Show loading bar before the request is sent
                    $('#loading-bar').show();
                },
                success: function(responses) {
                    responses.forEach(function(response) {
                        // Check if 'data' is an array
                        if (Array.isArray(response.data)) {
                            displayData(response.data, response.totals, response.filename);
                            updateOverallTotals(response.totals);
                        } else {
                            console.error('Invalid data format:', response.data);
                        }
                    });

                    displayOverallTotals();
                },
                error: function(error) {
                    console.error('Error:', error);
                },
                complete: function() {
                    // Hide loading bar after the request is complete
                    $('#loading-bar').hide();
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var percent = (e.loaded / e.total) * 100;
                            $('#progress').width(percent + '%');
                        }
                    });
                    return xhr;
                }
            });
        }

        function displayData(data, totals, filename) {
            var resultDiv = $('#result');
            var html = '<h2>Table for ' + filename + '</h2><table border="1"><tr><th>B</th><th>L</th><th>O</th><th>R</th><th>Total</th></tr>';
            
            // Variables to store totals
            var totalL = 0;
            var totalO = 0;
            var totalR = 0;

            data.forEach(function(row) {
                var bValue = row[0];
                var lValue = row[1];
                var oValue = row[2];
                var rValue = row[3];

                // Calculate the total for the row
                var totalValue = parseFloat(oValue) + parseFloat(rValue);

                // Add the values to the totals
                totalL += parseFloat(lValue);
                totalO += parseFloat(oValue);
                totalR += parseFloat(rValue);

                // Display values in the table
                html += '<tr><td>' + bValue + '</td><td>' + lValue + '</td><td>' + oValue + '</td><td>' + rValue + '</td><td>' + totalValue + '</td></tr>';
            });

            html += '</table>';
            html += '<p>Total L: ' + totalL + ', Total O: ' + totalO + ', Total R: ' + totalR + '</p>';
            
            resultDiv.append(html);
        }

        function updateOverallTotals(totals) {
            overallTotals.totalL += totals.totalL;
            overallTotals.totalO += totals.totalO;
            overallTotals.totalR += totals.totalR;
        }

        function displayOverallTotals() {
            var overallTotalsDiv = $('#overallTotals');
            var html = '<h2>Overall Totals</h2>';
            html += '<p>Total L: ' + overallTotals.totalL + ', Total O: ' + overallTotals.totalO + ', Total R: ' + overallTotals.totalR + '</p>';
            
            overallTotalsDiv.html(html);
        }
    </script>

</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Reader</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins',sans-serif;
        }
        .file-input-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .file-input-container label {
            margin-right: 10px;
        }
        .button-container {
            margin-left: 10px;
        }
        .button {
            position: relative;
            height: 30px;
            max-width: 300px;
            width: 100%;
            background: #7d2ae8;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 6px;
        }
        .button.progress::before {
            animation: progress 6s ease-in-out forwards;
        }
        @keyframes progress {
            0% {
                left: -100%;
            }
            10% {
                left: -97%;
            }
            20% {
                left: -92%;
            }
            30% {
                left: -82%;
            }
            30% {
                left: -62%;
            }
            40% {
                left: -38%;
            }
            50% {
                left: -18%;
            }
            60% {
                left: -14%;
            }
            80% {
                left: -7%;
            }
            90% {
                left: -3%;
            }
            100% {
                left: 0%;
            }
        }
        .button .text-icon {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .button .text-icon i,
        .button .text-icon span {
            position: relative;
            color: #fff;
            font-size: 20px;
            margin-left: 8px;
        }
        .button .text-icon span {
            font-size: 16px;
            font-weight: 400;
            margin-left: 8px;
            padding: 30px;
        }
        #result {
            width: 50%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the table */
        }
        #overallTotals {
            width: 50%; /* Adjust the width as needed */
            margin: 20px auto; /* Center the overall totals */
        }
    </style>
</head>
<body>

<div class="file-input-container">
    <label for="fileInput" multiple>Choose Excel Files:</label>
    <input type="file" id="fileInput" multiple>
    <!-- Button with progress bar -->
    <div class="button-container">
        <div class="button" onclick="getData()">
            <div class="text-icon">
                <i class="bx bx-cloud-upload"></i>
                <span class="text">Upload File</span>
            </div>
        </div>
    </div>
</div>

<div id="result"></div>
<div id="overallTotals"></div>

<script>
    var overallTotals = { totalL: 0, totalO: 0, totalR: 0 };
    const button = document.querySelector(".button");

    function simulateButtonClick() {
        button.classList.remove("progress");
        button.querySelector(".text").innerText = "Uploaded";
    }

    function getData() {
        var fileInput = document.getElementById('fileInput');
        var files = fileInput.files;

        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        button.classList.add("progress");
        button.querySelector(".text").innerText = "Uploading...";

        $.ajax({
            type: 'POST',
            url: 'read_excel.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(responses) {
                responses.forEach(function(response) {
                    if (Array.isArray(response.data)) {
                        displayData(response.data, response.totals, response.filename);
                        updateOverallTotals(response.totals);
                    } else {
                        console.error('Invalid data format:', response.data);
                    }
                });
                displayOverallTotals();
            },
            error: function(error) {
                console.error('Error:', error);
            },
            complete: function() {
                setTimeout(() => {
                    button.classList.remove("progress");
                    button.querySelector(".text").innerText = "Upload File";
                    simulateButtonClick();
                }, 6000); // Delay to simulate file processing
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        console.log(percent);
                    }
                });
                return xhr;
            }
        });
    }

    function displayData(data, totals, filename) {
        var resultDiv = $('#result');

        var tableContainer = $('<div class="table-container"></div>');
        var html = '<h2>Table for ' + filename + '</h2>';
        html += '<div class="table-responsive">';
        html += '<table class="table table-striped">';
        html += '<thead class="thead-dark">';
        html += '<tr>';
        html += '<th scope="col">B</th>';
        html += '<th scope="col">L</th>';
        html += '<th scope="col">O</th>';
        html += '<th scope="col">R</th>';
        html += '<th scope="col">Total</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';

        var totalL = 0;
        var totalO = 0;
        var totalR = 0;

        data.forEach(function(row) {
            var bValue = row[0];
            var lValue = row[1];
            var oValue = row[2];
            var rValue = row[3];

            var totalValue = parseFloat(oValue) + parseFloat(rValue);

            totalL += parseFloat(lValue);
            totalO += parseFloat(oValue);
            totalR += parseFloat(rValue);

            html += '<tr>';
            html += '<td>' + bValue + '</td>';
            html += '<td>' + lValue + '</td>';
            html += '<td>' + oValue + '</td>';
            html += '<td>' + rValue + '</td>';
            html += '<td>' + totalValue + '</td>';
            html += '</tr>';
        });

        html += '</tbody>';
        html += '</table>';
        html += '</div>';

        html += '<p>Total L: ' + totalL + ', Total O: ' + totalO + ', Total R: ' + totalR + '</p>';

        tableContainer.html(html);
        resultDiv.append(tableContainer);
    }

    function updateOverallTotals(totals) {
        overallTotals.totalL += totals.totalL;
        overallTotals.totalO += totals.totalO;
        overallTotals.totalR += totals.totalR;
    }

    function displayOverallTotals() {
        var overallTotalsDiv = $('#overallTotals');
        var html = '<h2>Overall Totals</h2>';
        html += '<p>Total L: ' + overallTotals.totalL + ', Total O: ' + overallTotals.totalO + ', Total R: ' + overallTotals.totalR + '</p>';

        overallTotalsDiv.html(html);
    }
</script>

</body>
</html>
