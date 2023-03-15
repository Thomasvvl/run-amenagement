<title> <?php echo $TITLE; ?> Page Accueil </title>

<link rel="stylesheet" href="css/external/all.min.css">
<link rel="stylesheet" href="css/cuisine.css">

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.imageZoom.css" />
<link rel="stylesheet" type="text/css" href="css/diaporama.css" />

<script type="text/javascript" src="js/jquery.imageZoom.js"></script>


<script type="text/javascript">
    $().ready(function() {
        $(".imageZoom").imageZoom();
    });
</script>

<style>
    .diaporama {
        margin-top: 7em;
    }

    footer {
        position: sticky;
        width: 100%;
        height: 60px;
        margin-top: 5em;
        text-align: center;
    }

    footer .footer-bottom {
        position: absolute;
        background: #ffffff;
        color: rgb(0, 0, 0);
        text-align: center;
        font-size: 15px;
        padding: 20px 0;
        bottom: 0;
        width: 100%;
        box-shadow: 0px 14px 30px 0px rgb(0, 0, 0);
    }

    .footer-bottom .mention {
        color: rgb(0, 0, 0);
        text-decoration: none;
        transition: 0.5s;
    }

    .footer-bottom .portfolio {
        color: #925a1f;
        text-decoration: none;
        transition: 0.5s;
    }
</style>