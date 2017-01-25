<?php
 include('db.php');
 require('include/functions.inc.php');

$errors = array();

$arrayMessage = array();

$nbrMessage = 0;

$infosMessage = array();

$limiteMessage = 5;


//nettoyage des inputs

    if(isset($_POST['submit'])){

        // variables

        $name = trim(strip_tags($_POST['name']));

        $surname = trim(strip_tags($_POST['surname']));

        $email = trim(strip_tags($_POST['email']));

        $message = trim(strip_tags($_POST['message']));

        $date = date("Y-m-d");

        $ip = $_SERVER['REMOTE_ADDR'];


        // insertion dans la table

       

        if(!empty($_POST)){

                if(empty($name)){

                     $errors['name'] = "insérer votre prénom svp";

                }

                if(empty($surname)){

                     $errors['surname'] = "insérer votre nom svp";

                }

                if(empty($message)){

                    $errors['message'] = "insérer votre message svp";

                }

                if(0 === sizeof($errors)) {

                  // si aucunes erreur, insertion dans la db

                $sql = $db->prepare('INSERT INTO entries(name, surname, email, message, date, ip) 

                VALUES (:name, :surname, :email, :message, :date, :ip)');

                $sql->execute(['name' => $name, 'surname'=>$surname, 'email' => $email, 'message' => $message, 'date' => $date, 'ip' => $ip]);

}



}

    }


$sql = 'SELECT COUNT(0) AS nbrMessageDb FROM entries';
$stmt = $db->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$infosMessage = $stmt->fetch();

$nbrMessage = intval($infosMessage['nbrMessageDb']);

$stmt = null;


//page

$nbrPage = ceil($nbrMessage / $limiteMessage);

$currentPage = 1;



if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbrPage ) {
         $currentPage = $_GET['p'];
      } else {
         $currentPage = 1; // page par défaut
      }

//prendre les messages dans la db et les trier


if (!empty($nbrMessage)) {
         $requeteSql = "SELECT name,surname,email,message,date FROM entries ORDER BY id DESC LIMIT ".(($currentPage - 1)*$limiteMessage).",$limiteMessage ";
         $preparedStatement = $db->prepare($requeteSql);
         $preparedStatement->execute();
         $arrayMessage = $preparedStatement->fetchAll(PDO::FETCH_OBJ);
      }



?>


<!DOCTYPE html>
<html lang="fr">

    <head>

        <title>Guestbook</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        
    </head>

<body>

<div class="container">

<div class="form_container">
    
    <h1 class="title">Guestbook</h1>


    <form class="form" action='#' method='POST'>

                <div class="input_container">

                    <label for='name'>Prénom</label>

                    <?php echo displayError($errors, 'name');?>

                    <input class="form_input" id="name" type='text' name='name' placeholder="votre prénom"></input>

                
                </div>

                <div class="input_container">

                    <label for='surname'>Nom</label>

                    <?php echo displayError($errors, 'surname');?>

            
                    <input class="form_input" id="surname" type='text' name='surname' placeholder="votre nom"></input>

                
                </div>

                <div class="input_container">

                    <label for='email'>Email (facultatif)</label>
            
                    <input class="form_input" id="email" type='email' name='email' placeholder="votre email"></input>


                </div>

                <div class="input_container">

                    <label for='message'>Message</label>

                    <textarea class="form_input" id="message" name='message' placeholder="votre message"></textarea>

                    <?php echo displayError($errors, 'message');?>

                <input class="submit" type='submit' name='submit' value='envoyer'></input>
                
                </div>
         


        </form>
</div>


<section class="commentaires">
    
    <h1 class="title">Messages</h1>

<?php foreach ($arrayMessage as $infoMessage) : ?>
               <div class="message_box">
                  <p class="message_name">
                     <?php echo $infoMessage->name ; ?> - <?php echo $infoMessage->surname; ?>
                  </p>
                  <p class="message_date">
                     <?php echo $infoMessage->date;?>
                  </p>

                  <p class="message_message">
                     <?php echo $infoMessage->message;?>
                  </p>
               </div>
            <?php endforeach; ?>
            <?php
               if (empty($nbrMessage)) {
                  echo '<p class="noMessage"> Pas de message </p>';
               }

              
            ?>



</section>

<div class="page_number">

<p>
    
    <?php

    if (!empty($nbrMessage)){

        echo 'pages : ';

        for ($i =1; $i <= $nbrPage ; $i++){

            if ($i == $currentPage){
                echo '<a class="link_page link_page--actif" href="index.php?p=' .$i. '#comments">' .$i. '</a>';
            }else{

                 echo '<a class="link_page " href="index.php?p=' .$i. '#comments">' .$i. '</a>';

            }

        }

    }



    ?>

    </p>

</div>

</div>

</body>

</html>