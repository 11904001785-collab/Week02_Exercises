<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$grouped = [];

foreach ($requests as $r) {
    $cid = $r['cid'];

    if (!isset($grouped[$cid])) {
        $grouped[$cid] = [];
    }

    $grouped[$cid][] = $r['id'];
}

$duplicates = [];
$invalid = [];

foreach ($grouped as $cid => $ids) {
    if (count($ids) > 1) {
        $duplicates[$cid] = $ids;
    }
}

foreach ($requests as $r) {
    if (!is_valid_cid($r['cid'])) {
        $invalid[] = $r;
    }
}

page_header('Duplicate CIDs', 'EXERCISE 07');
?>

<div class="stats">
    <div class="stat">
        <span class="number"><?= count($duplicates) ?></span>
        <span class="label">Duplicate CIDs</span>
    </div>
    <div class="stat">
        <span class="number"><?= count($invalid) ?></span>
        <span class="label">Invalid CIDs</span>
    </div>
    <div class="stat">
        <span class="number"><?= count($requests) ?></span>
        <span class="label">Total Requests</span>
    </div>
    <div class="stat">
        <span class="number"><?= count($grouped) ?></span>
        <span class="label">Unique CID Values</span>
    </div>
</div>

<div class="grid">
    <div class="card">
        <div class="card-title"><h2>Duplicate CIDs</h2></div>

        <?php if (!$duplicates): ?>
            <div class="result success">No duplicate CIDs found.</div>
        <?php else: ?>
            <?php foreach ($duplicates as $cid => $ids): ?>
                <div class="result warning">
                    <strong>Duplicate <?= htmlspecialchars($cid) ?></strong><br>
                    Requests: <?= htmlspecialchars(implode(', ', $ids)) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-title"><h2>Invalid CIDs</h2></div>

        <?php if (!$invalid): ?>
            <div class="result success">All CIDs are valid.</div>
        <?php else: ?>
            <?php foreach ($invalid as $r): ?>
                <div class="result danger">
                    <strong>Request #<?= $r['id'] ?></strong><br>
                    <?= htmlspecialchars($r['cid']) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <h2>CID Validation Rule</h2>
        <span class="badge review">11 digits</span>
    </div>
    <p class="muted">
        A CID is considered valid here when it contains exactly 11 numeric digits.
    </p>
</div>

<?php page_footer(); ?>
