<?php
session_start();
include'db.inc.php';
$_db=mysql_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD)or
die('Unable to connect.Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

//filter incoming values
$username=(isset($_POST['username'])) ?trim($_POST[username']) : '';
$password=(isset($_POST['password'])) ?$_POST('password'] : '';
 $redirect=(isset($_REQUEST['redirect'])) ?$_REQUEST['redirect']:
    'main.php';
     
    if(isset($_POST['submit'])) {
    $query= 'SELECT username FROM site_user WHERE' .
    'username="' . mysql_real_escape_string($username, $db).' " AND'
    'password =PASSWORD("' . mysql_real_escape_string($password,$db) . ' ")' ;
    $result=mysql_query($query,$db) or die(mysql_error($db));
    if (mysql_num_rows($result) > 0)
    {
    $_SESSION['$username']= $username;
    $_SESSION['logged']=1;
    header('Refresh: 5; URL=' . $redirect);
    echo'<p>You will be redirected to your original page request.</p>' :
    echo'<p>If your browser doesn\'t redirect you properly
      automatically, ' .
'<a href="'. $redirect . '">click here</a>.</p>' ;
    die();
}else{
    $error='<p><strong>You have supplied an invalid username and/or' . 'password!</strong>'Please <a href="register.php">click here ' .
    'to register</a> If you have not done so already.</p>' ;
    }
      }
        ?>
        <html>
        <head>
        <title>Login</title>
        </head>
        <body>
        <?php
        if(isset($error)){
        echo $error;
        }
        ?>
        <form action="loginn.php" method="post">
        <table>
        <tr>
        <td>Username:</td>
        <td><input type="text" name="username" maxlength="20" size="20"
        value="<?php echo $username;?>"/></td>
    </tr><tr>
    <td>Password:</td>
    <td><input type="password" name="password" maxlength="20" size="20"
        value="<?php echo $password;?>"/></td>
    </tr><tr>
    <td> </td>
    <input type="hidden" name="redirect" value="<?php echo $redirect ?>"/>
        <input type="submit" name="submit" value="Login"/>
        </tr>
    </table>
    </form>
    </body>
    </html>
