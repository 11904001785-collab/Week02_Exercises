<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$counts = [];

foreach ($requests as $r) {
    if ($r['status'] === 'Submitted' || $r['status'] === 'Under review') {
        $dzongkhag = ucfirst(strtolower(trim($r['dzongkhag'])));

        if (!isset($counts[$dzongkhag])) {
            $counts[$dzongkhag] = 0;
        }

        $counts[$dzongkhag]++;
    }
}

$highest = 0;
$busiest = '';

foreach ($counts as $dzongkhag => $count) {
    if ($count > $highest) {
        $highest = $count;
        $busiest = $dzongkhag;
    }
}

page_header('Busiest Dzongkhag', 'EXERCISE 02');
?>
<div class="card">
    <div class="card-title">
        <h2>Pending Request Summary</h2>
        <span class="badge review"><?= $highest ?> pending</span>
    </div>

    <div class="big-result">
        Busiest: <?= htmlspecialchars($busiest) ?> (<?= $highest ?> pending)
    </div>
</div>

<div class="card">
    <div class="card-title"><h2>Dzongkhag Counts</h2></div>
    <table>
        <tr><th>Dzongkhag</th><th>Pending Requests</th></tr>
        <?php foreach ($counts as $dzongkhag => $count): ?>
            <tr>
                <td><?= htmlspecialchars($dzongkhag) ?></td>
                <td><strong><?= $count ?></strong></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php page_footer(); ?>
