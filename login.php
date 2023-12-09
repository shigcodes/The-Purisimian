<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <title>The Purishmian | Login</title>
</head>

<body class="">
    <div class="alert alert-danger text-center mt-3">
    </div>

    <form class="frm-login card container d-flex align-items-center p-4" id="frmLogin">
        <center>
            <img src="assets/logo.png" class="logo-in-form" alt="logo">
            <h5>Admin Login</h5>
        </center>
        <div>
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="." class="form-control" required />
                <div class="invalid-feedback">
                    Please enter username.
                </div>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="." class="form-control" required />
                <div class="invalid-feedback">
                    Please enter username.
                </div>
            </div>
            <div class="container mt-4">
                <a href="index.html" class="btn btn-dark">Back To Home</a>
                <button type="submit" class="btn btnSubmitForm">Login</button>
            </div>
        </div>
    </form>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="javascript/login.js"></script>
</body>

</html>