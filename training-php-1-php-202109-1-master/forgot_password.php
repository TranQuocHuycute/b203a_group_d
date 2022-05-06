<?php
// Start the session
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();



if (!empty($_POST['submit'])) {
    $email = $_POST['email'];
    $secrect_question = $_POST['secrect_question'];
    $answer = $_POST['answer'];
    $password = $_POST['password'];

    $forgot = $userModel->ForgotPassword($email, $secrect_question, $answer, $password);
    if ($forgot) {
        //Login successful
        $_SESSION['message'] = 'Update Password successful';
    } else {
        //Login failed
        $_SESSION['message'] = 'Update Password Failed';
    }
}
// get question
$question = $userModel->getQuestion();

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
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Forgot Password</div>
                </div>

                <div style="padding-top:30px" class="panel-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Secrect Question</label>
                            <div class="col-sm-10">
                                <?php
                                foreach ($question as $value) { ?>
                                    <div class="form-check">
                                        <input class="form-check-input" value="<?php echo $value['id'] ?>" type="radio" name="secrect_question" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?php echo $value['question'] ?>
                                        </label>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Answer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="answer" id="answer">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Re - Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>