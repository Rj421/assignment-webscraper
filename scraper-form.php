<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #loader {
            display: none;
        }
        
        #scrapeForm {
            display: block;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
            <div class="card-header text-center bg-primary text-white">
                <h3 class="mb-0">Web Scraper</h3>
            </div>
            <div class="card-body">
                <form action="scraper.php" method="GET" id="scrapeForm" onsubmit="showLoader()">
                    <div class="form-group mb-4">
                        <label for="url" class="h5">Enter URL:</label>
                        <input type="text" id="url" name="url" class="form-control form-control-lg" placeholder="Enter the URL you want to scrape" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block py-2">Scrape</button>
                </form>
                
                <div id="loader" class="text-center mt-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p>Processing your request, scraping in progress...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
            document.getElementById('scrapeForm').style.display = 'none';
        }


        // window.onload = function() {
        //     setTimeout(function() {
        //         window.location.href = 'product-list.php'; 
        //     }, 5000); 
        // };
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
