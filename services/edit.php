<?php
  session_start();
  require_once '../classes/autoload.php';
  include_once '../config/config.php';

  $database = new classes\Database();
  if (!isset($_SESSION['account'])){
    echo "You're don't have permission for this page!";
    die();
  } else {
    $account = unserialize($_SESSION['account']);
    if (!$account->isAdmin()) {
        echo "You're don't have permission for this page!";
        die();
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Service</title>

    <!-- Include Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/pages.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </head>
  <body>
  <div class="container py-3">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Dog Grooming Salon</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="../index.php">Home</a>
        <a class="nav-link fw-bold py-1 px-0" href="index.php">Services</a>
        <a class="nav-link fw-bold py-1 px-0 active" href="../contact/">Contact</a>
        <a class="nav-link fw-bold py-1 px-0" href="/login/logout.php">Log Out</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal pt-5">Edit Service</h1>
    </div>
      <form method="POST" id="ajax_form" action="editSubmit.php">
        <div class="form-group">
          <div class="alert alert-danger" style="display: none;" id="error-valid"></div>
          <div class="row mb-3">
            <?php $service = classes\Service::getServiceById((int)$_GET['id'], $database) ?>
            <input type="hidden" value="<?=$_GET['id']?>" name="id">
            <div class="row mb-3">
                <label for="name" class="col-form-label col-sm-2">Service Name:</label>
                <div class="col-sm-4">
                    <input name="name" value="<?=$service->getName()?>" class="form-control border-dark"/>
                </div>
            </div>
            <div class="row mb-3">
              <label for="name" class="col-form-label col-sm-2">Price:</label>
              <div class="col-sm-4">
                  <input name="price" value="<?=$service->getPrice()?>" class="form-control border-dark"/>
              </div>
            </div>
            <div class="row mb-3">
              <label for="name" class="col-form-label col-sm-2">Description:</label>
              <div class="col-sm-10">
                  <input name="description" value="<?=$service->getStringDescription()?>" class="form-control border-dark"/>
              </div>
            </div>
                
          </div>    
        </div>
           <button type="submit" class="btn btn-primary" id="submit">Save</button>
   </form>
    </header>
      <?php
        include "../footer.html";
        ?>
  </div>
  </body>
  <script src="../js/ajax_submit.js"></script>
</html>