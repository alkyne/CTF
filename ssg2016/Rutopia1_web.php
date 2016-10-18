<?php include("5f0c2baaa2c0426eed9a958e3fe0ff94.php"); // nothing here ?>
<?php include("flag.php"); // $flag = "???????????????????"; ?>
<?php
?>
<?php
function err($msg){
  echo "<script>alert('{$msg}');history.go(-1);</script>";
  exit();
}
$page = $_GET['page'];
if($page == "login"){
?>
    <h3>Login</h3>
    <p>
      <form action="./?page=login_chk" method="POST">
      <table>
      <tr><td>ID</td><td><input type="text" name="uid" id="uid"></td>
      <td rowspan="3"><img src="./images/login.jpg" width="270" style="margin-left: 20px; margin-top: -38px; position:fixed;"></td></tr>
      <tr><td>PW</td><td colspan="2"><input type="text" name="upw" id="upw"></td></tr>
      <tr><td colspan="2"><input type="submit" value="Login" style="width: 100%;"></td></tr>
	  <tr><td colspan="2"><input type="button" value="Join" style="width: 100%;" onClick="location.href='./?page=join'"></td></tr>
      </table>
      </form>
    </p>
<?php }

else if($page == "join"){
    ?>
    <h3>Join</h3>
    <p>
      <form action="./?page=join_chk" method="POST">
      <table>
      <tr><td>ID</td><td><input type="text" name="uid" id="uid"></td>
      <td rowspan="3"><img src="./images/login.jpg" width="270" style="margin-left: 20px; margin-top: -38px; position:fixed;"></td></tr>
      <tr><td>PW</td><td colspan="2"><input type="text" name="upw" id="upw"></td></tr>
      <tr><td colspan="2"><input type="submit" value="Join" style="width: 100%;"></td></tr>
      </table>
      </form>
    </p>
<?php }


else if($page == "join_chk"){
  if(($_POST['uid']) && ($_POST['upw'])){

    include "dbconn.php";
    
    $uid = addslashes($_POST['uid']);
    $upw = md5($_POST['upw']);

    if(strlen($_POST['uid']) < 3) exit("id too short");
    if(strlen($_POST['uid']) > 256) exit("id too long");
    if(preg_match("/^[a-zA-Z0-9`]/",$uid)) err("No Alp, Num, Backquote. I love emoticon!!");

    dbconnect();

    $r = mysql_fetch_array(mysql_query("select id from member where id='{$uid}'"));
    if($r['id']) exit("id existed");
    mysql_query("insert into member values('{$uid}','{$upw}')");
    echo "<script>location.href='./';</script>";
  }
    else echo "<script>history.go(-1);</script>";
}

else if($page == "login_chk"){
  if(($_POST['uid']) && ($_POST['upw'])){

    include "dbconn.php";
    
    $uid = addslashes($_POST['uid']);
    $upw = md5($_POST['upw']);

    if(preg_match("/^[a-zA-Z0-9`]/",$uid)) err("No Alp, Num, Backquote. I love emoticon!!");

    dbconnect();

    $r = mysql_fetch_array(mysql_query("select id from member where id='{$uid}' and pw='{$upw}'"));
    if($r['id']){
      $_SESSION['uid'] = $r['id'];
      exit("<script>location.href='./';</script>");
    }
    else echo "login fail";
  }
  else echo "<script>history.go(-1);</script>";
}

else if($page == "logout"){
  session_destroy();
  exit("<script>location.href='./';</script>");
}

else if($page == "list"){
  echo "<h3>List</h3>";
  if ($handle = opendir("/tmp/")) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && substr($file,0,5) != "sess_") {
        echo "<a href=./?page=read&no={$file}>{$file}</a><br>";
      }
    }
    closedir($handle);
  }
}

else if($page == "read"){
  if(preg_match("/\.\.|\//",$_GET['no'])) exit("No Hack bitch.");
  echo "<h3>Read</h3>";
  include "/tmp/".$_GET['no'];
}

else if($page == "photo"){ ?>
    <h3>Photo</h3>
    <p><img src="./images/1.jpg" width="430"></p>
    <p><img src="./images/2.jpg" width="430"></p>
    <p><img src="./images/3.png" width="430"></p>
    <p><img src="./images/4.gif" width="430"></p>
<?php } else if($page == "video"){ ?>
    <h3>Music Video</h3>
    <p><iframe width="520" height="293" src="//www.youtube.com/embed/4j7Umwfx60Q?rel=0" frameborder="0" allowfullscreen></iframe></p>
    <p><iframe width="520" height="293" src="//www.youtube.com/embed/iv-8-EgPEY0?rel=0" frameborder="0" allowfullscreen></iframe></p>
    <p><iframe width="520" height="293" src="//www.youtube.com/embed/xnku4o3tRB4?rel=0" frameborder="0" allowfullscreen></iframe></p>
    <p><iframe width="520" height="293" src="//www.youtube.com/embed/n8I8QGFA1oM?rel=0" frameborder="0" allowfullscreen></iframe></p>
<?php } else{ ?>
    <h3>ㅋrystal :/</h3>
    <?php if($_SESSION['uid']) echo "hi {$_SESSION[uid]}"; ?>
    <p><img src="./images/k_03.jpg" width="430" style="position:fixed;"></p>
<?php } ?>
<?php include("4bbc327f5b0fd076e005961bcfc4a9ee.php"); // footer ?>
