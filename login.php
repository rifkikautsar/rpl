<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../../navbar.php"); ?>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Login iCendol</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <!-- A card with given width -->
    <div class="col d-flex justify-content-center">
        <div class="card text-dark bg-light mt-5 mb-5" style="max-width: 330px;  ">
            <div class="card-header" style="text-align: center;">Login</div>
            <div class="cards-body">
                <!--Field Username-->
                <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control" id="uname" placeholder="Masukkan username" name="uname"
                        required>
                </div>
            </div>
            <!--Field Password-->
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Masukkan password" name="pswd"
                    required>
            </div>
            <div class="form-group form-check" style="text-align: center;">
                <label class="form-check-label">
                    <div class="checkbox mb-3">
                        <label> <input type="checkbox" value="remember-me" /> Remember me </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-outline-dark" type="submit">Masuk</button>
            </div>
        </div>
    </div>
    </div>
    <div>
        </form>

        <?php include("../../footer.php"); ?>
