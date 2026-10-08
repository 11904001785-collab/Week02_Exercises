<?php
declare(strict_types=1);
require_once __DIR__ . '/helpers.php';

$rules = [
    'Submitted' => ['Under review'],
    'Under review' => ['Approved', 'Rejected'],
    'Rejected' => ['Submitted'],
    'Approved' => []
];

function can_move(string $from, string $to): bool
{
    global $rules;
    $allowed = $rules[$from] ?? [];
    return in_array($to, $allowed, true);
}

function can_move_as(string $role, string $from, string $to): bool
{
    if (!can_move($from, $to)) {
        return false;
    }

    $permissions = [
        'officer' => ['Under review'],
        'approver' => ['Approved', 'Rejected'],
        'requester' => ['Submitted']
    ];

    $allowed = $permissions[$role] ?? [];
    return in_array($to, $allowed, true);
}

$tests = [
    ['Submitted', 'Under review'],
    ['Submitted', 'Approved'],
    ['Under review', 'Rejected'],
    ['Approved', 'Submitted'],
    ['Rejected', 'Submitted'],
    ['Closed', 'Submitted']
];

page_header('Status Rules', 'EXERCISE 05');
?>
<div class="card">
    <div class="card-title"><h2>Allowed Status Transitions</h2></div>
    <div class="grid">
        <?php foreach ($tests as [$from, $to]): ?>
            <?php $allowed = can_move($from, $to); ?>
            <div class="result <?= $allowed ? 'success' : 'danger' ?>">
                <strong><?= htmlspecialchars($from) ?></strong>
                <span class="muted"> → </span>
                <strong><?= htmlspecialchars($to) ?></strong>
                <div class="check <?= $allowed ? 'allowed' : 'blocked' ?>">
                    <?= $allowed ? 'Allowed' : 'Blocked' ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="card">
    <div class="card-title"><h2>Role-Based Checks</h2></div>
    <table>
        <tr><th>Role</th><th>Move</th><th>Result</th></tr>
        <?php
        $roleTests = [
            ['officer', 'Under review', 'Approved'],
            ['approver', 'Under review', 'Approved'],
            ['requester', 'Rejected', 'Submitted']
        ];
        foreach ($roleTests as [$role, $from, $to]):
            $allowed = can_move_as($role, $from, $to);
        ?>
            <tr>
                <td><?= htmlspecialchars($role) ?></td>
                <td><?= htmlspecialchars("$from → $to") ?></td>
                <td><span class="badge <?= $allowed ? 'approved' : 'rejected' ?>"><?= $allowed ? 'Allowed' : 'Blocked' ?></span></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php page_footer(); ?>
