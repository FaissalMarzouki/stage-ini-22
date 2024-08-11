<?php 
$login1="";
$idcher="";
if(isset($_COOKIE["cns"])){
    $login1=$_COOKIE['login'];
$dateS="date de soutenance :par exemple(2022-08-15)";
$lname="";
$fname="";
$login="";$errlogin="";
$password1="";$password2="";
$errpassword="";
$CONFIRMATION="";
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
#inp{
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
    width: 100%;


}
.mainc{
    width: 75%;
    margin-top: 2%;
}
table{
    width: 100%;
    font-size: x-small;
}
#bot2{
    background-color: #111545;
    color: white;
    border-radius: 4px;
}
#theSidebar{
    width: 17%;
    height: 450px;

}
#H2,#H_{
    background-color: #4e4efe;
}
#H{
    background-color: #ff7163;
}
h2{
    width: 100%;
    font-size: medium;
}
#inp1{
    width: 150px;
    padding: 5px;
    margin: 5px;
}
#img2{
    width: 100px;
    height: 100px;
}
#theSidebar{
    animation: bounce 12s cubic-bezier(0.8,0,1,1) infinite alternate;
}
@keyframes bounce {
    100%{
        margin-top: 52%;
    }

}
</style>
<body class="bodyy" id="BD">
<?php include 'ph.php' ?>
<div class="mainc">
<img src="2145788.jpg" id="img1">

    <h3 id="H2">Nouneau etudiants</h3>
    <div id='input'>
        <form action="#" method="post">
            <input type="number" name="id" id="inp"  placeholder="numero apogee de l'etudiant" required > 
            <input type="text" name="nom" id="inp" placeholder="le nom" required >
            <input type="text" name="prenom" id="inp"  placeholder="le prenom" required >
            <input type="text" name="filiere" id="inp"  placeholder="filiere" required >
            <input type="text" name="titreSI" id="inp"  placeholder="titre de stage d'initiation" required>
            <input type="number" name="numero" id="inp"  placeholder="numero apogee de l'enseignant" required> 
            <input type="text" name="nom_ens" id="inp"  placeholder="le nom de enseignant" required >
            <input type="text" name="prenom_ens" id="inp"  placeholder="le prenom de enseignant" required >
            <input type="text" name="dateS" id="inp"  placeholder="la date de soutenance" required value="<?=$dateS?>">
            <input type="text" name="lieu_sout" id="inp"  placeholder="lieu de soutenance"required >
            <input type="number" name="note_r" id="inp"  placeholder="note de rapport" required >
            <input type="number" name="note_s" id="inp"  placeholder="note de soutenance" required >
            <input type="number" name="note_s_e_ecole" id="inp"  placeholder="note de suivi de l'encadrant de l'ecole" required >
            <input type="number" name="note_s_e_ent" id="inp"  placeholder="note de suivi de l'encadrant de l'entreprise" required ><br/>
            <input type="submit" value="Ajouter" id='bot'>
        </form>
    </div>
    <h2>Suprimer un etudiant</h2>
  <form action="#" method="post">
      <input type="number" name="idelv" required id="inp"  placeholder="numero apogee d'etudiant que tu veut suprimer">
      <input type="submit" value="suprimer" id="bot2">
  </form>
  <?php
