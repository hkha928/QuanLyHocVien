<?php
function dd(...$input)
{
    echo "<pre style='text-align: left !important; background-color: #f5f5f5; padding: 10px; border: 1px solid #ccc; border-radius: 5px; over-flow:auto'>";
    if (count($input) > 1) {
        foreach ($input as $index => $item) {
            $random_color = '#' . substr(md5(rand()), 0, 6);
            echo "<strong style='color:{$random_color}'>Input {$index}:</strong><br>";
            print_r($item);
            echo "<br><br>";
        }
    } else {
        //Kiem tra có phai la cau sql khong
        $is_sql = false;
        $sqlKeywords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'FROM', 'WHERE', 'AND', 'OR', 'JOIN', 'GROUP BY', 'ORDER BY', 'LIMIT'];
        if (is_string($input[0])) {
            foreach ($sqlKeywords as $keyword) {
                if (stripos($input[0], $keyword) !== false) {
                    $is_sql = true;
                }
            }

            if ($is_sql == true) {
                $keywords = ['SELECT', 'FROM', 'LEFT JOIN', 'INNER JOIN', 'RIGHT JOIN', 'WHERE', 'GROUP BY', 'ORDER BY', 'LIMIT'];
                foreach ($keywords as $keyword) {
                    $input[0] = str_replace($keyword, "\n<strong>{$keyword}</strong>", $input[0]);
                }
                echo $input[0];
            } else {
                print_r($input[0]);
            }
        } else {
            print_r($input[0]);
        }
    }
    echo "</pre>";
    die;
}

require_once('connection.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'pages';
    $action = 'home';
}
require_once('routes.php');
