<?php
session_start();
//if(!empty($_GET['id']))
if(!empty($_SESSION['id']))
{

        try
        {
            $conn=new PDO("mysql:host=localhost;dbname=les_etudiants","fayssal","1447");
        }
        catch(Exception $e)
        {
            die('erreur :'.$e->getmessage());
        }
            //$id=$_GET['id'];
            $id=$_SESSION['id'];
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




            require('fpdf.php');
            $pdf=new FPDF('P','mm','A5');//(portrait,en mm,taille A5)
            $pdf->AddPage();
            $pdf->Image('entete01.png',5,5,140,20);//FILE,X,Y,W,H
            $pdf->ln(18);
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(0,10,"Fiche d'evaluation du stage d'initiation(SI)",'TB',1,'C');
            //$pdf->Cell(0,10,0,1,'C');
            $pdf->ln(5);
            $pdf->SetFont('Arial','',10);
            $h=6;
            $retrait="     ";
            $pdf->Write($h,$retrait."Filiere:");
        
            $pdf->SetFont('','BIU');
            $pdf->Write($h,$filiere."\n");
            $pdf->SetFont('','');
            $pdf->Write($h,$retrait."le nom & prenom de l'etudiant : ".$nom." ".$prenom."\n");
            $pdf->Write($h,$retrait."Titre du SI:".$titreSI."\n");
            $pdf->Write($h,$retrait."le nom et prenom de l'encadrant : ".$nom_ens." ".$nom_ens."\n");
            $pdf->Write($h,$retrait."Date de la soutenance:".$dateS."\n");
            $pdf->Write($h,$retrait."mode d'evaluation:\n");

            //$pdf->SetFont('Arial','B',12);
            $pdf->Cell(70,5,'note de rapport',1,0);
            $pdf->Cell(32,5,'   A   ',1,0);
            $pdf->Cell(25,5,$note_r."/20",1,1);
            $pdf->Cell(70,5,'note de soutenance',1,0);
            $pdf->Cell(32,5,'   B   ',1,0);
            $pdf->Cell(25,5,$note_s."/20",1,1);
            $pdf->Cell(70,5,'note de suivi de l\'encadrant de l\'ecole',1,0);
            $pdf->Cell(32,5,'   C   ',1,0);
            $pdf->Cell(25,5,$note_s_e_ecole."/20",1,1);
            $pdf->Cell(70,5,'note de suivi de l\'encadrant de l\'entreprise',1,0);
            $pdf->Cell(32,5,'   D   ',1,0);
            $pdf->Cell(25,5,$note_s_e_ent."/20",1,1);
            $pdf->Cell(70,5,'note de rapport',1,0);
            $pdf->Cell(32,5,'((2*A)+(2*B)+C+D)',1,0);
            $pdf->Cell(25,5,sprintf("%0.2f",((2*$note_r)+($note_s*2)+$note_s_e_ecole+$note_s_e_ent)/6)."/20",1,1);
            $pdf->Write($h,$retrait."mode d'evaluation:\n");

            $pdf->Cell(44,7,' jury ',1,0);
            $pdf->Cell(44,7,'nom et prenom  ',1,0);
            $pdf->Cell(44,7,"Emargement ",1,1);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,"",1,1);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,"",1,1);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,"",1,1);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,"",1,1);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,'',1,0);
            $pdf->Cell(44,7,"",1,1);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,10,"Le coordonnateur de la filiere DUT GI",'TB',1,'C');
            $pdf->SetFont('Arial','B',6);
            $pdf->Write($h,$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait."Ecole Superieure de Technologie - Fkih Ben Salah \n");
            $pdf->SetFont('','B',6);
            $pdf->Write($h,$retrait.$retrait.$retrait.$retrait.$retrait.$retrait.$retrait."Hay Tighnari, Route Nationale N 11, 23200 Fkih Ben Salah, B.P : 336 \n");
            $pdf->Write($h,$retrait.$retrait.$retrait."Fix: 05.23.43.46.66, Fax: 05.23.43.49.99, Email: estfbs@usms.ma, Site Web: http:// estfbs.usms.ac.ma/");
            $pdf->Output('','',true);
    
        }
        else header('location:CONNEXION.php');
?>