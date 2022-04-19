
<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();


if (isset($_GET['id'])&& isset($_GET['cost'])) {
    $id = $_GET['id'];
    $cost = $_GET['cost'];
    $userModel->addBanks($id , $cost);
    header('location: list_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="add_bank.php" method="GET">
        <label for="">Them tien vao TK</label>
        <div class="">
            <input type="text" name="id" value="<?php echo $_GET['id']?>">
        </div>
        <br>
        <div class="">
            <input type="text" name="cost">
        </div>

        <button type="submit">UP COST</button>
    </form>
</body>

</html>