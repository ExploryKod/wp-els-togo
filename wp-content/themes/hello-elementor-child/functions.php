<?php
// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

add_action( 'wp_enqueue_scripts', 'els_enqueue_styles' );
function els_enqueue_styles(){
    wp_enqueue_style( 'elementor', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'elementor-child', get_stylesheet_directory_uri() . '/style.css' );
}

function enqueue_archive_styles() {
    // Enqueue the CSS file for the archive.php template
    wp_enqueue_style('archive-styles', get_stylesheet_directory_uri() . '/archive-styles.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_archive_styles');

// Fonction pour filtrer les projets en utilisant AJAX
add_action('wp_ajax_filtrer_projets', 'filtrer_projets');
add_action('wp_ajax_nopriv_filtrer_projets', 'filtrer_projets');

function filtrer_projets() {
    $args = array(
        'post_type' => 'votre-projet',
        'posts_per_page' => -1,
    );

    // Filtrer par catégorie si elle est définie
//    if (isset($_POST['categorie'])) {
//        $args['tax_query'][] = array(
//            'taxonomy' => 'categorie-du-projet',
//            'field'    => 'slug',
//            'terms'    => $_POST['categorie'],
//        );
//    }

    // Filtrer par catégorie si elle est définie
    if (isset($_POST['categorie'])) {
        $args['meta_query'][] = array(
            'key' => 'categorie', // Remplacez 'nom_de_votre_champ_acf' par le nom de votre champ ACF
            'value' => $_POST['categorie'],
            'compare' => '=',
        );
    }

    // Exécuter la requête pour récupérer les projets
    $query = new WP_Query($args);

    ob_start(); // Commencer la mise en mémoire tampon de sortie

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Afficher les informations de chaque projet
            ?>
            <div class="project">
                <h2><?php the_title(); ?></h2>
                <div class="project-content">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        // Aucun projet trouvé
        echo '<h2>Aucun projet trouvé.</h2>';
    endif;

    $output = ob_get_clean(); // Récupérer le contenu du tampon et vider le tampon
    echo $output;
    // Assurez-vous d'arrêter l'exécution de WordPress après la sortie
    wp_die();
}

