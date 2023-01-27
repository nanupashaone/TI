<?php
# chargement des constantes de connexion
require_once "../config.php";
# Essai de connexion
try{
    # connexion mysqli
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    # charset
    mysqli_set_charset($db,DB_CHARSET);
# capture l'erreur
}catch(Exception $e){
    # arrêter le script et afficher l'erreur
    exit(utf8_encode($e->getMessage()));
}
# si il existe les variables POST = formulaire envoyé
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['usermail'], $_POST['message']  )){
    # traitement des champs contre injection SQL (Sécurité!)
    $prenom = htmlspecialchars(strip_tags(trim($_POST['firstname'])),ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST['lastname'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['usermail'])),ENT_QUOTES);
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);
    # débugage des champs traités
    // var_dump($nom,$mail);
    # si les champs sont bons (ici vide, donc une seule erreur générale)
    if(!empty($nom)&&!empty($mail)){
        # insertion partie SQL
        $sqlInsert = "INSERT INTO `livreor` (`id`, `firstname`, `lastname`, `usermail`, `message`, `datemessage`) VALUES (NULL, '$prenom', '$nom', '$mail', '$message', CURRENT_TIMESTAMP)";
        # requête avec try catch
        try{
            # requête
            mysqli_query($db,$sqlInsert);
            # si pas d'erreur création du texte
            $messageZ ="Merci pour votre inscription";
        }catch(Exception $e){
           # echo $e->getCode();
           # avec le code erreur SQL on peut faire des erreurs différentes, idem avec le $e->getMessage() etc...
            if($e->getCode()==1406){
                # création de l'erreur
                $messageZ = "Un champs est trop long";
            }elseif($e->getCode()==1062){
                # création de l'erreur
                $messageZ = "Vous êtes déjà inscrit avec ce mail";
            }
        }
    # sinon erreur
    }else{
        # création de la variable $message
        $messageZ = "Il y a eu un problème lors de votre inscription, veuillez réessayer";
    }
}
else {
    $messageZ ="lulu";
}
# chargement de tous les mails
// requête en variable texte contenant du MySQL
$sqlMail = "SELECT `firstname`,`lastname`, `usermail`,`message` FROM `livreor` ORDER BY `datemessage` DESC; ";
// exécution de la requête avec un try / catch
try {
    $queryMail = mysqli_query($db, $sqlMail);
}catch(Exception $e){
    # arrêter le script et afficher l'erreur (de type SQL)
    exit(utf8_encode($e->getMessage()));
}
# on compte le nombre de mails récupérés
$nbMail = mysqli_num_rows($queryMail);
# on convertit les mails récupérés en tableaux associatifs intégrés dans un tableau indexé
$responseMail = mysqli_fetch_all($queryMail,MYSQLI_ASSOC);
# on efface les données récupérées pas un SELECT (bonnes pratiques)
mysqli_free_result($queryMail);
# fermeture de connexion  (bonnes pratiques)
mysqli_close($db); 
# appel de la vue
include_once '../view/indexView.php';