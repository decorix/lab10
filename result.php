<?php
$str = $_POST['message'];
$countSymvol = 0; // количество символов
$countLetter = 0; // количество букв
$countUpper = 0; // количество букв верхнего регистра
$countLow = 0; // количество букв нижнего регистра
$countMarks = 0; // количество знаков препинания
$countNumber = 0; // количество цифр
$countWord = 0; // количество слов
$countEntry = 0; // количество вхождений
$list;
$list2;
$list3;
$count = 0;
$array1 = [
	'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 
	'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 
	'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 
	'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я'];
$array2 = [
	'A', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i',
	'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r',
	'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z'];
$array3 = [',', '.', '!', '?', ':', ';', ' '];
$array4 = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
?>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <title>Анализ текста</title>
</head>

<body>
    <div class="header">
        <div class="header_container">
            <div class="block_feedback">
                <a href="index.html">Обратная связь</a>
            </div>
            <div class="block_signIn">
                <a href="signIn.html">Авторизация</a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="h1_container">
                <h1>Исходный текст</h1>
            </div>

            <?php
            if (isset($str)) {
                if ($str != '') {
                    echo '<textarea readonly disabled cols="50" rows="20">' .$str. '</textarea>';
                    $countSymvol = str_split($str);
                    echo '<p> Количество символов в тексте (включая пробелы): '.count($countSymvol). '</p>';

                    $countLetter = preg_replace("/[^a-zA-Zа-яА-Я]/u", "", $str);
                    echo '<p> Количество букв: '.strlen($countLetter). '</p>';

                    $countUpper = preg_replace("/[^A-ZА-Я]/u", "", $str);
                    echo '<p> Количество заглавных букв: '.strlen($countUpper). '</p>';

                    $countLow = preg_replace("/[^a-zа-я]/u", "", $str);
                    echo '<p> Количество строчных букв: '.strlen($countLow). '</p>';

                    $countNumber = preg_replace("/[^0-9]/u", "", $str);
                    echo '<p> Количество цифр: '.strlen($countNumber). '</p>';

                    $list = preg_replace("/[^a-zA-Zа-яА-Я]/u", ' ', $str);
                    $countWord = explode(" ",$list);
                    echo '<p> Количество слов: '.count($countWord). '</p>';
                    // echo print_r($list);
                    // echo print_r($countSymvol);

                    // $list2 = array_values(array_unique($countSymvol));
                    // echo print_r($list2);
                    
                    // for ($k=0; $k<count($array1); $k++){
                    //         echo $array1[$k];
                        
                    // }

                    //$list2 = sort($countSymvol);
                    // echo print_r($list2);
                    $list2 = array_count_values($countSymvol);
                    echo 'Кол-во дубликатов: ' . count($list2) . '<br></br>';
                    // print_r($list2);
                    foreach ($list2 as $key => $value){
                        if ($key == ' '){
                            echo '<p>' .$key . ' = ' . $value . ' (Пробел)</p>';
                            continue;
                        }
                        echo '<p>' .$key . ' = ' . $value . '</p>';
                    }

                    echo print_r($countWord);
                    $list3 = array_count_values($countWord);
                    //echo print_r($list3);
                    echo 'Кол-во дубликатов: ' . count($list3) . '<br></br>';
                    foreach ($list3 as $key => $value){
                        echo '<p>' .$key . ' = ' . $value . '</p>';
                    }

                } else echo '<p> Нет текста для анализа </p>';

            }
            ?>
    
            
            
            
        </div>
    </div>
</body>

</html>

<!-- // if (isset($_POST['attachment']) && $_POST['attachment'] != '') {
            //     echo '<p>Вы приложили следующий файл: ' . $_POST['attachment'].'</p>';
            // }
            //     echo '<div class="button_container"><a href="index.php?NAME='.$_POST['name'].'&EMAIL='.$_POST['email'].'&E='.$_POST['source'].'"><button class="button_signUp">Заполнить снова</button></a><div>';

            // } else {
            // echo 'error'; -->

            <!-- for ($i=0; $i<count($countSymvol); $i++){
                        for ($k=0; $k<count($array1); $k++){
                            if ($countSymvol[$i] == $array1[$k]){ 
                                $count++;
                                // echo '<p> '.$countSymvol[$i]. " " .$count. ' </p>';
                            }  
                        }
                        for ($j=0; $j<count($array2); $j++){
                            if ($countSymvol[$i] == $array2[$j]){
                                $count++;
                                // echo '<p> '.$countUpper[$i]. " " .$count. ' </p>';
                            }
                        }
                        for ($p=0; $p<count($array3); $p++){
                            if ($countSymvol[$i] == $array3[$p]){
                                $count++;
                                // echo '<p> '.$countSymvol[$i]. " " .$count. ' </p>';

                            }
                        }
                        for ($h=0; $h<count($array4); $h++){
                            if ($countSymvol[$i] == $array4[$h]){
                                $count++;
                                // echo '<p> '.$countSymvol[$i]. " " .$count. ' </p>';

                            }
                        }
                        echo '<p> '.$countSymvol[$i]. " " .$count. ' </p>';
                        $count = 0;
                    } -->