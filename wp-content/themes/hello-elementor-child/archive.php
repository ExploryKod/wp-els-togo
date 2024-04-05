<!-- Bouton pour ouvrir la modal de filtres -->
<?php
/*
Template Name: Archive Nos Projets
*/

?>
<style>
    .container {
        max-width: 1200px;
        margin: 100px auto;
    }
    /* Style for the modal */
    #modalFiltres {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    /* Style for the close button */
    #modalFiltres #fermerModalFiltres {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    /* Style for the modal content */
    #modalFiltres ul {
        list-style: none;
        padding: 0;
    }

    #modalFiltres ul li {
        margin-bottom: 10px;
    }

    /* Style for the button */
    #ouvrirModalFiltres {
        margin-bottom : 100px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #ouvrirModalFiltres:hover {
        background-color: #0056b3;
    }

    /* -- date -- */

    .booking-form .form-group {
        position: relative;
        margin-bottom: 30px
    }

    .booking-form .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        height: 60px;
        padding: 0px 25px;
        border: none;
        border-radius: 40px;
        color: #fff;
        -webkit-box-shadow: 0px 0px 0px 2px transparent;
        box-shadow: 0px 0px 0px 2px transparent;
        -webkit-transition: 0.2s;
        transition: 0.2s
    }

    .booking-form .form-control::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.5)
    }

    .booking-form .form-control:-ms-input-placeholder {
        color: rgba(255, 255, 255, 0.5)
    }

    .booking-form .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5)
    }

    .booking-form .form-control:focus {
        -webkit-box-shadow: 0px 0px 0px 2px #ff8846;
        box-shadow: 0px 0px 0px 2px #ff8846
    }

    .booking-form input[type="date"].form-control {
        padding-top: 16px
    }

    .booking-form input[type="date"].form-control:invalid {
        color: rgba(255, 255, 255, 0.5)
    }

    .booking-form input[type="date"].form-control+.form-label {
        opacity: 1;
        top: 10px
    }


    .filters-container {
        margin-bottom: 20px;
    }

    .filter {
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .filter label {
        display: block;
        margin-bottom: 5px;
    }

    .filter select,
    .filter input[type="date"] {
        width: 100%;
        padding: 16px 32px;
        border: 1px solid darkblue;
        border-radius: 32px;

    }

    .filter input[type="date"]:active, .filter input[type="date"]:hover, .filter input[type="date"]:focus {
        border: 1px solid darkblue !important;
        border-radius: 32px;
    }

    #filter-button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #filter-button:hover {
        background-color: #0056b3;
    }


</style>
<?php get_header(); ?>

<!-- Bouton pour ouvrir la modal de filtres -->
<button id="ouvrirModalFiltres">
    <i class="fas fa-filter"></i> Filtres
</button>

<!-- Modal pour les filtres -->
<div id="modalFiltres" style="display: none;">
    <button id="fermerModalFiltres">Fermer</button>
    <ul>
        <li><a href="#" class="filter" data-order="ASC" data-categorie="hygiene">Hygiène</a></li>
        <li><a href="#" class="filter"  data-order="ASC" data-categorie="developpement">Développement économique</a></li>
        <!-- Ajoutez d'autres catégories si nécessaire -->
        <li><a href="#" class="filter"  data-order="ASC" data-categorie="sante">Santé</a></li>
        <li><a href="#" class="filter"  data-order="ASC" data-categorie="education">Éducation</a></li>
    </ul>

    <div class="filter">
        <label for="date-du-projet-start">Plage de date :</label>
        <input type="date" name="start-date" class="filter" id="date-du-projet-start" placeholder="Début" value="<?php echo "2024-01-01" ?>">
        <label for="date-du-projet-end">Plage de date :</label>
        <input type="date" name="end-date" class="filter" id="date-du-projet-end" placeholder="Fin" value="<?php echo date('Y-m-d'); ?>">
    </div>
    <button class="filter" data-categorie="hygiene" data-order="DSC">Trier par DSC</button>
    <button class="filter" data-categorie="hygiene" data-order="DSC">Trier par ASC</button>

<!--    <div class="booking-form">-->
<!--        <div class="form-group">-->
<!--            <input class="form-control" type="date" required> <span class="form-label">Check In</span>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <input class="form-control" type="date" required> <span class="form-label">Check out</span>-->
<!--        </div>-->
<!--    </div>-->
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="projects-grid" id="projets-container">
                <!-- Contenu des projets sera affiché ici -->
                <?php
                // WP Query to fetch all projects initially
                $args = array(
                    'post_type' => 'votre-projet',
                    'posts_per_page' => -1,
                    'order' => 'ASC'
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
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
                    echo '<p>Aucun projet trouvé.</p>';
                endif;
                ?>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript pour ouvrir et fermer la modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ouvrirModalFiltres = document.getElementById("ouvrirModalFiltres");
        var modalFiltres = document.getElementById("modalFiltres");
        var fermerModalFiltres = document.getElementById("fermerModalFiltres");

        ouvrirModalFiltres.addEventListener("click", function() {
            modalFiltres.style.display = "block";
        });

        fermerModalFiltres.addEventListener("click", function() {
            modalFiltres.style.display = "none";
        });

        // Filtrer les projets en utilisant Fetch
        document.querySelectorAll("#modalFiltres .filter").forEach(function(link) {
            link.addEventListener("click", function(e) {
                e.preventDefault();

                // Get the value of the clicked filter
                const categorie = this.dataset.categorie;
                const order = this.dataset.order;

                // Get the values of the date inputs
                // const start_date = document.getElementById("date-du-projet-start").value;
                // const end_date = document.getElementById("date-du-projet-end").value;

                // Call the function to filter projects
                filterProjects(categorie, order);
            });
        });

        // // Event listener for date inputs
        // document.querySelectorAll(".filter").forEach(function(input) {
        //     input.addEventListener("change", function(e) {
        //
        //         // Get the values of the date inputs
        //         const start_date = document.getElementById("date-du-projet-start").value;
        //         const end_date = document.getElementById("date-du-projet-end").value;
        //
        //         // Call the function to filter projects
        //         filterProjects(categorie, order, start_date, end_date);
        //     });
        // });

        function filterProjects(categorie, order) {
            fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: new URLSearchParams({
                    action: "filtrer_projets",
                    categorie: categorie,
                    order: order,
                })
            })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("projets-container").innerHTML = data;
                });
        }

    });
</script>

<?php get_footer(); ?>

