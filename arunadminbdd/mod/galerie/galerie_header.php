<?php
$bdd = Data::getInstance();

$html_result = '';

// Verification si presence varaible GET (dans l'URL)
if (isset($_GET['id_suppr'])  && !empty($_GET['id_suppr'])) {
    $id_suppr = $_GET['id_suppr'];

    // Recuperer le nom de l'image de la table t_cuisine
    $cuisine_image = $bdd->squery("SELECT fichier FROM t_cuisine WHERE id=" . $id_suppr);
    $cuisine_image = $cuisine_image->fetchColumn();

    // Recuperer le nom de l'image de la table t_dressing
    $dressing_image = $bdd->squery("SELECT fichier FROM t_dressing WHERE id=" . $id_suppr);
    $dressing_image = $dressing_image->fetchColumn();

    // Recuperer le nom de l'image de la table t_sdb
    $sdb_image = $bdd->squery("SELECT fichier FROM t_sdb WHERE id=" . $id_suppr);
    $sdb_image = $sdb_image->fetchColumn();

    // Recuperer le nom de l'image de la table t_portail
    $portail_image = $bdd->squery("SELECT fichier FROM t_portail WHERE id=" . $id_suppr);
    $portail_image = $portail_image->fetchColumn();

    // Supprimer l'enregistrement en BDD
    $bdd->simple_delete('t_cuisine', $id_suppr);
    $bdd->simple_delete('t_dressing', $id_suppr);
    $bdd->simple_delete('t_sdb', $id_suppr);
    $bdd->simple_delete('t_portail', $id_suppr);

    // Supprimer le fichier sur le disque
    @unlink('../pic/upload/cuisine' . $cuisine_image);
    @unlink('../pic/upload/dessing' . $dressing_image);
    @unlink('../pic/upload/sdb' . $sdb_image);
    @unlink('../pic/upload/portail' . $portail_image);



    // Redirection
    header('location: index.php?page=galerie');
}

//  ---------------------------------------------------------------- Listing des images Cuisine

$nb_image = $bdd->squery("SELECT COUNT(id) FROM t_cuisine");

$html = '<div class="zone_contenu_clean">';
$html .= '   <div class="form-style">';
$html .= '       <h1>Cuisine<span>Et il y en a beaucoup... (' . $nb_image . ' images dans la BDD)</span></h1>';
$html .= '       <div class="flex_galerie">';

$sql = "SELECT * FROM t_cuisine ORDER BY ordre DESC;";
$datas_galerie = $bdd->getData($sql);

if ($datas_galerie) {
    // 1. la requete est bien executé
    // 2. La requete a retourné des informations
    foreach ($datas_galerie as $data) {
        $html .= '           <div class="apercu_image">';
        $html .= '               <a href="../pic/upload/' . $data['fichier'] . '" class="imageZoom">';
        $html .= '                   <img src="../pic/upload/' . $data['fichier'] . '" />';
        $html .= '               </a>';
        $html .= '           <div class="btn_suppr">';
        $html .= '               <a onclick="if(window.confirm(\'Etes vous sur ?\')){return true;}else{return false;}" href="index.php?page=galerie&id_suppr=' . $data['id'] . '">';
        $html .= '                   <img src="pic/suppr.png" style="width:16px; height: 16px;"/>';
        $html .= '               </a>';
        $html .= '           </div>';
        $html .= '           </div>';
    }
}

$html .= '       </div>';
$html .= '   </div>';
$html .= '</div>';


//  ---------------------------------------------------------------- Listing des images Dressing

$nb_image = $bdd->squery("SELECT COUNT(id) FROM t_dressing");

$html .= '<div class="zone_contenu_clean">';
$html .= '   <div class="form-style">';
$html .= '       <h1>Dressing<span>Et il y en a beaucoup... (' . $nb_image . ' images dans la BDD)</span></h1>';
$html .= '       <div class="flex_galerie">';

$sql = "SELECT * FROM t_dressing ORDER BY ordre DESC;";
$datas_galerie = $bdd->getData($sql);