try
{
    $conn=new PDO("mysql:host=localhost;dbname=les_etudiants",'fayssal','1447');
}
catch(Exception $e)
{
    die('erreur : in login or password'.$e->getmessage());
}
if(isset($_POST['NOM']))
{
	$lname=$_POST['NOM'];
	$fname=$_POST['PRENOM'];
	$login=$_POST['LOGIN'];
	$password1=$_POST['PASSWORD1'];
	$password2=$_POST['PASSWORD2'];
	if($password1==$password2)
	{
		$REQUETE=" insert into users values(NULL,:nom,:prenom,:login,:password,NOW())";
		$stmt=$conn->prepare($REQUETE);
		$stmt->execute(array(":nom"=>$lname,":prenom"=> $fname,":login"=>$login,":password"=>$password1));
		$CONFIRMATION="VOUS ETES INSCRITS";
	}else{
		$errpassword="LES MOTS DE PASSE EST DIFFERANT";
	}
}
  if(isset($_POST['idelv']))
  {
    $idelv=$_POST['idelv']; 
    $del1='delete from etudiant WHERE id=?';
    $del2='delete from enseignant  WHERE id=?';
    $del3='delete from evaluation  WHERE idelv=?';
    $del4='delete from stageini  WHERE idelv=?';

$res1=$conn->prepare($del1);
$res2=$conn->prepare($del2);
$res3=$conn->prepare($del3);
$res4=$conn->prepare($del4);

$res1->execute(array($idelv));
$res2->execute(array($idelv));
$res3->execute(array($idelv));
$res4->execute(array($idelv));
  }
  ?>
    <div>
<h2 id="H2">liste des etudiants</h2>
<?php

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $filiere=$_POST['filiere'];
    $titreSI=$_POST['titreSI'];
    $numero=$_POST['numero'];
    $nom_ens=$_POST['nom_ens'];
    $prenom_ens=$_POST['prenom_ens'];
    $dateS=$_POST['dateS'];
    $lieu_sout=$_POST['lieu_sout'];
    $note_r=$_POST['note_r'];
    $note_s=$_POST['note_s'];
    $note_s_e_ecole=$_POST['note_s_e_ecole'];
    $note_s_e_ent=$_POST['note_s_e_ent'];
    $requte1="insert into etudiant VALUES ('$nom','$prenom',$id,'$filiere')";
    
    $requte2="insert into  enseignant VALUES ($numero,'$nom_ens','$prenom_ens',$id)";
   
    $requte3="insert into  evaluation VALUES (null,$note_r,$note_s,$note_s_e_ecole,$note_s_e_ent,$id,$numero)";
    
    $requte4="insert into stageini VALUES (null,\"$titreSI\",'$dateS','$lieu_sout',$id,$numero)";
    $conn->exec($requte2);
    $conn->exec($requte1);
    $conn->exec($requte3);
    $conn->exec($requte4);
}
$query="select etudiant.nom as nom,etudiant.prenom as prenom,etudiant.flr as filiere,etudiant.id as id,
enseignant.nom_ens as nom_ens,enseignant.prenom_ens as prenom_ens,
evaluation.note_r as note_r,evaluation.note_s as note_s,evaluation.note_s_e_ecole as note_s_e_ecole,evaluation.note_s_e_ent as note_s_e_ent,
stageini.titreSI as titreSI,stageini.date_sout as date_sout,stageini.lieu_sout as lieu_sout

from etudiant,enseignant,evaluation,stageini 
  
where etudiant.id=enseignant.id and enseignant.id=evaluation.idelv and evaluation.idelv=stageini.idelv";
$bd="select count(idelv) from stageini";
$nbr=$conn->query($bd);
$nbr=$nbr->fetch();
$result=$conn->query($query);
$result=$result->fetchAll();
echo "<div>";
echo "<table border=\"1\" cellspacing=\"0\" id='table' >"; 
echo "<tr><th>id</th><th>nom</th><th>prenom</th><th>filiere</th><th>titreSI</th><th>nomEns</th><th>prenomEns</th><th>dateS</th><th>lieuSout</th><th>noteR</th><th>noteS</th><th>notesEEcole</th><th>noteSEEnt</th></tr>";
$i=0;
while($i<$nbr[0]){
    
    $filiere=$result[$i]["filiere"];
    $id=$result[$i]["id"];
    $nom=$result[$i]["nom"];
    $prenom=$result[$i]["prenom"];
    $titreSI=$result[$i]["titreSI"];
    $nom_ens=$result[$i]["nom_ens"];
    $prenom_ens=$result[$i]["prenom_ens"];
    $dateS=$result[$i]["date_sout"];
    $lieu_sout=$result[$i]["lieu_sout"];
    $note_r=$result[$i]["note_r"];
    $note_s=$result[$i]["note_s"];
    $note_s_e_ecole=$result[$i]["note_s_e_ecole"];
    $note_s_e_ent=$result[$i]["note_s_e_ent"];
        echo "<tr id='$id'><td>$id</td><td>$nom</td><td>$prenom</td><td>$filiere</td><td>$titreSI</td><td>$nom_ens</td><td>$prenom_ens</td><td>$dateS</td><td>$lieu_sout</td><td> $note_r</td><td>$note_s</td><td>$note_s_e_ecole</td><td>$note_s_e_ent</td></tr>";   
        $i++;
    }
