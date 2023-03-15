<?php
$bdd = Data::getInstance();
$message_error = "";

// Test retour formulaire

if (isset($_POST) && !empty($_POST)) {

    // Verification login et mot de passe avec les données en BDD
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM t_user WHERE login='" . $login . "' LIMIT 1;";

    $rs = $bdd->query($sql);

    if ($rs && mysqli_num_rows($rs)) {
        $data = mysqli_fetch_assoc($rs);
        if ($password == $data['password']) {
            // Enregistrement des informations en session
            $_SESSION[SESSION_NAME]['id_user'] = $data['id'];
            $_SESSION[SESSION_NAME]['nom_user'] = $data['prenom'] . ' ' . $data['nom'];
            $_SESSION[SESSION_NAME]['avatar'] = 'pic/upload/avatar/' . $data['avatar'];

            header("location: index.php");
        } else {
            $message_error = '<div class="login_ko">Mot de passe incorrect !</div>';
        }
    } else {
        $message_error = '<div class="login_ko">Login Introuvable</div>';
    }



    // Seconde methode (plus sécurisé mais moins ergonomique pour l'utilisateur
    /*$sql = "SELECT * FROM t_user WHERE login='".$login."' AND password='".$password."' LIMIT 1;";
        $rs = query($sql);
        if($rs && mysqli_num_rows($rs)){
            // Login OK
            $data = mysqli_fetch_assoc($rs);
            $_SESSION[SESSION_NAME]['id_user'] = $data['id'];
            $_SESSION[SESSION_NAME]['nom_user'] = $data['prenom'].' '.$data['nom'];
            $_SESSION[SESSION_NAME]['avatar'] = 'pic/upload/avatar/'.$data['avatar'];

            header("location: index.php");
        }else{
            // Login KO
            $message_error = '<div class="login_ko">Login impossible</div>';
        }*/
}

// Creation du formulaire de connexion
$html = '   <form method="post" action="" name="signup-form">';
$html .= '     <p class="sign" align="center">Se connecter</p>';
$html .= '       <div class="form1">';
$html .= '         <input name="login" type="text" id="login" align="center" placeholder="Nom">';
$html .= '         <input  name="password" type="password" id="password" align="center" placeholder="Mot De Passe">';
$html .= '          <input type="submit" class="submit" align="center" value="Se connecter" >';
$html .= '     <p class="forgot" align="center"><a href="#">Mot de passe oublié?</p>';
$html .= '   </form>';
$html .= $message_error;
