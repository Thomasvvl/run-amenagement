<?php
require 'param/param.php';
require 'inc/framework.php';

// On va activer le moteur de Session
session_name(SESSION_NAME);
// Version sans utilisation de la constante
// session_name('ma_session_de_site');
session_start();
// J'ai accès à la variable $_SESSION

// On force l'authentification de l'utilisateur
if (isset($_SESSION[SESSION_NAME]['id_user']) && !empty($_SESSION[SESSION_NAME]['id_user'])) {
    // L'utilisateur est connecté
    if (!empty($_GET['page']) && isset($page[$_GET['page']])) {
        $url_php = $page[$_GET['page']];
    } else {
        $url_php = $page['home'];
    }
} else {
    // L'Utilisateur n'est pas connecté
    if (!empty($_GET['page']) && isset($page[$_GET['page']]) && $page[$_GET['page']] == "le nom de ta page inscription") {
        $url_php = $page[$_GET['page']];
    } else {
        $url_php = $page['login'];
    }
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

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    <script type="javascript" url="js/common.js"></script>
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

<?php
require $url_php;
?>

</html>