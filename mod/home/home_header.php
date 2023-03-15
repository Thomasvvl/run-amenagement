<?php

require_once('param/param.php');

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    try {
        $pdo = new PDO("mysql:host=" . DATABASE_IP . ";dbname=" . DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":subject", $subject);
        $stmt->bindParam(":message", $message);

        $stmt->execute();

        $_SESSION['message'] = "Données envoyées avec succès";
        header('location:index.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $pdo = null;
}


// Barre de navigation

$html .= '  <div class="nav-item">';
$html .= '    <a class="navbar-item" href="index.php?page=home">ACCUEIL</a>';
$html .= '    <a class="navbar-item" href="#apropos">A Propos</a>';
$html .= '    <a class="navbar-item" href="#projectsSection">Nos Projets</a>';
$html .= '    <a class="navbar-item" href="#formulaire">Contact</a>';
$html .= '  </div>';
$html .= '  <div class="navbar-burger">';
$html .= '    <span></span>';
$html .= '    <span></span>';
$html .= '    <span></span>';
$html .= '  </div>';
$html .= '</nav>';


//PAGE ACCUEIL

$html .= '<header>';
$html .= '  <div class="container-lg">';
$html .= '    <div class="row">';
$html .= '      <div class="col-lg-5 col-md-6 order-2 order-md-1">';
$html .= '        <div class="content">';
$html .= '          <h1>Run <br><span>Aménagement</span></h1>';
// Bouton en savoir plus
$html .= '          <a href="#apropos" class="btn btnPublic">En savoir plus</a>';
$html .= '        </div>';
$html .= '      </div>';
$html .= '    </div>';
$html .= '  </div>';
// Bouton qui revoie vers la page Apropos
$html .= '  <div id="cercle">';
$html .= '      <a href="#apropos" class="rond">';
$html .= '        <img class="rond" src="./css/img/arrowbas.png" alt="Descendre">';
$html .= '      </a>';
$html .= '    </div>';
$html .= '</header>';

//PAGE A PROPOS

$html .= ' <section id="apropos">';
$html .= '  <div class="aluminium">';
$html .= '    <div class="box">';
$html .= '      <div class="carré-content">';
$html .= '        <div class="titre">';
$html .= '          <h1>A propos de nous...</h1>';
$html .= '          <p>A propos de nous... Run Aménagement, votre expert en aménagement intérieur et extérieur depuis 2013. Nous sommes spécialisés dans la création de cuisines, dressings, salles de bain et placards sur mesure pour répondre à toutes vos exigences en matière de design et de fonctionnalité. Faites confiance à notre expérience et notre savoir-faire pour transformer votre maison en un espace de vie à votre image.</p>';
$html .= '          <a href = "#projectsSection" class = "btn btnProjet" >Nos projets </a> ';
$html .= '         </div> ';
$html .= '       </div> ';
$html .= '       <div class="carré-map">';
$html .= '        <div class="map">';
$html .= '           <img src = "./css/img/map.webp" alt="Map">';
$html .= '        </div>';
$html .= '      </div> ';
$html .= '    </div> ';
$html .= '  </div> ';


//PAGE PROJETS
$html .= '<section id="projectsSection">';
$html .= '    <div class="mainContainer">';
$html .= '        <div class="projects">';
$html .= '            <h1>Faites de votre maison un lieu unique avec des designs sur mesure !</h1>';
$html .= '            <h4>En voici quelques exemples</h4>';
$html .= '            <div class="swiper mySwiper">';
$html .= '                <div class="swiper-wrapper">';
$html .= '                    <div class="swiper-slide project">';
$html .= '                        <div class="project--header">';
$html .= '                            <i> <img src="./css/img/logo.png" alt="Logo"> </i>';
$html .= '                        </div>';
$html .= '                        <a href="index.php?page=cuisine">';
$html .= '                            <img src="./css/img/cuis.webp" alt="cuisine" class="project--img" />';
$html .= '                        </a>';
$html .= '                        <h2 class="project--title">Cuisine</h2>';
$html .= '                    </div>';


$html .= '                    <div class="swiper-slide project">';
$html .= '                      <div class="project--header">';
$html .= '                        <i> <img src="./css/img/logo.png" alt="Logo"> </i>';
$html .= '                      </div>';
$html .= '                      <a href="index.php?page=dressing">';
$html .= '                        <img src="./css/img/dres.webp" alt="dressing" class="project--img" />';
$html .= '                      </a>';
$html .= '                      <h2 class="project--title">Dressing</h2>';
$html .= '                    </div>';

$html .= '                    <div class="swiper-slide project">';
$html .= '                      <div class="project--header">';
$html .= '                        <i> <img src="./css/img/logo.png" alt="Logo"> </i>';
$html .= '                      </div>';
$html .= '                      <a href="index.php?page=sdb">';
$html .= '                        <img src="./css/img/SDB.png" alt="SDB" class="project--img" />';
$html .= '                      </a>';
$html .= '                      <h2 class="project--title">Salle De Bain</h2>';
$html .= '                    </div>';

$html .= '                    <div class="swiper-slide project">';
$html .= '                      <div class="project--header">';
$html .= '                        <i> <img src="./css/img/logo.png" alt="Logo"> </i>';
$html .= '                      </div>';
$html .= '                      <a href="index.php?page=portail">';
$html .= '                          <img src="./css/img/portail.png" alt="portail" class="project--img" />';
$html .= '                      </a>';
$html .= '                      <h2 class="project--title">Portail</h2>';

$html .= '                   </div>';
$html .= '                </div>';
$html .= '            </div>';
$html .= '        </div>';
$html .= '    </div>';
$html .= '    <div class="swiperButton--container">';
$html .= '        <i class="fas fa-arrow-left" id="swiper-button-prev"></i>';
$html .= '        <i class="fas fa-arrow-right" id="swiper-button-next"></i>';
$html .= '    </div>';
$html .= '</section>';



//PAGE FORMULAIRE


$html .= '<section id="formulaire">';
$html .= '  <div class="back">';
$html .= '    <div class="logoRun"></div>';
$html .= '    <div class="contactContainer">';
$html .= '      <div class="rect">';
$html .= '        <div class="icon">';
$html .= '          <div class="tel">';
$html .= '            <img src="./css/img/phonewhite.png" alt="Télephone">';
$html .= '            <h1>APPELEZ-NOUS</h1><br>';
$html .= '            <p>+262 2 62 13 25 55</p>';
$html .= '          </div>';
$html .= '          <div class="tel">';
$html .= '            <img src="./css/img/mailwhite.png" alt="Mail">';
$html .= '            <h1>Envoyez-nous un email</h1><br>';
$html .= '            <p>run.amenagement@gmail.com</p>';
$html .= '          </div>';
$html .= '          <div class="tel">';
$html .= '            <img src="./css/img/location.png" alt="Location">';
$html .= '            <h1>Emplacement</h1><br>';
$html .= '            <p>156 Rue Hubert Delisle, La Rivière, Saint-Louis, La Réunion</p>';
$html .= '          </div>';
$html .= '        </div>';
$html .= '      </div>';


$html .= '<form action="index.php?page=home" method="post">';

$html .= '      <div class="contactForm">';
$html .= '        <div class="titreForm">';
$html .= '          <h2>Nous Contacter</h2>';
$html .= '        </div>';
$html .= '        <div class="formBox">';
$html .= '          <div class="inputBox w50">';
$html .= '            <input type="text" name="name" required>';
$html .= '            <span>Entrer votre nom</span>';
$html .= '          </div>';
$html .= '          <div class="inputBox w50">';
$html .= '            <input type="text" name="email" required>';
$html .= '            <span>Entrer une adresse mail valide</span>';
$html .= '          </div>';
$html .= '          <div class="inputBox w50">';
$html .= '            <input type="text" name="subject" required>';
$html .= '            <span>Veuillez nous indiquer l\'objet de votre demande</span>';
$html .= '          </div>';
$html .= '          <div class="inputBox w50">';
$html .= '            <textarea name="message" required></textarea>';
$html .= '            <span>Entrer votre message </span>';
$html .= '          </div>';
$html .= '          <div class="inputBox w100">';
$html .= '            <input type="submit" value="Envoyer">';
$html .= '          </div>';
$html .= '        </div>';
$html .= '      </div>';
$html .= '    </div>';
$html .= '  </div>';

$html .= '</form>';


$html .= '</section>';
