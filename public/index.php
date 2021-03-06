<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$dsn = $_ENV['PDO_DSN'] ?? 'sqlite:' . __DIR__ . '/../db.sqlite';
$conn = conn($dsn);

create_todos_table($conn);

if (route_is('POST', '/todos')) {
    create($conn);
}

if (route_is('GET', '/create')) {
    echo render_layout(__DIR__ . '/../templates/create.phtml');
}

if (route_is('GET', '/')) {
    read($conn);
}

if ($route_params = route_match('PUT', '|/todos/(\d+)|')) {
    update(intval($route_params[1]));
}

if ($route_params = route_match('DELETE', '|/todos/(\d+)|')) {
    delete($conn, intval($route_params[1]));
}
