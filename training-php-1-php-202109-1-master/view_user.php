<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userModel->findUserById($id);//Update existing user
   
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

        <?php if ($user || empty($id)) { ?>
            <div class="alert alert-warning" role="alert">
                User profile
            </div>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                    <label for="name">Username</label>
                    <span><?php if (!empty($user[0]['username'])) echo $user[0]['username'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Firstname</label>
                    <span><?php if (!empty($user[0]['first_name'])) echo $user[0]['first_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Lastname</label>
                    <span><?php if (!empty($user[0]['last_name'])) echo $user[0]['last_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Bank Id</label>
                    <span><?php if (!empty($user[0]['bank_id'])) echo $user[0]['bank_id'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Phone</label>
                    <span><?php if (!empty($user[0]['phone'])) echo $user[0]['phone'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Sex</label>
                    <span><?php if (!empty($user[0]['sex'])) {
                                if ($user[0]['sex'] == '0') {
                                    echo "Male";
                                } else {
                                    echo "Female";
                                }
                            }
                            ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Email</label>
                    <span><?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Type</label>
                    <span><?php if (!empty($user[0]['type'])) echo $user[0]['type'] ?></span>
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>

</html>