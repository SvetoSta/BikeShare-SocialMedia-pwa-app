<?php

echo "<div class='maincontainer'>";
require_once 'core/init.php';

include_once 'includes/header.php';

if (Session::exists('home')) {
  echo '<p>' . Session::flash('home') .  '</p>';
}

$user = new User();

if ($user->isLoggedIn()) {
} else {
  Redirect::to('login.php');
}

?>
<br>
<div class="jumbotron">
    <div><img src="<?php echo escape($user->data()->img); ?>" alt=""
          style="width: 150px; height: 130px; border-radius: 50px;">
  <h1 class="">Hello, <?php echo escape($user->data()->name)?>!👋</h1></div>
  <p class="lead" ></p>
  <h1 id="temperature"></h1>
    <h2 id="description"></h2>
    <p id="location" style="display:none;"></p>
  <section>
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-8 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-info"><?php echo escape($user->data()->totalkm)?>km</h3>
                <p class="mb-0">Total distance travelled</p>
              </div>
              <div class="align-self-center">
                <i class="fa-sharp fa-solid fa-bicycle text-info fa-3x"></i>
              </div>
            </div>
            <div class="px-md-1">
              <div class="progress mt-3 mb-1 rounded" style="height: 7px;">
                <div class="progress-bar bg-info" role="progressbar" style="width: 80%;" aria-valuenow="80"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-8 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-warning"><?php echo escape($user->data()->points)?></h3>
                <p class="mb-0">Points</p>
              </div>
              <div class="align-self-center">
                <i class=" text-warning fa-3x"></i>
              </div>
            </div>
            <div class="px-md-1">
              <div class="progress mt-3 mb-1 rounded" style="height: 7px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 35%;" aria-valuenow="35"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-8 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-success"><?php echo escape($user->data()->lastkm)?>km</h3>
                <p class="mb-0"> last ride </p>
              </div>
              <div class="align-self-center">
                <i class="fa-sharp fa-solid fa-tree text-success fa-3x"></i>
              </div>
            </div>
            <div class="px-md-1">
              <div class="progress mt-3 mb-1 rounded" style="height: 7px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      
      </div>
      <p class="lead">
    <a class="btn btn-warning btn-lg" href="map.php" role="button">Star ride</a>
  </p>
    </div>
  </section>
  
</div>
    

<?php 
include_once 'includes/footer.php';
?>