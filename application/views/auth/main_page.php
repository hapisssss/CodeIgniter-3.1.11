<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

 if(!$this->session->has_userdata('password')) {
     //redirect('auth'); 
     echo 'goblok';
 }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Main Page</title>
  </head>
  <body >


    <h1 class="text-center">Welcome <?= $this->session->userdata('username'); ?> To My Rest API</h1>


    <div class="container ">
    <h4>your key to access API</h4>
    <br>
    <h6>X-API-KEY : <?= $this->session->userdata('password'); ?></h6>
    <br>
    <br>


    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">GET</th>
      <th scope="col">Params</th>
      <th scope="col">Describe</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td>id</td>
      <td>To retrieve student data based on ID</td>
     
    </tr>
    <tr>
      <th scope="row"></th>
      <td>nrp</td>
      <td>To retrieve student data based on NRP</td>
    </tr>
  </tbody>
</table>

      <div class="container">
        <div class="text-end">
            <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  </body>
</html>
