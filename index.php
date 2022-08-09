<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="card col-lg-4 mx-auto mt-5 shadow">
        <div class="card-header bg-dark text-light">
            <h4>Authorization</h4>
        </div>
        <div class="card-body">
            <form action="./controller/oAuthCheck.php" method="POST">
                <input type="text" name="apiKey" class="form-control mb-3" placeholder="Please Input Your API Key">
                <input type="text" name="clientSecret" class="form-control mb-3" placeholder="Please Input your Client Secret">
                <button class="btn btn-dark w-50 d-block m-auto mb-2" name="checkAuth">Authorize</button>
            </form>
        </div>
    </div>

</body>

</html>