<?php
# débugogage de la variable POST
//var_dump($_POST);   
?>
<!DOCTYPE html><html lang="en">
    <head>    
    <meta charset="UTF-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Mail</title>    
    <link href='css/style.css' rel='stylesheet' />    
    <link href='css/captcha.css' rel='stylesheet' />    
    <script src="js/captcha.js" defer></script>
    </head>
    <body class="gradient-background" onload="captchaCF2M(submitForm, 7);">    
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
        <form id='monFormulaire' name='lemail' action='' method="POST">           
             <input type="text" name="firstname" placeholder="Prénom *" required><br><br>           
              <input type='text' name="lastname" placeholder="Nom" required><br><br>            
              <input type='email' name="usermail" placeholder="E-mail *" required><br><br>           
              <textarea name="message" placeholder="Message" cols="30" rows="10"></textarea><br>           
              <strong>champs obligatoire (*)</strong>        
        </form>        
        </div>        
        <br>        
        <div class="capt">            
            <p id="captcha"></p></br></br>            
            <input id="captchaInput" type="text" placeholder="Entrez le captcha"><span></span>
            </br></br>            
            <button id="captchaValidate" type="button">Valider</button>            
            <button id="captchaRefresh" type="button">Refresh</button>        
        </div>    
            <h3>Messages précédents</h3>   
        <?php
    # pas de mail
    if(empty($nbMail)):
        ?>    
    <h4>Pas encore d'adresses</h4>   
    
    <?php
    # on a au moins un mail
    else:
        # affichage du nombre de mail
        ?>    <h4>Nous avons <?=$nbMail?> adresses inscrites</h4>        
    <?php
        # tant qu'on a des mail
        foreach($responseMail as $item):
    ?>
    <div class='theMail'>
        <?=$item['firstname']?> 
        <?=$item['lastname']?> <?=$item['usermail']?>
         <?=$item['message']?>
    </div>        
    
    <?php
        endforeach;
    endif;
    ?>
    </body>
    </html>