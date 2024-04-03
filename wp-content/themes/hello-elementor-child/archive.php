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
        <li><a href="#" data-categorie="hygiene">Hygiène</a></li>
        <li><a href="#" data-categorie="developpement">Développement économique</a></li>
        <!-- Ajoutez d'autres catégories si nécessaire -->
        <li><a href="#" data-domaine="sante">Santé</a></li>
        <li><a href="#" data-domaine="education">Éducation</a></li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="projects-grid" id="projets-container">
                <!-- Contenu des projets sera affiché ici -->
                <?php
                // Inclure le contenu des projets filtrés
                if (isset($output)) {
                    echo $output;
                } else {
                    // Afficher un message par défaut si aucun projet n'est trouvé
                    echo '<p>Aucun projet trouvé.</p>';
                }
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
        document.querySelectorAll("#modalFiltres a").forEach(function(link) {
            link.addEventListener("click", function(e) {
                e.preventDefault();
                var categorie = this.dataset.categorie;
                var domaine = this.dataset.domaine;
                var remuneration = this.dataset.remuneration;

                fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: new URLSearchParams({
                        action: "filtrer_projets",
                        categorie: categorie,
                        domaine: domaine,
                        remuneration: remuneration
                    })
                })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("projets-container").innerHTML = data;
                    });
            });
        });
    });
</script>

<?php get_footer(); ?>

