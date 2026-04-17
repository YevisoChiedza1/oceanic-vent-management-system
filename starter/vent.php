<?php
/**
 * Hydrothermal Vent Database - Single Vent Page
 * Displays details of a single vent
 *
 * SET08101 Web Technologies Coursework Starter Code
 */

require_once 'includes/db.php';

// Validate the vent ID parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$ventId = (int)$_GET['id'];
$pdo = getDbConnection();

// Fetch the vent details
$stmt = $pdo->prepare('SELECT id, name, location, type, depth_metres, discovery_year FROM vents WHERE id = ?');
$stmt->execute([$ventId]);
$vent = $stmt->fetch();

// If vent not found, redirect to home
if (!$vent) {
    header('Location: index.php');
    exit;
}

// Fetch fauna associated with this vent
$stmtFauna = $pdo->prepare(
    'SELECT f.name, f.scientific_name 
     FROM fauna f
     JOIN vents v ON f.vent_id = v.id
     WHERE v.id = ?'
);
$stmtFauna->execute([$ventId]);
$fauna = $stmtFauna->fetchAll();



$pageTitle = $vent['name'];

require_once 'includes/header.php';
?>

<div class="vent-container">

    <p class="back-link"><a href="index.php">&larr; Back to all vents</a></p>

    <div class="vent-card">
        <h2><?php echo e($vent['name']); ?></h2>

        <dl class="vent-details">
            <div>
                <dt>Location</dt>
                <dd><?php echo e($vent['location']); ?></dd>
            </div>

            <div>
                <dt>Type</dt>
                <dd><?php echo e($vent['type']); ?></dd>
            </div>

            <div>
                <dt>Depth</dt>
                <dd><?php echo e($vent['depth_metres']); ?> metres</dd>
            </div>

            <div>
                <dt>Discovery Year</dt>
                <dd><?php echo e($vent['discovery_year']); ?></dd>
            </div>
        </dl>
    </div>

    <div class="fauna-card">
        <h3>Associated Fauna</h3>

        <?php if (empty($fauna)): ?>
            <p>No fauna recorded for this vent.</p>
        <?php else: ?>
            <ul class="fauna-list">
                <?php foreach ($fauna as $creature): ?>
                    <li>
                        <strong><?php echo e($creature['name']); ?></strong><br>
                        <span><?php echo e($creature['scientific_name']); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
