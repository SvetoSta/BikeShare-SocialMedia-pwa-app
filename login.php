<?php

// Core Initialization
require_once 'core/init.php';

include_once 'includes/header.php';

if (Input::exists()) {
  //echo "teste";
  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('required' => true),
      'password' => array('required' => true)
    ));
    if($validation->passed()) {
      //echo "Passou!";
      $user = new User();
      $remember = (Input::get('remember') === 'on') ? true : false;
      $login = $user->login(Input::get('username'), Input::get('password'), $remember);
      if ($login) {
        Redirect::to('dashboard.php');
      } else {
        echo "<p class='label label-danger'>Sorry, logging in failed.</p><br><br>";
      }

    } else {
      foreach($validation->errors() as $error) {
        echo $error, '<br>';
      }
    }

  }
}
?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>
              <form class="" action="login.php" method="post" onsubmit="return validation()">
              <div class="form-outline form-white mb-4">
                <input type="text" name="username" id="username" autocomplete="off"
                  class="form-control form-control-lg" />
                <label for="username" class="form-label">Username</label>
                <span class="danger" id="usernames"> </span>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" class="form-control form-control-lg" name="password" id="password"
                  autocomplete="off" />
                <label for="password" class="form-label">Password</label>
                <span class="danger" id="passwords"> </span>
              </div>

              <div class="field form-group">
                <label for="remember" style="color: white;">
                  <input type="checkbox" name="remember" id="remember"> Remember me
                </label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
              <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Log in">

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  function validation() {

    var user = document.getElementById('username').value;
    var pass = document.getElementById('password').value;

    document.getElementById('usernames').innerHTML = "";
    document.getElementById('passwords').innerHTML = "";

    if (user == "") {
      document.getElementById('usernames').innerHTML = "Please fill the username field";
      return false;
    }

    if (pass == "") {
      document.getElementById('passwords').innerHTML = "Please fill the password field";
      return false;
    }

  }
</script>

<?php 
include_once 'includes/footer.php';
?>