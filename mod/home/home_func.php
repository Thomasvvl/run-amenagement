<!-- home_func.php -->

<?php

$html = '';

// Logo du site
$html .= '<nav class="navbar">';
$html .= '   <a class="logo" href="index.php">';
$html .= '       <img src="./css/img/logo.png" alt="Logo"/> ';
$html .= '   </a>';

// Informations de contact
$html .= '   <div class="container">';
$html .= '       <div class="one">';
$html .= '           <img src="./css/img/logoPhone.png" alt="Téléphone">';
$html .= '           <div class="phone">';
$html .= '               <p><strong>contacter</strong></p>';
$html .= '               <p>+262 2 62 13 25 55</p>';
$html .= '           </div>';
$html .= '           <img src="./css/img/mail.png" alt="Mail">';
$html .= '           <div class="phone">';
$html .= '               <p><strong>E-mail</strong></p>';
$html .= '               <p>run.amenagement@gmail.com</p>';
$html .= '           </div>';
$html .= '           <img src="./css/img/location.png" alt="Location">';
$html .= '           <div class="phone">';
$html .= '               <p><strong>Emplacement</strong></p>';
$html .= '               <p>156 Rue Hubert Delisle, La Rivière, Saint-Louis, La Réunion</p>';
$html .= '           </div>';
$html .= '       </div>';
$html .= '   </div>';

?>