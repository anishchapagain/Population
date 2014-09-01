<?php 
include 'includes/header.php'; 
include 'main.php'; 
$error_message='';
?>

<?php //form submission and routing
if(empty($_POST['username']) && empty($_POST['password']))
{
    $error_message='Please enter username and password';
}
if(isset($_POST['username']) && $_POST['username'] != '')
{
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $result=$db->checkUser($username,$password);
    if($result){
        session_start();
        $_SESSION['user']=$username;
        header('Location: home.php');
    }
}
?>

<fieldset>
    <legend> Admin Login </legend>
    <br />
    <p style="color:red;"><?php echo $error_message; ?></p>
    <form name="frmadmin" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" /> <br />
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" /> <br />
        <input type="submit" value="Login" />       
    </form>   
</fieldset>

<?php include 'includes/footer.php'; ?>