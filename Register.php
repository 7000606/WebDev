<?php include "template.php";
/** @var $conn */
?>
<title>User Registration</title>
<h1 class='text-primary'>User Registration</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-6">
                <h2>Account Details</h2>
                <p>Please enter wanted username and password:</p>
                <p>Email Address<input type="text" name="username" class="form-control" required="required"></p>
                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
            <div class="col-md-6">
                <h2>More Details</h2>
                <!--Product List-->
                <p>Please enter More Personal Details:</p>
                <p>Name<input type="text" name="name" class="form-control" required="required"></p>
                <p>Name<input type="text" name="name" class="form-control" required="required"></p>
                <p>Name<input type="text" name="name" class="form-control" required="required"></p>
                <p>Name<input type="text" name="name" class="form-control" required="required"></p>
            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>



<?php
// Back end
IF ($_SERVER["REQUEST_METHOD"]== "POST") { // Will return true when the user presses the submit button
    $username = sanitise_Data($_POST[username]);
    $username = sanitise_Data($_POST[username]);
    $name = sanitise_data($_POST['NAME']);


    $query = $conn->query("SELECT COUNT(*) FROM Custumers WHERE EmailAddress+'$username'");
    $data = $query->fetchArray();
    $numberOfUsers = (int)$data[0];
    if ($numberOfUsers >0) { // username already exist
        echo "sorry, the username already exist";
}else{
    // the username entered is unique (doesn't already exist)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sqlStmt = $conn->prepare("INSERT INTO Customers (EmailAddress, HashedPassword, FirstName) VALUES (:EmailAddress, :HashedPassword, :FirstName)");
$sqlStmt->bindParam(':EmailAddress', $username);
$sqlStmt->bindParam(':HashedPassword', $hashedPassword);
$sqlStmt->bindParam(':FirstName', $name);
$sqlStmt->execute();
}
?>
