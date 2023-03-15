<title> <?php echo $TITLE; ?> - Page Galerie </title>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.imageZoom.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="css/formulaire.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.imageZoom.css"/>
<script type="text/javascript">
    $().ready(function() {
        $(".imageZoom").imageZoom();
    });
</script>
<style type="text/css">
    .flex_galerie{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-content: flex-start;
    }
    .apercu_image{
        width: 64px;
        height: 64px;
        margin-bottom: 5px;
        margin-right: 5px;
    }
    .apercu_image a img{
        width:64px;
        height: 64px;
    }
    .btn_suppr{
        width: 16px;
        height: 16px;
        position: relative;
        top: -65px;
        left: 2px;
        background-color: rgba(255,255,255,0.7);
        border-radius: 3px;
    }
</style>