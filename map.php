<?php

echo "<div class='maincontainer'>";
require_once 'core/init.php';

include_once 'includes/header.php';

// if (Session::exists('home')) {
//   echo '<p>' . Session::flash('home') .  '</p>';
// }

$user = new User();


if ($user->isLoggedIn()) {
} else {
  Redirect::to('login.php');
}


if(isset($_POST['end'])){
  $user->update(array(
    'points' => Input::get('pointsadd'),
    'lastkm' => Input::get('lastkm'),
    'totalkm' => Input::get('totalkmadd')
  ));
  Session::flash('home');
  Redirect::to('map.php');
}


?>
<form class="searchfield" action="map.php" method="post">
<div class="d-flex justify-content-center">
<div id="map"></div>
</div>

<div class="d-flex justify-content-center">
<div name="points" style="color: white;">
<h1 id="distance"></h1>

</div>
</div>

<div class="d-flex justify-content-center">
<input type="hidden" id="points" name="points" value="<?php echo escape($user->data()->points); ?>">
<input type="hidden" id="pointsadd" name="pointsadd" value="">
<input type="hidden" id="lastkm" name="lastkm" value="">
<input type="hidden" id="totalkm" name="totalkm" value="<?php echo escape($user->data()->totalkm); ?>">
<input type="hidden" id="totalkmadd" name="totalkmadd" value="">
<input type="submit" name="end" class="btn btn-success left" value="End Ride" onclick="persistentNotification(<?php echo escape($user->data()->points)?>)">
</div>
</form>
<div>
<label class="switch" id="wake-lock" style="text-align: fixed;">
            <input type="checkbox" onclick="persistentNotification2()">
            <span class="slider round"></span> 
            <label>Activate Wake Lock function</label>
          </label>
</div>

<?php 
include_once 'includes/footer.php';
?>