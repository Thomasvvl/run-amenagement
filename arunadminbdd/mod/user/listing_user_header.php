<?php
$bdd = Data::getInstance();

// Test pour suppression utilisateur
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    // Recuperer l'image Avatar
    // supprimer l'avatar

    // Suppression de l'utilisateur
    $bdd->simple_delete('t_user', $_GET['delete_id']);

    // Redirection vers le listing des utilisateurs
    header("location: index.php?page=listing_user");
}

// Requete SQL
$sql = 'SELECT';
$sql .= ' id,';
$sql .= ' nom,';
$sql .= ' prenom,';
$sql .= ' login';
$sql .= ' FROM t_user;';

// Execution requete
$datas_user = $bdd->getData($sql);

$html = '';

// Test retour requete
if ($datas_user) {

    $html .= '<div class="zone_contenu_clean">';
    $html .= '   <div class="form-style">';
    $html .= '       <h1>Listing Utilisateur<span>Listing des utilisateurs dans le site...</span></h1>';

    // Bouton Ajout d'un utilisateur
    $html .= '   <div class="new_user">';
    $html .= '       <a href="index.php?page=edit_user">';
    $html .= '           <img src="./pic/add_user.png" />';
    $html .= '       </a>';
    $html .= '   </div>';

    // Première ligne du tableau
    $html .= '        <table style="width:80%;margin:auto;padding:20px;" cellspacing="0" cellpadding="0">';
    $html .= '              <tr class="tab_header">';
    $html .= '                  <td class="tab_td">ID</td>';
    $html .= '                  <td class="tab_td">Nom</td>';
    $html .= '                  <td class="tab_td">Prénom</td>';
    $html .= '                  <td class="tab_td">Login</td>';
    $html .= '                  <td class="tab_td" style="width:100px;">&nbsp;</td>';
    $html .= '              </tr>';

    $i = 0;
    // Parcours des resultats
    foreach ($datas_user as $data_user) {
        $i++;
        // Boucle qui parcours les resultats de la requete
        if ($i % 2)
            $html .= '       <tr class="tab_row_1">';
        else
            $html .= '       <tr class="tab_row_2">';

        $html .= '            <td class="tab_td">' . $data_user['id'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_user['nom'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_user['prenom'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_user['login'] . '</td>';

        // Actions
        $html .= '            <td class="tab_td">';
        $html .= '                <a href="index.php?page=edit_user&id=' . $data_user['id'] . '">';
        $html .= '                    <img src="./pic/edit.png" />';
        $html .= '                </a>';
        $html .= '                <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_user&delete_id=' . $data_user['id'] . '">';
        $html .= '                    <img src="./pic/suppr.png" />';
        $html .= '                </a>';
        $html .= '             </td>';
        $html .= '        </tr>';
    }

    $html .= '        </table>';
    $html .= '   </div>';
    $html .= '</div>';
}
