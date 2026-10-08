<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

page_header('Reference Numbers', 'EXERCISE 03');
?>
<div class="card">
    <div class="card-title">
        <h2>Generated B-PIS References</h2>
        <span class="badge approved">2026</span>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Dzongkhag</th>
            <th>Reference</th>
        </tr>
        <?php foreach ($requests as $r): ?>
            <tr>
                <td><?= $r['id'] ?></td>
                <td><?= htmlspecialchars(full_name($r['first'], $r['last'])) ?></td>
                <td><?= htmlspecialchars($r['dzongkhag']) ?></td>
                <td><strong><?= htmlspecialchars(make_reference($r['id'], $r['dzongkhag'], $r['submitted'])) ?></strong></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php page_footer(); ?>
