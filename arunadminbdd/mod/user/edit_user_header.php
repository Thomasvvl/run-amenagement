<?php
$bdd = Data::getInstance();

// Gestion de la suppression de l'avatar
if (isset($_GET['supp_avatar'])) {
    // Suppression de l'avatar
    $id_user = $_GET['id'];

    // On recupere le nom du fichier a supprimer
    $avatar = $bdd->squery("SELECT avatar FROM t_user WHERE id=" . $id_user);

    // Suppression du fichier
    @unlink('../pic/upload/avatar/' . $avatar);

    // Update de la BDD
    $sql = "UPDATE t_user SET avatar=NULL WHERE id=" . $id_user;
    $bdd->squery($sql);

    header("location: index.php?page=edit_user&id=" . $id_user);
}

// Gestion du retour du formulaire
if (isset($_POST) && !empty($_POST)) {
    $id_user = $_POST['id_user'];

    $h = array();
    $h['nom'] = $_POST['form_nom'];
    $h['prenom'] = $_POST['form_prenom'];
    $h['login'] = $_POST['form_login'];

    // Gestion du Champs Mot de Passe
    if (!empty($_POST['form_password']))
        $h['password'] = md5($_POST['form_password']);

    $h['adresse'] = $_POST['form_adresse'];
    $h['code_postal'] = $_POST['form_cp'];
    $h['fk_ville'] = $_POST['form_ville'];
    $h['fk_pays'] = $_POST['form_pays'];
    $h['email'] = $_POST['form_email'];

    // Gestion de l'avatar
    if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['my_file']['name'])) {
        // Generation d'un nom unique
        $tab_name = explode('.', $_FILES['my_file']['name']);
        $unique_name = uniqid('img_') . '.' . $tab_name[1];

        // Préparation de l'upload
        $uploaddir = '../pic/upload/avatar/';
        $uploadfile = $uploaddir . $unique_name;
        if (move_uploaded_file($_FILES['my_file']['tmp_name'], $uploadfile)) {
            require 'class/image.class.php';
            $mon_image = new Image($uploadfile);
            $mon_image->resizeByMin(255);
            $mon_image->cropSquare(); // Une image d'avatar qui fera 255x255px
            $mon_image->store($uploadfile);

            $h['avatar'] = $unique_name;
        }
    }

    // Enregistrement en BDD des modifications
    if ($id_user) {
        // Update
        $bdd->simple_update('t_user', $id_user, $h);
    } else {
        // New
        $id_user = $bdd->simple_insert('t_user', $h);
    }

    // ToDo : Gestion des droits d'accès
    // 1 on supprime les anciens droits
    $bdd->squery("DELETE FROM t_user_mod WHERE fk_user=" . $id_user);

    // 2 on ajoute les droits pour l'utilisateur -> On liste tous les modules dans la table t_module
    $sql = "SELECT * FROM t_mod";
    $datas = $bdd->getData($sql);
    if ($datas) {
        // Pour chaque enregistrement :
        foreach ($datas as $data) {
            // On teste si l'utilisateur a cocher la case correspondante au module
            if (isset($_POST['mod_' . $data['id']]) && $_POST['mod_' . $data['id']]) {
                // Préparation du tableau memoire pour l'enregistrement des données en BDD
                $h = array();
                $h['fk_user'] = $id_user;
                $h['fk_mod'] = $data['id'];

                // Enregistrement en BDD
                $bdd->simple_insert('t_user_mod', $h);

                // On libère la memoire du serveur.
                unset($h);
            }
        }
    }

    // Redirection sur la page de modification de l'utilisateur (meme page mais avec id_user)
    header('location: index.php?page=edit_user&id=' . $id_user);
}

if (isset($_GET['id'])) {
    // Modification
    $id_user = $_GET['id'];
    // Recuperation des informations depuis la BDD
    $data = $bdd->build_r_from_id('t_user', $id_user);
} else {
    // On est en Creation
    $id_user = 0;
    $data = array();
    $data['nom'] = '';
    $data['prenom'] = '';
    $data['login'] = '';
    $data['avatar'] = '';
    $data['adresse'] = '';
    $data['code_postal'] = '';
    $data['fk_ville'] = '';
    $data['fk_pays'] = '';
    $data['email'] = '';
}


$html = '<div class="zone_contenu_clean">';

// Formulaire de modification des informations de l'utilisateur
$html .= '   <div class="form-style">';
if ($id_user > 0)
    $html .= '       <h1>Modification<span>Pour modifier l\'utilisateur, remplir ce formulaire...</span></h1>';
else
    $html .= '       <h1>Nouvel Utilisateur<span>Pour créer l\'utilisateur, remplir ce formulaire...</span></h1>';

// Formulaire de modification des information sur l'utilisateur
$html .= '       <form method="POST" action="index.php?page=edit_user" enctype="multipart/form-data">';

