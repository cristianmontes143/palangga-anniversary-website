<?php
/**
 * =========================================================================
 * SAVE LOVE LOCK BACKEND
 * Saves anniversary promises & wishes permanently to data/locks.json
 * =========================================================================
 */

header('Content-Type: application/json; charset=utf-8');

$dataFile = __DIR__ . '/data/locks.json';

// Ensure data folder exists
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0755, true);
}

// Function to safely read locks
function getStoredLocks(string $path): array {
    if (is_file($path)) {
        $content = file_get_contents($path);
        if ($content !== false) {
            $data = json_decode($content, true);
            if (is_array($data)) {
                return $data;
            }
        }
    }
    return [];
}

// Handle GET request: return all locks
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $locks = getStoredLocks($dataFile);
    echo json_encode(['success' => true, 'locks' => $locks]);
    exit;
}

// Handle POST request: save a new lock
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read JSON payload or form POST
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    if (!is_array($input)) {
        $input = $_POST;
    }

    $wish = trim((string)($input['wish'] ?? ''));
    $names = trim((string)($input['names'] ?? 'Me & Palangga'));
    $style = trim((string)($input['style'] ?? 'rose-gold'));

    // Validation
    if ($wish === '') {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Wish or promise cannot be empty.']);
        exit;
    }

    // Sanitize string lengths
    $wish = mb_substr($wish, 0, 120);
    $names = mb_substr($names, 0, 40);
    if ($names === '') {
        $names = 'Me & Palangga';
    }

    $allowedStyles = ['rose-gold', 'golden-sun', 'ruby-passion', 'lavender-dream'];
    if (!in_array($style, $allowedStyles, true)) {
        $style = 'rose-gold';
    }

    // Construct new lock
    $newLock = [
        'id' => (int)(microtime(true) * 1000),
        'names' => $names,
        'wish' => $wish,
        'style' => $style,
        'date' => date('M j, Y')
    ];

    // Read current locks and append
    $locks = getStoredLocks($dataFile);
    $locks[] = $newLock;

    // Write atomically with lock
    $saved = file_put_contents(
        $dataFile,
        json_encode($locks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    if ($saved === false) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Could not write to server storage.']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Lock saved permanently to server!',
        'lock' => $newLock,
        'total' => count($locks)
    ]);
    exit;
}

// Invalid method
http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
exit;
