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
#H2,#H3{
	text-align: center;
	padding-top: 5%;
	margin-top: 40px;
	height: 120px;
}
a{
 text-decoration: none;
 color: inherit;
}
p{
	text-align: center;
}
#img2{
    width: 30px;
    height: 30px;
}
</style>
<body class="bodyy">
<?php include 'ph.php' ?>
	<a href="LOGIN.php"><h2 id='H2' class="h2"><p>Espace d'enseignant  <img src="46467.png" id="img2" ></p>
</h2></a>
	<a href="CONNEXION.php"><h2 id='H3'class="h2"><p>Espace d'etudiant  <img src="1904186.png" id="img2"></p>
</h2></a>
	</body>
	</html>
	<script>
		let but=document.getElementById('H2');
		but.addEventListener("mouseout",function(){
			but.style.color="white"
			but.style.background="#1cc4cf"
		})
		but.addEventListener("mouseover",function(){
			
			but.style.color="#1cc4cf"
			but.style.background="white"
		})
		let buts=document.getElementById('H3');
		buts.addEventListener("mouseout",function(){
			
			buts.style.color="white"
			buts.style.background="#1cc4cf"
			
		})
		buts.addEventListener("mouseover",function(){
			buts.style.color="#1cc4cf"
			buts.style.background="white"
		})
		window.onload=function(){
			but.style.animation="bounce 1.5s cubic-bezier(0.8,0,1,1) infinite alternate"
			buts.style.animation="bounce 1.5s cubic-bezier(0.8,0,1,1) infinite alternate"

		}
	</script>