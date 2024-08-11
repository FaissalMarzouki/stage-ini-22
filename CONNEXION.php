
<?php
$nom="";$prenom="";
session_start();
$id="";
$erreurgeneral="";
    if(isset($_POST["id"]))
    {
        try
        {
            $conn=new PDO("mysql:host=localhost;dbname=les_etudiants","fayssal","1447");
        }
        catch(Exception $e)
        {
            die('erreur :'.$e->getmessage());
        }
        $id=$_POST["id"];
        $bd="select count(id) from etudiant where id=?";
        $exis=$conn->prepare($bd);
        $exise=$exis->execute(array($id));
        $exiss=$exis->fetch();

    }
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
#body{
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);

}
#h{
    width: 50%;
}
</style>
<body class="bodyy">
	<header class="mainheader" id="mh">
    <a href="http://estfbs.usms.ac.ma"><img id="est" src="cropped-LogoESTFBS-1.png"> </a>
            <h1 id="src">ESPACE D'ETUDIANT :</h1>

 
	</header>
	<div class="mainc">
		<section>
        
			<header>
            <img src="1234345.jpg" id="img1">

				<h2>STAGE D’INITIATION</h2>
			</header>
			<article>
				
				<p class="parag1">
                La validation du stage d’initiation étant obligatoire pour l’obtention du diplôme
                , l’étudiant doit lui accorder une attention particulière. 
                D’autant plus qu’une bonne appréciation du stagiaire de la part de l’encadreur
                 ou tuteur professionnel peut constituer une opportunité pour le stage de fin de parcours ou d’embauche.
                    <br>
					<br>
                    <h2>BASE DE DONNEE DE STAGE:</h2>
<article id="base">
<form id="body" method="post" action="#">
<input type="number" name="id" required placeholder="NUMERO APOGY" value="<?=$id?>" id="formu"><p><?=$erreurgeneral?></p>
<input type="submit"  value="chercher" id="bot">
<script>
    
</script>
<?php
if(isset($_POST["id"])){ 
        if($exiss[0]!=0)
        {
            $query="select * from etudiant where id=?";
            $query2="select titreSI,date_sout,lieu_sout from stageini where idelv=?";
            $query3="select nom_ens,prenom_ens from enseignant where id=?";
            $query4="select note_r,note_s,note_s_e_ecole,note_s_e_ent from evaluation where idelv=?";

            $result=$conn->prepare($query);
            $result2=$conn->prepare($query2);
            $result3=$conn->prepare($query3);
            $result4=$conn->prepare($query4);

            $result->execute(array($id));
            $result2->execute(array($id));
            $result3->execute(array($id));
            $result4->execute(array($id));

            $result=$result->fetchAll();
            $result2=$result2->fetchAll();
            $result3=$result3->fetchAll();
            $result4=$result4->fetchAll();

            $nom=$result[0]["nom"];
            $filiere=$result[0]["flr"];
            $prenom=$result[0]["prenom"];
            $titreSI=$result2[0]["titreSI"];
            $nom_ens=$result3[0]["nom_ens"];
            $prenom_ens=$result3[0]["prenom_ens"];
            $dateS=$result2[0]["date_sout"];
            $lieu_sout=$result2[0]["lieu_sout"];
            $note_r=$result4[0]["note_r"];
            $note_s=$result4[0]["note_s"];
            $note_s_e_ecole=$result4[0]["note_s_e_ecole"];
            $note_s_e_ent=$result4[0]["note_s_e_ent"];
            echo "<div>";
            echo "<p id=\"body\">Filiere : $filiere</p>";
            echo "<p id=\"body\">le nom : $nom</p>";
            echo "<p id=\"body\">le prenom :$prenom</p>";
            echo "<p id=\"body\">le titre de stage initiation:$titreSI</p>";
            echo "<p id=\"body\">le nom et prenom d'encadrant:$nom_ens.$prenom_ens</p>";
            echo "<p id=\"body\">la date de soutenance:$dateS</p>";
            echo "<p id=\"body\">la lieu de soutenance:$lieu_sout</p>";
            echo "<p id=\"body\">le mode d'evaluation:</p>";
            echo "<table border=\"2\" cellspacing=\"0\">";
            echo "<tr><td>note de rapport :</td><td>   A  </td><td>  $note_r/20</td></tr>";
            echo "<tr><td>note de soutenance :</td><td>   B  </td><td>  $note_s/20</td></tr>";
            echo "<tr><td>note de suivi de l'encadrant de l'ecole :</td><td>   C  </td><td>  $note_s_e_ecole/20</td></tr>";
            echo "<tr><td>note de suivi de l'encadrant de l'entreprise:</td><td>   D  </td><td>  $note_s_e_ent/20</td></tr>";
            echo "<tr><th>note de rapport :</th><th>   =((2*A)+(2*B)+C+D)";echo"  </th><th>  ".sprintf("%0.2f",((2*$note_r)+($note_s*2)+$note_s_e_ecole+$note_s_e_ent)/6);echo "</th></tr>";
            echo "</table>";
           /* echo "<p id=\"body\">Membre du jury</p>";
            echo "<table border=\"1\" cellspacing=\"0\" >"; 
            echo "<tr><th>  jury </th><th>nom et prenom  </th><th>Emargement </th></tr>";
            echo "<tr><td> <p contenteditable=\"true\"></p></td><td> <p contenteditable=\"true\"></p></td><td><p contenteditable=\"true\"></p>  </td></tr>";
            echo "<tr><td> <p contenteditable=\"true\"></p></td><td><p contenteditable=\"true\"></p> </td><td><p contenteditable=\"true\"></p> </td></tr>";
            echo "<tr><td> <p contenteditable=\"true\"></p></td><td><p contenteditable=\"true\"></p> </td><td> <p contenteditable=\"true\"></p></td></tr>";
            echo "<tr><td> <p contenteditable=\"true\"></p></td><td><p contenteditable=\"true\"></p> </td><td><p contenteditable=\"true\"></p> </td></tr>";
            echo "<tr><td> <p contenteditable=\"true\"></p></td><td><p contenteditable=\"true\"></p> </td><td><p contenteditable=\"true\"></p> </td></tr>";
            echo "</table>";*/
            echo "</div>";
            echo "<br>";
            
            $_SESSION['id']=$id;
            echo '<a href="fp.php"><botton id="botn">telecharger <img src="567.jpg" id="im"></botton></a>';
            //echo '<a href="fp.php?id='.$id.'"><botton id="bot">telecharger</botton></a>';

        }else
        {
            $erreurgeneral="inexistance de ce id";
        }
        
    }  

