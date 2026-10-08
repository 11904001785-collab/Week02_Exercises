<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$today = '2026-10-07';
$summary = ['Overdue' => 0, 'Follow up' => 0, 'On time' => 0, 'Check date' => 0];

page_header('Waiting-Time Alert', 'EXERCISE 04');
?>
<div class="card">
    <div class="card-title">
        <h2>Pending Requests</h2>
        <span class="badge review">Today: <?= $today ?></span>
    </div>

    <table>
        <tr>
            <th>Request</th>
            <th>Name</th>
            <th>Status</th>
            <th>Days Waited</th>
            <th>Band</th>
        </tr>
        <?php foreach ($requests as $r): ?>
            <?php if ($r['status'] === 'Submitted' || $r['status'] === 'Under review'): ?>
                <?php
                $days = intdiv(strtotime($today) - strtotime($r['submitted']), 86400);
                $band = wait_band($days);
                $summary[$band]++;
                $class = $band === 'Overdue' ? 'danger' : ($band === 'Follow up' ? 'warning' : 'success');
                ?>
                <tr>
                    <td>#<?= $r['id'] ?></td>
                    <td><?= htmlspecialchars(full_name($r['first'], $r['last'])) ?></td>
                    <td><span class="badge <?= status_class($r['status']) ?>"><?= htmlspecialchars($r['status']) ?></span></td>
                    <td><?= $days ?> days</td>
                    <td><span class="badge <?= $class ?>"><?= htmlspecialchars($band) ?></span></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>

<div class="stats">
    <div class="stat"><span class="number"><?= $summary['Overdue'] ?></span><span class="label">Overdue</span></div>
    <div class="stat"><span class="number"><?= $summary['Follow up'] ?></span><span class="label">Follow up</span></div>
    <div class="stat"><span class="number"><?= $summary['On time'] ?></span><span class="label">On time</span></div>
    <div class="stat"><span class="number"><?= $summary['Check date'] ?></span><span class="label">Check date</span></div>
</div>
<?php page_footer(); ?>
