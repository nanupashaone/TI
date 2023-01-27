<?php

# var_dump($_POST);   
?>
<!DOCTYPE html>
<html lang="fr">
    <head>    
        <meta charset="UTF-8">   
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>Mail</title>    
        <link href='css/style.css' rel='stylesheet' />    
        <link href='css/captcha.css' rel='stylesheet' />    
        <script src="js/captcha.js" defer></script>
    </head>
       <body onload="captchaCF2M(submitForm, 7);">    
       
       <h1>Livre d'or</h1>    
       
       <?php
    # si on a un message
    if(isset($message)):
        # on l'affiche
    ?>    
    <h4><?=$message?></h4>   
    <?php
    endif;
    ?>    

<div class="container">
  <h1>Formulaire de contact</h1>
  <form action="/action_page.php">
    <label for="fname">Nom</label>
    <input type="text" id="fname" name="firstname" placeholder="Votre nom">
    
    <label for="fname">Prénom</label>
    <input type="text" id="fname" name="firstname" placeholder="Votre prénom">

    <label for="sujet">Sujet</label>
    <input type="text" id="sujet" name="sujet" placeholder="L'objet de votre message">

    <label for="emailAddress">Email</label>
    <input id="emailAddress" type="email" name="email" placeholder="Votre email">


    <label for="subject">Message</label>
    <textarea id="subject" name="subject" placeholder="Votre message" style="height:200px"></textarea>
    <button id="captchaValidate" type="button">Valider</button>
    
  </form>
</div>

     <div> <p id="captcha"></p></br></br> 
        <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span></br></br>           
                 
        <button id="captchaRefresh" type="button">Refresh</button>        
       
    </div>    
       
        <h3>Messages précédents</h3>    
    <?php

    # pas de mail
    if(empty($nbMail)):
    ?>    <h4>Pas encore d'adresses</h4>    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>   
         <h4>Nous avons <?=$nbMail?> adresses inscrites</h4>       
    <?php

        # tant qu'on a des mail
        foreach($responseMail as $item):
        ?>
        
    <div class='theMail'>

         <?=$item['firstname']?> 
         <?=$item['lastname']?> 
         <?=$item['usermail']?>
         <?=$item['message']?>
        
    </div> 
          
    <?php
        endforeach;
    endif;
    ?></body></html>