if ($datas_galerie) {
    // 1. la requete est bien executé
    // 2. La requete a retourné des informations
    foreach ($datas_galerie as $data) {
        $html .= '           <div class="apercu_image">';
        $html .= '               <a href="../pic/upload/' . $data['fichier'] . '" class="imageZoom">';
        $html .= '                   <img src="../pic/upload/' . $data['fichier'] . '" />';
        $html .= '               </a>';
        $html .= '           <div class="btn_suppr">';
        $html .= '               <a onclick="if(window.confirm(\'Etes vous sur ?\')){return true;}else{return false;}" href="index.php?page=galerie&id_suppr=' . $data['id'] . '">';
        $html .= '                   <img src="pic/suppr.png" style="width:16px; height: 16px;"/>';
        $html .= '               </a>';
        $html .= '           </div>';
        $html .= '           </div>';
    }
}

$html .= '       </div>';
$html .= '   </div>';
$html .= '</div>';

//  ---------------------------------------------------------------- Listing des images SDB


$nb_image = $bdd->squery("SELECT COUNT(id) FROM t_sdb");

$html .= '<div class="zone_contenu_clean">';
$html .= '   <div class="form-style">';
$html .= '       <h1>Salle De Bain<span>Et il y en a beaucoup... (' . $nb_image . ' images dans la BDD)</span></h1>';
$html .= '       <div class="flex_galerie">';

$sql = "SELECT * FROM t_sdb ORDER BY ordre DESC;";
$datas_galerie = $bdd->getData($sql);

if ($datas_galerie) {
    // 1. la requete est bien executé
    // 2. La requete a retourné des informations
    foreach ($datas_galerie as $data) {
        $html .= '           <div class="apercu_image">';
        $html .= '               <a href="../pic/upload/' . $data['fichier'] . '" class="imageZoom">';
        $html .= '                   <img src="../pic/upload/' . $data['fichier'] . '" />';
        $html .= '               </a>';
        $html .= '           <div class="btn_suppr">';
        $html .= '               <a onclick="if(window.confirm(\'Etes vous sur ?\')){return true;}else{return false;}" href="index.php?page=galerie&id_suppr=' . $data['id'] . '">';
        $html .= '                   <img src="pic/suppr.png" style="width:16px; height: 16px;"/>';
        $html .= '               </a>';
        $html .= '           </div>';
        $html .= '           </div>';
    }
}

$html .= '       </div>';
$html .= '   </div>';
$html .= '</div>';
//  ---------------------------------------------------------------- Listing des images Portail

$nb_image = $bdd->squery("SELECT COUNT(id) FROM t_portail");

$html .= '<div class="zone_contenu_clean">';
$html .= '   <div class="form-style">';
$html .= '       <h1>Portail<span>Et il y en a beaucoup... (' . $nb_image . ' images dans la BDD)</span></h1>';
$html .= '       <div class="flex_galerie">';

$sql = "SELECT * FROM t_portail ORDER BY ordre DESC;";
$datas_galerie = $bdd->getData($sql);

if ($datas_galerie) {
    // 1. la requete est bien executé
    // 2. La requete a retourné des informations
    foreach ($datas_galerie as $data) {
        $html .= '           <div class="apercu_image">';
        $html .= '               <a href="../pic/upload/' . $data['fichier'] . '" class="imageZoom">';
        $html .= '                   <img src="../pic/upload/' . $data['fichier'] . '" />';
        $html .= '               </a>';
        $html .= '           <div class="btn_suppr">';
        $html .= '               <a onclick="if(window.confirm(\'Etes vous sur ?\')){return true;}else{return false;}" href="index.php?page=galerie&id_suppr=' . $data['id'] . '">';
        $html .= '                   <img src="pic/suppr.png" style="width:16px; height: 16px;"/>';
        $html .= '               </a>';
        $html .= '           </div>';
        $html .= '           </div>';
    }
}

$html .= '       </div>';
$html .= '   </div>';
$html .= '</div>';