?>


</article> 
				</p>
			</article>
		</section>
	</div>
	<aside id="theSidebar">
    <img src="6376177.jpg" id="img2">
		<figure>
        <h2 id="H2">Objectif du stage d’initiation :</h2>
				   <p>
Le stage d’initiation est obligatoire pour tous les étudiants de l'EST.
 Son objectif est de faire découvrir aux étudiants inscrits en première année différents milieux professionnels,
  de les initier aux différentes activités 
en entreprise et de développer leur esprit d’observation dans une optique de validation des acquis d’enseignement.
				   </p>
				</figure>
		<FOOter>
            presentée par:MARZOUKI FAISSAL

        </FOOter>
        <br>
        <footer>DUT GENIE INFORMATIQUE </footer>

        <br>
        <details>
                    	<summary>Le rapport de stage</summary>
                        <p id="det">L’objectif du rapport de stage d’initiation est de montrer les capacités d’observation et de synthèse de l’étudiant.</p></details>
					<br>
                    <details>
                    	<summary>LA SOUTENANCE</summary>
                        <p id="det">La soutenance permet d’évaluer la maitrise du sujet par l’étudiant et sa capacité à argumenter et à défendre un point de vue.</p></details>
                        <a href="acceuil.php"><h2 id="h">ACCEUIL <img src="home.png" alt="home" id="home"></h2></a>
    </aside>
</body>
<script>
let bot=document.getElementById('bot')
bot.onmouseover = function(){
    bot.style.backgroundColor='white'
    bot.style.color='#111545'
}
bot.onmouseout = function(){
    bot.style.backgroundColor='#111545'
    bot.style.color='white'
}
let botn=document.getElementById('botn')
botn.onmouseover = function(){
    botn.style.backgroundColor='white'
    botn.style.color='#111545'
}
botn.onmouseout = function(){
    botn.style.backgroundColor='#111545'
    botn.style.color='white'
}
let form=document.getElementById('formu')
window.onload=function(){
    //form.focus()
    form.placeholder='NUMERO APOGIE'
    //this.scroll(0,750)
}
form.onkeyup=function(){
    sessionStorage.setItem('id',form.value)
}
let src=document.getElementById('src')
src.innerText="ESPACE D'ETUDIANT : <?=$nom." ".$prenom?>"
let buts=document.getElementById("h");
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
		buts.addEventListener("mouseout",function(){
			
			buts.style.color="white"
			buts.style.background="#ff7163"
			
		})
		buts.addEventListener("mouseover",function(){
			buts.style.color="#ff7163"
			buts.style.background="white"
		})
</script>
