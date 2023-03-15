<?php
$bdd = Data::getInstance();

$html_result = '';

// Verification si retour d'un formulaire $_POST
if (isset($_POST)  && !empty($_POST)) {
    // Etape 1. Gestion du fichier uploader

    // Etape 1.1. Test si fichier saisi par l'utilisateur
    if (isset($_FILES) && !empty($_FILES)) {
        // Etape 1.2. Génération d'un nom de fichier unique
        $tab_name = explode('.', $_FILES['form_file']['name']);
        $unique_name = uniqid('img_') . '.' . $tab_name[count($tab_name) - 1];



        // Etape 1.3. Vérification de l'extension du fichier
        if (!preg_match('/\.(jpg|gif|png|jpeg)$/', $_FILES['form_file']['name'])) {
            $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
            $html_result .= '    Erreur ! Type fichier non supporté...<br/>';
            $html_result .= '</div>';
        } else {
            // Etape 1.4. Selection du repertoire et chemin du fichier uploadé
            $target_file = '../pic/upload/' . $unique_name;

            // Etape 1.5. Gestion réel de l'upload
            if (move_uploaded_file($_FILES['form_file']['tmp_name'], $target_file)) {
                require 'class/image.class.php';

                $mon_image = new Image($target_file);
                $mon_image->resizeByMin(400);
                $mon_image->store($target_file);
                $mon_image->resizeByMin(64);
                $mon_image->cropSquare();
                $mon_image->store('pic/upload/' . $unique_name);

                // Calcule de la couleur moyenne
                $average_color = $mon_image->average();

                $r = hexdec(substr($average_color, 0, 2)); // 23 -> nombre en decimal
                $g = hexdec(substr($average_color, 2, 2));
                $b = hexdec(substr($average_color, 4, 2));

                $html_result = '<div class="result_form_ok" id="result_form_ok" onclick="document.getElementById(\'result_form_ok\').remove();">';
                $html_result .= '    Image uploadé ! <br/>';
                $html_result .= '    <img src="' . $target_file . '" style="width:80%;margin:auto; margin-top:50px;margin-bottom:50px;"/>';
                $html_result .= '</div>';

                // Enregistrer les informations en BDD !
                $h = array();
                $h['titre'] = $_POST['form_title'];
                $h['fichier'] = $unique_name;
                $h['ordre'] = $bdd->squery('SELECT IFNULL(MAX(ordre) + 1,1) ');
                $h['fk_user'] = 1;
                $h['r'] = $r;
                $h['g'] = $g;
                $h['b'] = $b;

                $table = $_POST['table'];
                $bdd->simple_insert($table, $h);
            } else {
                //Erreur Upload
                $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
                $html_result .= '    Erreur Upload !<br/>';
                $html_result .= '</div>';
            }
        }
    }
}

$html = '<div class="zone_contenu_clean">';

// Formulaire de modification des informations de l'utilisateur
$html .= '   <div class="form-style">';
$html .= '       <h1>Upload Image<span>Pour ajouter une image remplir ce formulaire...</span></h1>';

// Formulaire de modification des information sur l'utilisateur
$html .= '       <form method="POST" action="index.php?page=upload" enctype="multipart/form-data">';


$html .= '    <label for="table">Sélectionnez le répertoire :</label> ';
$html .= '    <select name="table" id="table"> ';
$html .= '        <option value="cuisine">Cuisine</option> ';
$html .= '        <option value="dressing">Dressing</option> ';
$html .= '        <option value="sdb">Salle de bain</option> ';
$html .= '        <option value="portail">Portail</option> ';
$html .= '    </select> ';




// Titre et Image
$html .= '           <div class="section"><span>1</span>Titre et Fichier</div>';
$html .= '           <div class="inner-wrap-l">';
$html .= '               <label>Titre <input type="text" name="form_title" value=""/></label>';
$html .= '           </div>';
$html .= '           <div class="inner-wrap-r">';
$html .= '               <label>Image <input type="file" name="form_file"/>\';</label>';
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';

// Résultat Upload
$html .= '           <div class="section"><span>2</span>Informations Upload</div>';
$html .= '           <div class="inner-wrap">';
$html .= '               ' . $html_result;
$html .= '           </div>';
$html .= '           <div style="clear:both;"></div>';

// Bouton Enregistrer
$html .= '           <div class="button-section">';
$html .= '               <input type="submit" name="Enregistrer" />';
$html .= '           </div>';

$html .= '       </form>';
$html .= '   </div>';
$html .= '</div>';
