<?php
require 'param/param.php';
require 'inc/framework.php';

$html_wrap = true;

// On va activer le moteur de Session
session_name(SESSION_NAME);
// Version sans utilisation de la constante
// session_name('ma_session_de_site');
session_start();
// J'ai accès à la variable $_SESSION

// Message après l'envoie du formulaire
if (isset($_SESSION['message'])) {
    echo '<div id="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

// Verification si la page existe
if (!empty($_GET['page']) && isset($page[$_GET['page']])) {
    $url_php = $page[$_GET['page']];
} else {
    $url_php = $page['home'];
}


$url_php_func = str_replace('.php', '_func.php', $url_php);
// $url_php = 'mod/galerie/galerie_header.php';

// $url_php_header = 'mod/galerie/galerie_header.php
if (is_file($url_php_func)) {
    include $url_php_func;
}

$url_php_proc = str_replace('.php', '_proc.php', $url_php);
// $url_php = 'mod/galerie/galerie_header.php';

// $url_php_header = 'mod/galerie/galerie_header.php
if (is_file($url_php_proc)) {
    include $url_php_proc;
}

$url_php_header = str_replace('.php', '_header.php', $url_php);
// $url_php = 'mod/galerie/galerie_header.php';

// $url_php_header = 'mod/galerie/galerie_header.php
if (is_file($url_php_header)) {
    include $url_php_header;
}

if ($html_wrap) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="mobile-web-app-capable" content="yes">
        <?php
        $url_php_meta = str_replace('.php', '_meta.php', $url_php);
        if (is_file($url_php_meta)) {
            include $url_php_meta;
        }
        ?>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Inclusion Police TTF -->
        <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="css/btnTop.css" />

        <!-- swiper -->

        <script src="js/swiper.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/d19de467c5.js" crossorigin="anonymous"></script>


        <!--btn top-->

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/return.js"></script>




        <?php
        // Gestion du fichier _head
        $url_php_head = str_replace('.php', '_head.php', $url_php);
        // $url_php_head = 'mod/galerie/galerie_head.php';
        if (is_file($url_php_head)) {
            include $url_php_head;
        } else {
            echo '<title>' . $TITLE . '</title>';
        }
        ?>
    </head>

    <button class="btn btnTop"><i class="fas fa-angle-double-up"></i></button>

<?php
} // Fin du test if($html_wrap){

require $url_php;

if ($html_wrap) {
?>

    </html>
<?php
}
?>