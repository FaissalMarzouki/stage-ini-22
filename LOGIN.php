<?php
session_start();
$login="";
$erreur="";
if(isset($_POST["LOGIN"])){
	$login=$_POST['LOGIN'];
	$password=$_POST['PASSWORD'];
		$REQUETE=" select count(ID) from users where LOGIN=:login and PASSWORD=:password";
		try
        {
            $conn=new PDO("mysql:host=localhost;dbname=les_etudiants","fayssal","1447");
        }
        catch(Exception $e)
        {
            die('erreur :'.$e->getmessage());
        }
        $password=$password;
        $stmt=$conn->prepare($REQUETE);
        $stmt->execute(array(":login"=>$login,":password"=>$password));
        $data=$stmt->fetch();
        if($data[0]!=0){
            setcookie('cns',"connected",time()+300,null,null,false,true);
            setcookie('login',$login,time()+300,null,null,false,true);
            
            header("location:connexion2.php");
        }else $erreur="le mot de passe ou login incorrecte ! ";
}
session_reset(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>HTML5/CSS3 RESPONSIVE !</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,
	initial-scale=1.0">
</head>
<style>
<?php include 'stylem.css'?>
#er{
    background-color: #ee9c9c;
    color: red;
    border-radius: 5px;
    padding: 5px;
    width: 300px;
}
#inp,#inp2{
    width: 300px;
    padding: 5px;
}
#input{
    background-color: whitesmoke;
	padding: 3%;
	/*margin:0 auto  ;*/
    margin-top: 3%;
    margin-right: 3%;
    margin-left: -3%;
	border-radius: 8px;
    width: 40%;


}
#img2{
    width: 100px;
    height: 100px;
}
</style>


<body class="bodyy" id="BD">
<?php include 'ph.php' ?>


<div id='input'>
<img src="5087579.png" id="img2">
<form id="body" method="post" action="#">
<input type="text" name="LOGIN" required  id="inp" placeholder="LOGIN" value="<?=$login?>"><br/>
<input type="password" name="PASSWORD" required placeholder="PASSWORD" id="inp2"><br/>
<input type="submit"  value="connecter" id="bot" class="butn">
<p id="er"><?=$erreur?></p>
<?
//$errpassword ?>
</form>
</div>
	</body>
	</html>
    <SCRipt>
        let form=document.getElementById("inp")
        let form2=document.getElementById("inp2")

window.onload=function(){
        form.focus()

}
  </SCRipt>