// Nom et Prénom
$html .= '           <div class="section"><span>1</span>Nom et Prénom</div>';
$html .= '           <div class="inner-wrap-l">';
$html .= '               <label>Nom <input type="text" name="form_nom" value="' . $data['nom'] . '"/></label>';
$html .= '           </div>';
$html .= '           <div class="inner-wrap-r">';
$html .= '               <label>Prénom <input type="text" name="form_prenom" value="' . $data['prenom'] . '"/></label>';
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';

// Information Connexion
$html .= '           <div class="section"><span>2</span>Informations connexion</div>';
$html .= '           <div class="inner-wrap-l">';
$html .= '               <label>Login <input type="text" name="form_login" value="' . $data['login'] . '"/></label>';
$html .= '           </div>';
$html .= '           <div class="inner-wrap-r">';
$html .= '               <label>Mot de passe <input type="password" name="form_password" value=""/></label>';
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';

// Adresse
$html .= '           <div class="section"><span>3</span>Adresse</div>';
$html .= '           <div class="inner-wrap-l">';
$html .= '               <label>Adresse <textarea name="form_adresse" rows="8">' . $data['adresse'] . '</textarea></label>';
$html .= '           </div>';
$html .= '           <div class="inner-wrap-r">';
$html .= '               <label>Code Postal <input type="text" pattern="[0-9]{5}" name="form_cp" value="' . $data['code_postal'] . '"/></label>';
$html .= '               <label>Ville';
$sql_ville = "SELECT * FROM t_ville ORDER BY nom ASC";
$datas_ville = $bdd->getData($sql_ville);
$html .= '                   <select name="form_ville" id="form_ville">';
$html .= '                       <option value="0">Sélection Ville</option>';
if ($datas_ville) {
    foreach ($datas_ville as $data_ville) {
        $html .= '                   <option value="' . $data_ville['id'] . '" ' . (($data['fk_ville'] == $data_ville['id']) ? ' selected ' : '') . '>' . $data_ville['nom'] . '</option>';
    }
}
$html .= '                   </select>';
$html .= '               </label>';

$html .= '               <label>Pays';
$sql_pays = "SELECT * FROM t_pays ORDER BY nom ASC";
$datas_pays = $bdd->getData($sql_pays);
$html .= '                   <select name="form_pays" id="form_pays">';
$html .= '                       <option value="0">Sélection Pays</option>';
if ($datas_pays) {
    foreach ($datas_pays as $data_pays) {
        $html .= '                   <option value="' . $data_pays['id'] . '" ' . (($data['fk_pays'] == $data_pays['id']) ? ' selected ' : '') . '>' . $data_pays['nom'] . '</option>';
    }
}
$html .= '                   </select>';
$html .= '               </label>';
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';

// Avatar
$html .= '           <div class="section"><span>4</span>e-mail & Avatar</div>';
$html .= '           <div class="inner-wrap-l">';
$html .= '               <label>e-mail <input type="email" name="form_email" value="' . $data['email'] . '"/></label>';
$html .= '           </div>';
$html .= '           <div class="inner-wrap-r">';
$html .= '               <label>Avatar <input type="file" name="my_file"/>';
if (is_file('../pic/upload/avatar/' . $data['avatar'])) {
    $html .= '               <a href="../pic/upload/avatar/' . $data['avatar'] . '" class="imageZoom"><img src="../pic/view.png" /></a>';
    $html .= '               <a href="index.php?page=edit_user&id=' . $data['id'] . '&supp_avatar=1" onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;"><img src="../pic/suppr.png" /></a>';
}
$html .= '               </label>';
$html .= '           </div>';

$html .= '           <div style="clear:both;"></div>';

// Todo : Gestion des droits
// Lister les modules disponible dans la table t_mod
$sql = "SELECT * FROM t_mod ORDER BY nom ASC;";
$datas_module = $bdd->getData($sql);

$html .= '           <div class="section"><span>5</span>Gestion des droits</div>';
$html .= '           <div class="inner-wrap">';
$html .= '               <label style="margin-bottom:30px;"> <span class="section">Modules </span></label>';
$html .= '               <div class="zone_module">';

if ($datas_module) {
    foreach ($datas_module as $data_module) {
        // On vérifie si l'utilisateur a accès au module
        $gotRight = $bdd->squery("SELECT 1 FROM t_user_mod WHERE fk_mod=" . $data_module['id'] . " AND fk_user=" . $id_user);


        $html .= '                       <div class="one_module">';
        $html .= '                           <input type="checkbox" ' . ($gotRight ? ' checked ' : '') . ' id="mod_' . $data_module['id'] . '" name="mod_' . $data_module['id'] . '" value="1" />';
        $html .= '                           <label for="mod_' . $data_module['id'] . '">' . $data_module['nom'] . '</label>';
        $html .= '                       </div>';
    }
}
$html .= '               </div>';
$html .= '           </div>';

// Bouton Enregistrer
$html .= '           <div class="button-section">';
$html .= '               <input type="submit" name="Enregistrer" />';
$html .= '           </div>';

// Champs caché...
$html .= '           <input type="hidden" name="id_user" id="id_user" value="' . $id_user . '" />';

$html .= '       </form>';
$html .= '   </div>';
$html .= '</div>';