echo "</table>";
echo "</div>";
?>
    </div>

</div>
<div id="sidecn2">
<aside id="theSidebar">
		<figure>
        <a href="acceuil.php"><h2 id="H">ACCEUIL <img src="home.png" alt="home" id="home"></h2></a>
    <h2 id="H_">AJOUTER UN ADIMINISTRATEUR</h2>
    <img src="2521826.png" id="img2">
<form method="post" action="#" id="add">
<input type="text" name="NOM" required  id="inp1" placeholder="NOM" value="<?=$lname?>"><br/>
<input type="text" name="PRENOM" required  id="inp1" placeholder="PRENOM" value="<?=$fname?>"><br/>
<input type="text" name="LOGIN" required  id="inp1" placeholder="LOGIN" value="<?=$login?>"><br/>
<input type="password" name="PASSWORD1" required placeholder="PASSWORD1" id="inp1"><br/>
<input type="password" name="PASSWORD2" required placeholder="PASSWORD2" id="inp1"><br/>
<input type="submit"  value="ADD" id="bot">
<p><?=$CONFIRMATION?></p>
<?=$errpassword?>
</form>
				</figure>
		<FOOter>

        </FOOter>
    </aside>
    </div>
	</body>
	</html>
    <script>
        let src=document.getElementById('src');
src.innerText="ESPACE D'ENSEIGNANT : <?=$login1?>";
let bot=document.getElementById('bot')
bot.addEventListener('mouseover',function(){
    bot.style.backgroundColor='white'
    bot.style.color='#111545'
}) 
bot.addEventListener('mouseout',function(){
    bot.style.backgroundColor='#111545'
    bot.style.color='white'
}) 
let bot2=document.getElementById('bot2')
bot2.onmouseover=function(){
    bot2.style.backgroundColor='white'
    bot2.style.color='#111545'
} 
bot2.onmouseout=function(){
    bot2.style.backgroundColor='#111545'
    bot2.style.color='white'
} 
let theSidebar=document.getElementById('theSidebar')
let inp1=document.getElementById('add')
theSidebar.addEventListener("mouseover",function(){
theSidebar.style.animation="none"
window.scroll(0,100)
})
theSidebar.addEventListener("mouseout",function(){
theSidebar.style.animation="bounce 12s cubic-bezier(0.8,0,1,1) infinite alternate"
},false)
bot2.onclick=function(){
window.onload()
}
bot.onclick=function(){
    window.onload()
}
let BD=document.getElementById("BD")
        BD.ondblclick=function(){
            window.onload()
        }
		let buts=document.getElementById('H');
		buts.addEventListener("mouseout",function(){
			
			buts.style.color="white"
			buts.style.background="#ff7163"
			
		})
		buts.addEventListener("mouseover",function(){
			buts.style.color="#ff7163"
			buts.style.background="white"
		})
        let mh=document.getElementById("mh");
mh.onmouseout=function(){
    mh.style.padding='3%'
}
mh.onmouseover=function(){
    mh.style.padding='3.5%'
}
    </script>
    <?php 
}else{
    header("location:LOGIN.php");
}
    ?>