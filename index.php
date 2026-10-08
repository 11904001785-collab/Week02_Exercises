<?php
require_once __DIR__ . '/helpers.php';
page_header('Week 2 Logic Dashboard', 'HOME');
?>
<div class="card">
    <div class="card-title">
        <div>
            <h2>B-PIS Request Processing</h2>
            <p class="muted">Select an exercise below to view the styled output.</p>
        </div>
    </div>

    <div class="home-grid">
        <?php
        $items = [
            [1, 'Predict Output', 'Practice ?:, ??, loops, arrays and strings.', 'Exercise01.php'],
            [2, 'Busiest Dzongkhag', 'Count pending requests by Dzongkhag.', 'Exercise02.php'],
            [3, 'Reference Numbers', 'Generate formatted B-PIS references.', 'Exercise03.php'],
            [4, 'Waiting-Time Alert', 'Calculate waiting days and alert bands.', 'Exercise04.php'],
            [5, 'Status Rules', 'Check valid request status transitions.', 'Exercise05.php'],
            [6, 'Find the Bugs', 'Debug a pending-request counter.', 'Exercise06.php'],
            [7, 'Duplicate CIDs', 'Find duplicate and invalid CIDs.', 'Exercise07.php'],
        ];
        foreach ($items as [$number, $title, $desc, $file]):
        ?>
            <a class="card exercise-link" href="<?= $file ?>">
                <div class="exercise-number">Exercise <?= $number ?></div>
                <h2><?= htmlspecialchars($title) ?></h2>
                <p class="muted"><?= htmlspecialchars($desc) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?php page_footer(); ?>
