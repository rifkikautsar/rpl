<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Restoran iCendol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="h<littps://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"
          integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
          crossorigin="anonymous"></script>
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="f01-home.php">
            <img src="../img/iCendol.png" alt="" width="147" height="35">
        </a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page-koki" href="home-koki.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home-koki.php?page-koki=dmenu">Daftar Menu</a>
                        </li><li class="nav-item">
                            <a class="nav-link" href="home-koki.php?page-koki=form-menu">Form Menu</a>
                        </li><li class="nav-item">
                            <a class="nav-link" href="home-koki.php?page-koki=lpesanan">List Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home-koki.php?page-koki=logout">Logout</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
<hr>
</div>

<script type = "text/JavaScript">
function onNav() {
  var path = window.location.href; //Mengambil data URL dari address bar
  $("nav a").each(function() {
    //Jika URL pada menu ini sesuai dengan path, maka
    if(this.href === path) {
      //Tambahkan kelas "active" pada menu ini
      $(this).addClass("active");
    }
  });
}
</script>

</body>

