<?php
class Page
{
    private $header = '';
    private $footer = '';
    private $corps = '';

    // Constructeur
    public function __construct($show_interface = true, $title = '', $link = array())
    {
        if ($show_interface) {
            $this->build_header($title, $link);
            $this->build_footer();
        } else {
            $this->header = '<body>';
            $this->footer = '</body>';
        }
    }

    public function build_content($html = '')
    {
        $this->corps = $html;
    }

    public function show()
    {
        echo $this->header;
        echo $this->corps;
        echo $this->footer;
    }

    private function build_header($title, $link)
    {
        $this->header = '<body>';
        $this->header .= '   <div class="header">';
        $this->header .= '       <img src="pic/logo.png" class="logo_site"/><br/>';


        // Accueil
        $this->header .= '       <a href="index.php">';
        $this->header .= '           <img src="pic/home.png" /><br/>Accueil';
        $this->header .= '       </a>';


        // Galerie
        $this->header .= '       <a href="index.php?page=galerie">';
        $this->header .= '           <img src="pic/galerie.png" /><br/>Galerie';
        $this->header .= '       </a>';

        // email
        $this->header .= '       <a href="index.php?page=listing_mail">';
        $this->header .= '           <img src="pic/mail.png" /><br/>Email';
        $this->header .= '       </a>';

        // Gestion Utilisateur
        $this->header .= '       <a href="index.php?page=listing_user">';
        $this->header .= '           <img src="pic/user.png" /><br/>Utilisateur';
        $this->header .= '       </a>';




        $this->header .= '   </div>';
        $this->header .= '   <div class="header_top">';
        $this->header .= '       <div class="header_login">';
        $this->header .= '           <div class="header_logout_btn">';
        $this->header .= '               <a href="index.php?page=logout">';
        $this->header .= '                   <img src="./pic/logout.png" />';
        $this->header .= '               </a>';
        $this->header .= '           </div>';
        $this->header .= '           <div class="header_info_user">';
        $this->header .= '               ' . $_SESSION[SESSION_NAME]['nom_user'];
        if (is_file($_SESSION[SESSION_NAME]['avatar']))
            $this->header .= '               <img src="' . $_SESSION[SESSION_NAME]['avatar'] . '" />';
        $this->header .= '           </div>';
        $this->header .= '       </div>';
        $this->header .= '       <div class="header_title">' . $title . '</div>';
        $this->header .= '       <div class="header_link">';
        foreach ($link as $data_link) {
            $this->header .= '           <div class="one_link">';
            $this->header .= '               <a href="' . $data_link['url'] . '">';
            $this->header .= '                   <img src="./pic/' . $data_link['image'] . '" /><br/>' . $data_link['text'];
            $this->header .= '               </a>';
            $this->header .= '           </div>';
        }
        $this->header .= '       </div>';
        $this->header .= '   </div>';
    }

    private function build_footer()
    {
        $this->footer = '</body>';
    }
}
