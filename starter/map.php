<?php
/**
 * Hydrothermal Vent Database - Map Page
 * Displays a static map of vent locations
 */

require_once 'includes/db.php'; 
$pageTitle = 'Vent Locations Map';

require_once 'includes/header.php';
?>

<main class="container">
    <section class="map-section">
        <h2 id="heading">Global Vent Distribution</h2>
        <p id="intro">This map illustrates the known hydrothermal vent fields along tectonic plate boundaries.</p>

        <figure class="map-container">
            <img src="images/vent-map.png" alt="Map showing global hydrothermal vent locations" class="responsive-map">
            <figcaption>
                Source: <a href="https://minnstate.pressbooks.pub/app/uploads/sites/87/2023/09/Distribution_of_hydrothermal_vent_fields-1024x608.png" target="_blank">NOAA/Wikimedia Commons</a>. 
                Licensed under Public Domain.
            </figcaption>
        </figure>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>