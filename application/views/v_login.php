<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <title>Internet Of Things | Login</title>
   <link rel='icon' href="<?= base_url('assets/img/unpamm.png') ?>" type="image/gif">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://code.jquery.com/jquery-3.3.1.slim.min.js">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
   <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css') ?>">
   <style>
      :root {
         --gradient: linear-gradient(to right, #EBECEE, #DBE0E7, #26B49A);

      }

      body {
         min-height: 100vh;
         background-color: #eaeaea;
         background-image: var(--gradient);
         background-size: 200%;
         background-position: right;
         animation: animateGradient 20s infinite alternate;
      }

      @keyframes animateGradient {
         0% {
            background-position: left
         }

         50% {
            background-position: right
         }

         100% {
            background-position: left
         }
      }
   </style>
</head>

<body>
   <div class="container-fluid">
      <div class="row no-gutter">
         <div class="col-md-6 d-none d-md-flex bg-image"></div>
         <div class="col-md-6">
            <div class="login d-flex align-items-center py-5">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-10 col-xl-7 mx-auto">
                        <h3 class="display-4">
                           <span class="text-muted">Internet Of Things</span>
                        </h3>
                        <small>Sistem Monitoring Dan Kontroling Suhu Dan Kelembaban Ruangan</small>
                        <?= form_open('login/proses', ['onsubmit' => 'loginbtn.disabled = true; return true;']) ?>
                        <div class="form-group mb-3 mt-5">
                           <input type="text" placeholder="Username" name="username" autofocus class="form-control rounded-pill border-0 shadow-sm px-4 
                           <?= $this->uri->uri_string() == 'login?alert=belum_login' || $this->uri->uri_string() == '' ? '' : 'is-invalid' ?>" required>
                        </div>
                        <div class=" form-group mb-3">
                           <input type="password" placeholder="Password" id="myinput" name="password" class="form-control rounded-pill border-0 shadow-sm px-4 
                           <?= $this->uri->uri_string() == 'login?alert=gagal' || $this->uri->uri_string() == 'login?alert=belum_login' || $this->uri->uri_string() == '' ? '' : 'is-invalid' ?>" required>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                           <input id="show" type="checkbox" class="custom-control-input">
                           <label for="show" class="custom-control-label text-muted">Show password</label>
                        </div>
                        <button type="submit" id="loginbtn" class="btn btn-info btn-block text-uppercase mb-2 rounded-pill shadow-sm">Login</button>
                        <div class="text-center d-flex justify-content-between mt-4">
                           <p class="text-muted">Created by <a href="#" class="font-italic text-muted" rel="noopener">
                                 <u>Seful Sidik 181011401372</u></a></p>
                        </div>
                        <?= form_close() ?>
                        <?php
                        if (isset($_GET['alert'])) {
                           if ($_GET['alert'] == "gagal") {
                              echo "<div class='alert alert-warning font-weight-bold text-center text-warning'><i class='icon fas fa-exclamation-triangle'></i> Login failed!</div>";
                           } else if ($_GET['alert'] == "belum_login") {
                              echo "<div class='alert alert-danger font-weight-bold text-center text-danger'><i class='icon fas fa-ban'></i> Please login first !</div>";
                           } else if ($_GET['alert'] == "logout") {
                              echo "<div class='alert alert-success font-weight-bold text-center text-success'><i class='icon fas fa-bell'></i> You Are Log Out!</div>";
                           }
                        }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
      const password = document.getElementById("myinput");
      const togglePassword = document.getElementById("show");
      togglePassword.addEventListener("click", toggleClicked);

      function toggleClicked() {
         if (this.checked) {
            password.type = "text";
         } else {
            password.type = "password";
         }
      }
   </script>
</body>

</html>