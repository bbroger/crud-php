<?php declare(strict_types=1);

function create(PDO $pdo)
{
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $stmt = $pdo->prepare('insert into todos (title) values (:title)');
    $stmt->execute(['title' => $title]);

    echo render(__DIR__ . '/../templates/ok.phtml');
}

function read(PDO $pdo)
{
    $stmt = $pdo->query('select * from todos');
    $todos = $stmt->fetchAll();
    echo render(__DIR__ . '/../templates/index.phtml', ['todos' => $todos]);
}

function update(int $id)
{
    echo "Hello, $id";
}

function delete(int $id)
{
    echo "Hello, $id";
}

function migrations(PDO $pdo)
{
    $pdo->exec('
        create table if not exists todos (
            id integer not null primary key autoincrement,
            title varchar not null,
            done bool not null default false,
            created_at datetime not null default current_timestamp
        )
    ');
}
