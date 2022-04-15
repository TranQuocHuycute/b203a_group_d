<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userModel->findUserById($id); //Update existing user
}


if (!empty($_POST['submit'])) {

    if (!empty($id)) {
        $userModel->updateUser($_POST);
    } else {
        $userModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <div class="alert alert-warning" role="alert">
            User profile
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="./public/images/avata.jpg" alt="" class="img-fluid">
            </div>
            <div class="col-md-9">
                <?php if ($user || empty($id)) { ?>
                    <ul class="list-group">
                        <?php
                            foreach ($user[0] as $key => $value) { 
                                if ($key != 'password') {?>
                                    <li class="list-group-item"><?php echo $key . ': ' . $value; ?></li>
                                <?php }
                            }
                        ?>
                    </ul>
                <?php } else { ?>
                    <div class="alert alert-success" role="alert">
                        User not found!
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</body>

</html>