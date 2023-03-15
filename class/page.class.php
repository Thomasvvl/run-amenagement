<?php
class Page
{
    private $header = '';
    private $footer = '';
    private $corps = '';

    // Constructeur
    public function __construct($show_interface = true)
    {
        if ($show_interface) {
            $this->build_header();
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

    private function build_header()
    {
        $dataBDD = data::getInstance();

        $this->header = '<body>';
    }

    private function build_footer()
    {


        $this->footer = '<footer>';
        $this->footer .= '  <div class="footer-bottom">';
        $this->footer .= '   © 2022 Run Aménagement | <a class="mention" href="#"> Mentions Legales </a> | Designed & Developed By';
        $this->footer .= '      <a class="portfolio" ';
        $this->footer .= '          href="https://github.com/Thomasvvl">ThomasVvl ';
        $this->footer .= '      </a> ';
        $this->footer .= '  </div>';
        $this->footer .= '</footer>';


        $this->footer .= '</body>';
    }

    private function getCleanURL($id_menu)
    {
        $dataBDD = data::getInstance();
        $table = array(
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r', '.' => '_', '?' => '_', '!' => '_', '°' => '_', ' ' => '_', '-' => '_', '"' => '_',
            "'" => '_', '#' => '_'
        );

        $sql = "SELECT titre FROM t_menu WHERE id=" . $id_menu;
        $titre_menu = $dataBDD->squery($sql);
        $titre_site = 'ifr';
        $titre_menu = strtr($titre_menu, $table);

        $url = $titre_site . '_' . $titre_menu . '-' . $id_menu . '-0.html';
        return $url;
    }
}
