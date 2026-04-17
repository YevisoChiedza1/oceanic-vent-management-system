<?php
/**
 * Hydrothermal Vent Database - Home Page
 */

require_once 'includes/db.php';

$pageTitle = 'All Vents';
$pdo = getDbConnection();

// 1. Initialize variables and SQL
$params = [];
$query = "SELECT id, name, location, type, depth_metres, discovery_year FROM vents";
$conditions = [];

// Check if search form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['by_name'] ?? '');
    $location = trim($_POST['by_location'] ?? '');
    $type = trim($_POST['by_type'] ?? '');
    $depth = trim($_POST['by_depth'] ?? '');
    $discovery_year = trim($_POST['by_discovery_year'] ?? '');

    if (!empty($name)) {
        $conditions[] = "name LIKE :name";
        $params[':name'] = "%$name%";
    }
    if (!empty($location)) {
        $conditions[] = "location LIKE :location";
        $params[':location'] = "%$location%";
    }
    if (!empty($type)) {
        $conditions[] = "type = :type";
        $params[':type'] = $type;
    }
    
    if (!empty($depth)) {
        $conditions[] = "depth_metres = :depth";
        $params[':depth'] = (int)$depth;
    }
    
    if (!empty($discovery_year)) {
        $conditions[] = "discovery_year = :discovery_year";
        $params[':discovery_year'] = (int)$discovery_year;
    }
}

// Construct SQL
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY name";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$vents = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<h2 id="heading">Hydrothermal Vents</h2>

<p id = "intro" >Explore our database of hydrothermal vents from the Western Pacific region.</p>

<form id="search-form" action="" method="post">
    <div class="filter-container">
        <div>
            <label>Name:</label>
            <input type="text" name="by_name" placeholder="e.g Lao Basin" value="<?php echo htmlspecialchars($_POST['by_name'] ?? ''); ?>">
        </div>
        <div>
            <label>Location:</label>
            <input type="text" name="by_location" placeholder="e.g Southwest..." value="<?php echo htmlspecialchars($_POST['by_location'] ?? ''); ?>">
        </div>
        <div>
            <label>Type:</label>
            <input type="text" name="by_type" placeholder="e.g Volcanic arc" value="<?php echo htmlspecialchars($_POST['by_type'] ?? ''); ?>">
        </div>
        <div>
            <label>Max Depth:</label>
            <input type="number" name="by_depth" placeholder="1600" value="<?php echo htmlspecialchars($_POST['by_depth'] ?? ''); ?>">
        </div>
        <div>
            <label>Year:</label>
            <input type="number" name="by_discovery_year" placeholder="1988" value="<?php echo htmlspecialchars($_POST['by_discovery_year'] ?? ''); ?>">
        </div>
        
        <div class="button-group">
            <input class="button" type="submit" value="Filter">
            <a href="index.php" class="button">Reset</a>
        </div>
    </div>
</form>

<?php if (empty($vents)): ?>
    <p>No vents found matching those criteria.</p>
<?php else: ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Depth (m)</th>
                    <th>Discovered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vents as $vent): ?>
                    <tr>
                        <td><?php echo e($vent['name']); ?></td>
                        <td><?php echo e($vent['location']); ?></td>
                        <td><?php echo e($vent['type']); ?></td>
                        <td><?php echo e($vent['depth_metres']); ?></td>
                        <td><?php echo e($vent['discovery_year']); ?></td>
                        <td><a href="vent.php?id=<?php echo e($vent['id']); ?>">View Details</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>