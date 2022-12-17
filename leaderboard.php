<?php 
require_once 'core/init.php';
include_once 'includes/header.php';

$data = $user->data();

$db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416','dbi433416','123');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->query("SELECT * FROM userss ORDER BY points DESC");

echo"

<link rel='stylesheet' href='css/styles.css'>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

</div>";
if ($user->isLoggedIn()) {

 
    while ($row = $stmt->fetch()){?>
    <form action="" method="POST">
    <?php
      echo "
      <table class='table' style='color: white;'>
  <thead>
    <tr>
      <th scope='col'>Username</th>
      <th scope='col'>Points</th>
    </tr>

    </thead>
    <tbody>";
      echo "
        <tr>
        <td style='width: 200px;'>";
          echo $row['username'];
          echo " </td>
        <td style='width: 200px;'>";
         echo $row['points'];
         echo "
        </td>";
        echo "</tr>
        </tbody>
        </table>";
    }

}else{
  echo "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a></p>";
}

?>
<?php 
include_once 'includes/footer.php';
?>