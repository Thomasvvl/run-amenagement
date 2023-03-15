<?php

$bdd = Data::getInstance();

// Test pour suppression utilisateur
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    // Recuperer l'image Avatar
    // supprimer l'avatar

    // Suppression de l'utilisateur
    $bdd->simple_delete('contact_form', $_GET['delete_id']);
}

// Requete SQL
$sql = 'SELECT';
$sql .= ' id,';
$sql .= ' name,';
$sql .= ' email,';
$sql .= ' subject,';
$sql .= ' message';
$sql .= ' FROM contact_form;';

// Execution requete
$datas_mail = $bdd->getData($sql);

$html = '';

// Test retour requete
if ($datas_mail) {

    $html .= '<div class="zone_contenu_clean">';
    $html .= '   <div class="form-style">';
    $html .= '       <h1>Listing Mail<span>Listing des mail dans le site...</span></h1>';



    // Première ligne du tableau
    $html .= '        <table style="width:80%;margin:auto;padding:20px;" cellspacing="0" cellpadding="0">';
    $html .= '              <tr class="tab_header">';
    $html .= '                  <td class="tab_td">ID</td>';
    $html .= '                  <td class="tab_td">Nom</td>';
    $html .= '                  <td class="tab_td">Email</td>';
    $html .= '                  <td class="tab_td">Objets</td>';
    $html .= '                  <td class="tab_td">Message</td>';
    $html .= '                  <td class="tab_td" style="width:100px;">&nbsp;</td>';
    $html .= '              </tr>';

    $i = 0;
    // Parcours des resultats
    foreach ($datas_mail as $data_mail) {
        $i++;
        // Boucle qui parcours les resultats de la requete
        if ($i % 2)
            $html .= '       <tr class="tab_row_1">';
        else
            $html .= '       <tr class="tab_row_2">';

        $html .= '            <td class="tab_td">' . $data_mail['id'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_mail['name'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_mail['email'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_mail['subject'] . '</td>';
        $html .= '            <td class="tab_td">' . $data_mail['message'] . '</td>';

        // Actions
        $html .= '            <td class="tab_td">';
        $html .= '                <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_mail&delete_id=' . $data_mail['id'] . '">';
        $html .= '                    <img src="./pic/suppr.png" />';
        $html .= '                </a>';
        $html .= '             </td>';
        $html .= '        </tr>';
    }

    $html .= '        </table>';
    $html .= '   </div>';
    $html .= '</div>';
}
