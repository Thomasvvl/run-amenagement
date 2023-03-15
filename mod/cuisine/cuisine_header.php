<?php

$bdd = Data::getInstance();

$nb_images_par_page = 4;
$nb_images_total = $bdd->squery("SELECT COUNT(id) FROM t_cuisine;");
$nb_total_page = round($nb_images_total / $nb_images_par_page);

// Verification des informations dans l'URL
if (isset($_GET['page_cuisine'])) {
    $n_page = $_GET['page_cuisine'];
}

$debut_limit = $n_page * $nb_images_par_page;

$sql = "SELECT * FROM t_cuisine ORDER BY ordre DESC LIMIT " . $debut_limit . "," . $nb_images_par_page;

$datas_diaporama = $bdd->getData($sql);

$html .= '<section id="Cuisine">';
$html .= '    <div class="container">';
$html .= '        <div class="image">';
$html .= '            <img src="./css/img/cuis.webp" alt="">';
$html .= '        </div>';
$html .= '        <div class="texteBox">';
$html .= '            <h2>Cuisine</h2>';
$html .= '            <p>Découvrez les secrets d\'une cuisine ultra déco grâce à des mariages de couleurs astucieux qui donneront à votre intérieur un style unique ! Et attention, nous vous montrons les combinaisons gagnantes pour éviter les erreurs de mélange de couleurs.</p>';
$html .= '        </div>';
$html .= '        <div class="btnvoirplus">';
$html .= '            <a href="#diaporama">Voir plus</a>';
$html .= '        </div>';
$html .= '    </div>';
$html .= '</section>';

// Mise en forme de la page

$html .= '       <div class="diaporama">';
if ($datas_diaporama) {
    foreach ($datas_diaporama as $data_diaporama) {
        $html .= '<div class="card">';
        $html .= '   <div class="one_image">';
        $html .= '       <a href="pic/upload/' . $data_diaporama['fichier'] . '" class="imageZoom">';
        $html .= '           <img src="pic/upload/' . $data_diaporama['fichier'] . '" />';
        $html .= '       </a>';
        $html .= '   </div>';
        $html .= '   <div class="one_information">';
        $html .= '       ' . $data_diaporama['titre'];
        $html .= '   </div>';
        $html .= '</div>';
    }
}
$html .= '       </div>';

// Gestion pagination
$html .= '       <div class="pagination">';
if ($n_page > 0) {  // if($n_page) {
    $html .= '           <div class="one_pagination">';
    $html .= '               <a href="index.php?page=cuisine&page_cuisine=' . ($n_page - 1) . '">';
    $html .= '                   <<';
    $html .= '               </a>';
    $html .= '           </div>';
} else {
    $html .= '           <div class="one_pagination no_shadow">';
    $html .= '               <a href="#" onclick="return false;" class="no_link">';
    $html .= '               </a>';
    $html .= '           </div>';
}

// Gestion de l'affichage des pages

for ($i = 0; $i < $nb_total_page; $i++) {
    if ($i == $n_page)
        $html .= '           <div class="one_pagination red_shadow">';
    else
        $html .= '           <div class="one_pagination">';
    $html .= '               <a href="index.php?page=cuisine&page_cuisine=' . $i . '">';
    $html .= '                   ' . ($i + 1);
    $html .= '               </a>';
    $html .= '           </div>';
}

// Gestion derniere page
$limit = ($n_page + 1) * $nb_images_par_page;
if ($limit < $nb_images_total) {
    $html .= '           <div class="one_pagination">';
    $html .= '               <a href="index.php?page=cuisine&page_cuisine=' . ($n_page + 1) . '">';
    $html .= '                   >>';
    $html .= '               </a>';
    $html .= '           </div>';
} else {
    $html .= '           <div class="one_pagination no_shadow">';
    $html .= '               <a href="#" onclick="return false;" class="no_link">';
    $html .= '               </a>';
    $html .= '           </div>';
}

$html .= '       </div>';

$html .= '   </div>';
$html .= '</div>';

$html .= '<div class="social">';
$html .= '    <a href="https://fr-fr.facebook.com/people/Run-am%C3%A9nagement/100063721863065/">';
$html .= '        <i class="fab fa-facebook-f fa-lg"></i>';
$html .= '    </a>';
$html .= '    <div class="contact--line"></div>';
$html .= '</div>';
$html .= '<div class="email">';
$html .= '    <p class="email--item">run.amenagement@gmail.com</p>';
$html .= '    <div class="contact--line"></div>';
$html .= '</div>';
$html .= '<a href="index.php#projectsSection">';
$html .= '    <button class="btn btnTop">';
$html .= '        <i class="fas fa-angle-double-up"></i>';
$html .= '    </button>';
$html .= '</a>';
