<?php ## Различные флаги preg_match_all()
        header("Content-type: text/plain");
        // setlocale(LC_ALL, "ru_RU.UTF-8");
        // mb_internal_encoding ("utf-8");

        $flags = [
            // "PREG_PATTERN_ORDER",
            // "PREG_SET_ORDER",
            "PREG_SET_ORDER|PREG_OFFSET_CAPTURE",
        ];
        $re = '|<(\w+).*?>(.*?)</\1>|su';
        $text = "<b>текст</b> и еще <i>другой текст</i>";

        echo "Строка: $text\n";
        echo "Выражение: $re\n\n";

        foreach ($flags as $name) {
            preg_match_all($re, $text, $mathces, eval("return $name;"));
            echo "Флаг $name:\n"; 
            print_r($mathces);
            echo "\n";
        }
?> 

<!-- Результат:
Строка: <b>текст</b> и еще <i>другой текст</i>
Выражение: |<(\w+).*?>(.*?)</\1>|su

Флаг PREG_SET_ORDER|PREG_OFFSET_CAPTURE:
Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => <b>текст</b>
                    [1] => 0
                )
            [1] => Array
                (
                    [0] => b
                    [1] => 1
                )
            [2] => Array
                (
                    [0] => текст
                    [1] => 3 <- Верная позиция, но лишь по тому, что в начале шли однобайтовые символы
                )
        )

    [1] => Array
        (
            [0] => Array
                (
                    [0] => <i>другой текст</i>
                    [1] => 28   <- Не верная позиция !
                )
            [1] => Array
                (
                    [0] => i
                    [1] => 29   <- Не верная позиция !
                )
            [2] => Array
                (
                    [0] => другой текст
                    [1] => 31   <- Не верная позиция !
                )
        )
) -->