<?php

// Core Initialization
require_once 'core/init.php';

echo "<div class='maincontainer'>";

// Header
include 'includes/header.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Moogul</title>
</head>

<body id="body-pd">

    <body onload="myFunction()">


        <div class="thread">
            <button type="button" class="btn btn-primary btn-create">Create Thread</button>
        </div>

        <div class="container-fluid mt-100">
            <div class="row">
                <div class="col-md-12" style="margin-top: 50px;">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="media flex-wrap w-100 align-items-center"> <img src="assets/img/perfil.jpg" class="d-block ui-w-40 rounded-circle" alt="" style="width: 80px;">
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" data-abc="true">Name of poster</a>
                                    <p class="text-center title-thread">Title</p>
                                    <div class="text-muted small">N#of days of post</div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div>Member since <strong>Date</strong></div>
                                    <div><strong>N#posts</strong> posts</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                            <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">N#likes</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">N#Views</span> </span> </div>
                            <div class="px-4 pt-3">


                                <form method="post" action="">

                                    <input type="submit" class="btn btn-primary" name="Submit" value="Add comment" />
                                </form>

                            </div>

                        </div>
                        <?php

$array = GetReplies(1);

// for($i =0; $i<=count($array); $i++ ) {
//     echo $array[$i];
// }

foreach ($array as $key => $value) {
    echo $value;
   }


                        if (isset($_POST['replybtn'])) {
                            //echo '<label>' . $_POST['newReply'] .  '</label>';

                            CreateReply( 1, 13, $_POST['newReply']);
                        }

                        ?>
                    </div>

                    <?php
                    if (isset($_POST['Submit'])) {

                        echo '
                                  <form method="get" action=""> 
                                    
                                    </form>


                                  <form method="post" action="">
                                  <textarea class ="replycom" name="newReply"> </textarea>
                                     <input type="submit" class="btn btn-kodq" name="replybtn" value="Submit"/>
                                     </form>';
                    }

                    ?>






                </div>
            </div>
        </div>



        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>



        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>

        <?php

        

        function CreateReply($postID, $userID, $msg)
        {
            $db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416', 'dbi433416', '123');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'INSERT INTO reply (postid, userid, msg) VALUES (:pid, :uid, :msg)';
            $values = array(':pid' => $postID, ':uid' => $userID, ':msg' => $msg);

            try {
                $res = $db->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                throw new Exception('Database query error' . $e->getMessage());
            }
        }

        function GetReplies($postID)
        {
            $db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416', 'dbi433416', '123');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'Select msg FROM reply WHERE postid = :pid';
            $values = array(':pid' => $postID);

            try {
                $res = $db->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                throw new Exception('Database query error' . $e->getMessage());
            }

            

            return $res->fetch(PDO::FETCH_ASSOC);
            //
        }

        //         public function createUser(string $name, string $pass, string $fname, string $lname, string $email)
        // {
        // 	global $conn;

        // 	$query = 'INSERT INTO user (username, password, first_name, last_name, email, memberType) VALUES (:nam, :pass, :fnam, :lnam, :email, :memberType)';
        // 	$values = array(':nam' => $name, ':pass' => $pass, ':fnam' => $fname, ':lnam' => $lname, ':email' => $email, ':memberType' => 'Member');

        // 	try {
        // 		$res = $conn->prepare($query);
        // 		$res->execute($values);
        // 	} catch (PDOException $e) {
        // 		throw new Exception('Database query error'.$e->getMessage());
        // 	}
        // }




        ?>


    </body>

</html>