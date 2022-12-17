<?php

require_once 'core/init.php';

include_once 'includes/header.php';

if (!$username = Input::get('user')) {
  Redirect::to('dashboard.php');
} else {
  $user = new User($username);
  if (!$user->exists()) {
    Redirect::to(404);
  } else {
    $data = $user->data(); // user exists
  }
  
}

  $user = new User();

if(!$user->isLoggedIn()) {
  Redirect::to('dashboard.php');
}

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'name' => array(
        'required' => true,
        'min' => 2,
        'max' => 50
      )
    ));
    if($validation->passed()) {
      try {
        $user->update(array(
          'name' => Input::get('name'),
          'username' => Input::get('username'),
          'img' => Input::get('img')
        ));
        Session::flash('home', 'Your details have been updated.');
        Redirect::to('profile.php');
      } catch (Exception $e) {
        die($e->getMessage());
      }

    } else {
      foreach($validation->errors() as $error) {
        echo $error, '<br>';
      }
    }
  }
}
  ?>
  
<section class="vh-100" style="background-color: #2C2E35;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-4">

        <div class="card" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="<?php echo escape($data->img); ?>"
                class="rounded-circle img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2"><?php echo escape($data->name); ?> </h4>
            <p class="text-muted mb-4"><?php echo escape($data->username); ?> <span class="mx-2">|</span> <a
                href="#!"><?php echo escape($data->email); ?> </a></p>

            <a href="update.php"><button class="btn btn-primary btn-rounded btn-lg">Update Profile Info</button></a>
            <br>
            <br>
            <a href="changepassword.php"><button class="btn btn-primary btn-rounded btn-lg">Change Password</button></a>
            <a href="logout.php"><button class="btn btn-primary btn-rounded btn-lg">Logout</button></a>
            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5"><?php echo escape($data->points); ?></p>
                <p class="text-muted mb-0">Points</p>
              </div>
              <div class="px-3">
                <p class="mb-2 h5"><?php echo escape($data->lastkm); ?></p>
                <p class="text-muted mb-0">Last KM</p>
              </div>
              <div>
                <p class="mb-2 h5"><?php echo escape($data->totalkm); ?></p>
                <p class="text-muted mb-0">Total KM</p>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <?php 
include_once 'includes/footer.php';
?>