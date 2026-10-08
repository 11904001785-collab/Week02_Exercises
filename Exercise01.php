<?php
declare(strict_types=1);
require_once __DIR__ . '/helpers.php';

page_header('Predict Output', 'EXERCISE 01');
?>

<div class="grid">
    <div class="card">
        <div class="card-title"><h2>A — ?: and ??</h2></div>
        <?php
        $x = 0;
        $label = $x ?: 'none';
        $size = $x ?? 'none';
        ?>
        <div class="code-result"><?= htmlspecialchars("$label | $size") ?></div>
        <p class="muted">The shorthand OR operator treats 0 as false; the null-coalescing operator only checks for null/missing values.</p>
    </div>

    <div class="card">
        <div class="card-title"><h2>B — continue and break</h2></div>
        <?php
        $total = 0;
        for ($i = 1; $i <= 10; $i++) {
            if ($i % 3 === 0) continue;
            if ($i > 7) break;
            $total += $i;
        }
        ?>
        <div class="big-result"><?= $total ?></div>
        <p class="muted">Multiples of 3 are skipped and the loop stops once the value becomes greater than 7.</p>
    </div>

    <div class="card">
        <div class="card-title"><h2>C — foreach and ternary</h2></div>
        <?php
        $m = ['b' => 2, 'a' => 1, 'c' => 3];
        $out = '';
        foreach ($m as $k => $v) {
            $up = $v > 1;
            $out .= $up ? strtoupper($k) : $k;
        }
        ?>
        <div class="code-result"><?= htmlspecialchars($out) ?></div>
        <p class="muted">Keys whose value is greater than 1 are converted to uppercase.</p>
    </div>

    <div class="card">
        <div class="card-title"><h2>D — strlen and substr</h2></div>
        <?php $n = strlen(trim(' Paro ')); ?>
        <div class="big-result"><?= $n . substr('Paro', -2) ?></div>
        <p class="muted">trim() removes the spaces, strlen() counts the remaining characters, and substr(..., -2) gets the last two.</p>
    </div>
</div>

<?php page_footer(); ?>
