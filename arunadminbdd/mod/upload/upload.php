<?php
    $link = array(
        array(
            'image'=>'galerie.png',
            'text'=>'Listing<br/>Galerie',
            'url'=>'index.php?page=galerie',
        ),
        array(
            'image'=>'upload.png',
            'text'=>'Upload<br/>Image',
            'url'=>'index.php?page=upload',
        ),

    );
    $ma_page = new Page(true, 'Gestion de la Galerie', $link);
    $ma_page->build_content($html);
    $ma_page->show();
