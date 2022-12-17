<?php


require_once 'core/init.php';

echo "<div class='maincontainer'>";

include 'includes/header.php';

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
        Redirect::to('dashboard.php');
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

        <form class="" action="" method="post">

          <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
              <div class="mt-3 mb-4">
                <label for="name" class='textchange'>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo escape($user->data()->name); ?>">
              </div>
              <label for="username" class='textchange'>Username</label>
              <input type="text" name="username" class="form-control"
                value="<?php echo escape($user->data()->username); ?>">
              <br>
              <label for="img" class='textchange'>Profile Picture use <a
                  href="https://www.imageupload.net">This</a></label>
              <input type="text" name="img" class="form-control" value="<?php echo escape($user->data()->img); ?>">

              <div class="mb-4 pb-2">
                <br>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" class="btn btn-primary btn-rounded btn-lg" value="Update">


        </form>
      </div>
    </div>
  </div>
</section>