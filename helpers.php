<?php
declare(strict_types=1);

function full_name(string $first, string $last): string
{
    return trim($first) . ' ' . trim($last);
}

function is_valid_cid(string $cid): bool
{
    $cid = trim($cid);
    return strlen($cid) === 11 && ctype_digit($cid);
}

function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    } elseif ($days <= 7) {
        return 'On time';
    } elseif ($days <= 14) {
        return 'Follow up';
    }

    return 'Overdue';
}

function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    $dzongkhag = trim($dzongkhag);
    $prefix = strtoupper(substr($dzongkhag, 0, 3));
    $year = substr($submitted, 0, 4);
    $number = sprintf('%04d', $id);

    return "$prefix-$year-$number";
}

function status_class(string $status): string
{
    return match ($status) {
        'Submitted' => 'submitted',
        'Under review' => 'review',
        'Approved' => 'approved',
        'Rejected' => 'rejected',
        default => 'unknown'
    };
}

function page_header(string $title, string $exercise): void
{
    $safeTitle = htmlspecialchars($title);
    $safeExercise = htmlspecialchars($exercise);

    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{$safeExercise} | B-PIS Week 2</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header class="topbar">
            <div class="brand">
                <div class="brand-icon">BP</div>
                <div>
                    <strong>B-PIS</strong>
                    <span>Week 2 Logic Exercises</span>
                </div>
            </div>
            <nav>
                <a href="index.php">Dashboard</a>
                <a href="Exercise01.php">Ex 1</a>
                <a href="Exercise02.php">Ex 2</a>
                <a href="Exercise03.php">Ex 3</a>
                <a href="Exercise04.php">Ex 4</a>
                <a href="Exercise05.php">Ex 5</a>
                <a href="Exercise06.php">Ex 6</a>
                <a href="Exercise07.php">Ex 7</a>
            </nav>
        </header>

        <main class="container">
            <div class="page-heading">
                <div>
                    <p class="eyebrow">ROYAL INSTITUTE OF MANAGEMENT • DIT</p>
                    <h1>{$safeTitle}</h1>
                </div>
                <span class="exercise-badge">{$safeExercise}</span>
            </div>
    HTML;
}

function page_footer(): void
{
    echo <<<HTML
        </main>
        <footer>
            <span>B-PIS Week 2</span>
            <span>Control structures • Arrays • Strings • Functions</span>
        </footer>
    </body>
    </html>
    HTML;
}
