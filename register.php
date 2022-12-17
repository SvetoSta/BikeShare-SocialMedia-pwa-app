<?php

require_once 'core/init.php';


  if (Input::exists()) {
    if (Token::check(Input::get('token'))) {

          $user = new User();
          try {

            $salt = Hash::salt(32);

            $user->create(array(
              'username' => Input::get('username'),
              'email' => Input::get('email'),
              'password' => Hash::make(Input::get('password'), $salt),
              'salt' => $salt,
              'name' => Input::get('name'),
              'joined' => date('Y-m-d'),
              'permission' => 1,
              'img' => 'https://i.ibb.co/DtJhvps/360-F-346839683-6n-APzbhp-Sk-Ipb8pm-Awufk-C7c5e-D7w-Yws.jpg',
              'points' => 0,
              'lastkm' => 0,
              'totalkm' => 0
            ));

            Session::flash('home', 'You have been registered and can now log in!');
            Redirect::to('login.php');

          } catch (Exception $e) {
            die($e->getMessage());
          }

      }
    }

include_once 'includes/header.php';

  ?>


<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              <p class="text-white-50 mb-5">Please enter your credentials!</p>
              <form class="" action="register.php" method="post" onsubmit="return validation()">

                <div class="form-outline form-white mb-4">
                  <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name"
                    autocomplete="off" class="form-control form-control-lg" />
                  <label for="name" class="form-label">Name</label>
                  <div id="name_error"></div>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="text" name="email" value="<?php echo escape(Input::get('email')); ?>" id="emails"
                    autocomplete="off" class="form-control form-control-lg" />
                  <label for="email" class="form-label">Email</label>
                  <span class="danger" id="emailids"> </span>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="text" name="username" alue="<?php echo escape(Input::get('username')); ?>" id="user"
                    autocomplete="off" class="form-control form-control-lg" />
                  <label for="username" class="form-label">Username</label>
                  <span class="danger" id="usernames"> </span>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" class="form-control form-control-lg" name="password" value="" id="pass"
                    autocomplete="off" />
                  <label for="password" class="form-label">Password</label>
                  <span class="danger" id="passwords"> </span>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" class="form-control form-control-lg" name="password_again" value=""
                    id="conpass" autocomplete="off" />
                  <label for="password_again" class="form-label">Confirm Password</label>
                  <span class="danger" id="confrmpass"> </span>
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Register" name="register">

                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                  <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                </div>

            </div>

            <div>
              <p class="mb-0">If you already have an account you can <a href="login.php" class="text-white-50 fw-bold">Log In</a>
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

    var user = document.getElementById('user').value;
    var emails = document.getElementById('emails').value;
    var pass = document.getElementById('pass').value;
    var confirmpass = document.getElementById('conpass').value;

    document.getElementById('usernames').innerHTML = "";
    document.getElementById('passwords').innerHTML = "";
    document.getElementById('confrmpass').innerHTML = "";
    document.getElementById('emailids').innerHTML = "";

    if (user == "") {
      document.getElementById('usernames').innerHTML = " ** Please fill the username field";
      return false;
    }
    if ((user.length <= 2) || (user.length > 20)) {
      document.getElementById('usernames').innerHTML = " ** Username lenght must be between 2 and 20";
      return false;
    }
    if (!isNaN(user)) {
      document.getElementById('usernames').innerHTML = " ** only characters are allowed";
      return false;
    }
    if (pass == "") {
      document.getElementById('passwords').innerHTML = " ** Please fill the password field";
      return false;
    }
    if ((pass.length <= 5) || (pass.length > 20)) {
      document.getElementById('passwords').innerHTML = " ** Passwords lenght must be between  5 and 20";
      return false;
    }

    if (pass != confirmpass) {
      document.getElementById('confrmpass').innerHTML = " ** Password does not match the confirm password";
      return false;
    }



    if (confirmpass == "") {
      document.getElementById('confrmpass').innerHTML = " ** Please fill the confirmpassword field";
      return false;
    }

    if (emails == "") {
      document.getElementById('emailids').innerHTML = " ** Please fill the email idx` field";
      return false;
    }
    if (emails.indexOf('@') <= 0) {
      document.getElementById('emailids').innerHTML = " ** @ Invalid Position";
      return false;
    }

    if ((emails.charAt(emails.length - 4) != '.') && (emails.charAt(emails.length - 3) != '.')) {
      document.getElementById('emailids').innerHTML = " ** . Invalid Position";
      return false;
    }


  }
</script>

<?php 
include_once 'includes/footer.php';
?>