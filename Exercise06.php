<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

function count_pending(array $requests): int
{
    $total = 0;

    for ($i = 0; $i < count($requests); $i++) {
        $status = $requests[$i]['status'];

        if ($status === 'Submitted' || $status === 'Under review') {
            $total++;
        }
    }

    return $total;
}

$total = count_pending($requests);

page_header('Find the Bugs', 'EXERCISE 06');
?>
<div class="card">
    <div class="card-title">
        <h2>Corrected Pending Counter</h2>
        <span class="badge approved">Debugged</span>
    </div>

    <div class="big-result"><?= $total ?> pending requests</div>
</div>

<div class="card">
    <div class="card-title"><h2>Five Bugs Fixed</h2></div>
    <div class="grid">
        <div class="result danger"><strong>1.</strong> Loop started at 1 instead of 0.</div>
        <div class="result danger"><strong>2.</strong> Used <code>Status</code> instead of <code>status</code>.</div>
        <div class="result danger"><strong>3.</strong> Used <code>=</code> instead of <code>===</code>.</div>
        <div class="result danger"><strong>4.</strong> Used <code>$total + 1</code> instead of <code>$total++</code>.</div>
        <div class="result danger"><strong>5.</strong> Function was missing <code>return $total;</code>.</div>
    </div>
</div>
<?php page_footer(); ?>
