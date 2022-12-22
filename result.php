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
$k5=0;
$k6 = 0;
$k7 = 0;
$k8 = 0;
$k9 = 0;
$list;
$list2;
$list3;
$list4;
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
$array3 = [',', '.', '!', '?', ':', ';', ' ', '-', '+', '/', '*'];
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
            <table>
            <?php
            if (isset($str)) {
                if ($str != '') {
                    $keywords = str_replace(' ', '', $str); //строка без пробелов
                    $keywords2 = preg_replace("/[^а-яА-Я]/u", "", $keywords); // строка с кириллицей
                    $keywords3 = preg_replace("/[^a-zA-Z0-9]/", "", $str);
                    $keywords4;
                    // $keywords3 = preg_replace("/[^a-zA-Z0-9]/u", "", $keywords);
                    $countUpperEn = strlen(preg_replace("/[^A-Z]/u", '', $keywords));
                    $countUpperRu = strlen(preg_replace("/[^А-Я]/u", '', $keywords))/2;
                    $countLowEn = strlen(preg_replace("/[^a-z]/u", '', $keywords));;
                    $countLowRu = strlen(preg_replace("/[^а-я]/u", '', $keywords))/2;

                    $countLow = $countLowEn + $countLowRu;
                    $countUpper = $countUpperEn + $countUpperRu;
                    // echo $countUpper;
                    echo "</br> " . $keywords2;
                    // echo ' ' .strlen($keywords2);
                    for ($i = 0; $i < strlen($keywords2); $i+=2){
                        $h = $i + 1;
                        for ($j=0; $j<count($array1);$j++){
                            if ($array1[$j] == $keywords2[$i] . $keywords2[$h])
                                $k5++; //количество символов кириллицы
                        }
                    }
                    for ($i = 0; $i < strlen($str); $i++){
                        for ($j=0; $j<count($array2);$j++){
                            if ($array2[$j] == $str[$i])
                                $k6++; //количество символов латыни
                        }
                        
                        for ($l=0; $l<count($array4);$l++){
                            if ($array4[$l] == $str[$i])
                                $k8++; //количество цифр
                        }
                    }
                    for ($i = 0; $i < strlen($str); $i++) {
                        for ($p = 0; $p < count($array3); $p++) {
                            if ($array3[$p] == $str[$i])
                                $k7++; //количество спец символов
                        }
                    }
                    for ($i = 0; $i < strlen($str); $i++) {
                        if ($str[$i] == " ") {
                            $k9++; // количество пробелов
                        }
                    }
                    echo '<p> K: ' . $k5 . '</p>';
                    echo '<p> K: ' . $k6 . '</p>';     
                    echo '<p> K: ' . $k7 . '</p>';            
                    echo '<p> K: ' . $k8 . '</p>'; 
                    echo '<p> K: ' . $k9 . '</p>'; 

                    echo '<textarea readonly disabled cols="50" rows="20">' .$str. '</textarea>';
                    $countSymvol = str_split($str);
                    $countChar = $k5 + $k6 + $k7 + $k8; // количество символов
                    echo '<tr>
                                <td>Количество символов в тексте (включая пробелы): </td>
                                <td>' .$countChar. '</td>
                        </tr>';
                   
                    // $countLetter = preg_replace("/[^a-zA-Zа-яА-Я]/u", "", $str);
                    echo '<tr> 
                    <td> Количество букв: </td>
                    <td>'.$k5 + $k6. '</td> 
                    </tr>';
                    // strlen($countLetter)
                    // $countUpper = preg_replace("/[^A-ZА-Я]/u", "", $str);
                    echo '<tr> 
                    <td> Количество заглавных букв: </td>
                    <td>'.$countUpper. '</td>
                    </tr>';

                    // $countLow = preg_replace("/[^a-zа-я]/u", "", $str);
                    echo '<tr> 
                    <td> Количество строчных букв: </td>
                    <td>'.$countLow. '</td>
                    </tr>';

                    $countNumber = preg_replace("/[^0-9]/u", "", $str);
                    echo '<tr> 
                    <td> Количество цифр: </td>
                    <td>'.strlen($countNumber). '</td>
                    </tr>';

                    // $list =  explode(' ', trim(preg_replace('/\d/', '', $str)));
                    $list =  explode(" ", trim(preg_replace('/[ ]{1,}/', ' ', $str))); //                    

                    // $str2 = preg_replace("/ +/", ' ',trim(preg_replace('/\d/', '', $str)));
                    //$countWord = explode(" ",$list);
                    // echo print_r($list);
                    // echo $str2;
                    foreach ($list as $key => $value){
                        
                            $countWord++;
                    }
                    ;
                    echo '<tr> 
                     <td> Количество слов: </td>
                     <td>'.$countWord. '</td>
                     </tr>';
                    // echo print_r($list);
                    // echo print_r($countWord);

                    // $list2 = array_values(array_unique($countSymvol));
                    // echo print_r($list2);
                    
                    // for ($k=0; $k<count($array1); $k++){
                    //         echo $array1[$k];
                        
                    // }

                    //$list2 = sort($countSymvol);
                    $list2 = array_count_values($countSymvol);
                    $keywords4 = str_split($keywords3);
                    $list5 = array_count_values($keywords4);
                    // echo 'Кол-во вхождений каждого символа: ' . count($list2) . '<br></br>';
                    echo '<tr> 
                    <td> Кол-во вхождений каждого символа: </td>
                    <td>'. count($list2) . '</td>
                    </tr>';

                    foreach ($list5 as $key => $value){
                        if ($key == ' '){
                            echo '<tr>
                            <td>' .$key. '(Пробел)</td> 
                            <td>' .$value. '</td>
                            </tr>';
                            continue;
                        }
                        echo '<tr>
                            <td>' .$key. '</td> 
                            <td>' .$value. '</td>
                            </tr>';
                    }

                    foreach ($list2 as $key => $value){
                        if ($key == ' '){
                            echo '<tr>
                            <td>' .$key. '(Пробел)</td> 
                            <td>' .$k9. '</td>
                            </tr>';
                            break;
                        }
                    }

                        for ($j=0; $j<count($array1); $j++){
                            $countRu = 0;
                            for ($i = 0; $i < strlen($keywords2); $i+=2){
                                $h = $i + 1;
                            if ($array1[$j] == $keywords2[$i] . $keywords2[$h]){
                                $countRu++;
                            }
                            }
                            if ($countRu !=0){
                            echo '<tr>
                            <td>' .$array1[$j]. '</td> 
                            <td>' .$countRu. '</td>
                            </tr>';
                            }
                    }

                    // echo print_r($countWord);
                    $list3 = array_count_values($list);
                    ksort($list3);
                    //echo print_r($list3);
                    echo '<tr> 
                    <td> Кол-во вхождений слов: </td>
                    <td>'. count($list3) . '</td>
                    </tr>';
                    foreach ($list3 as $key => $value){
                        echo '<tr>
                            <td>' .$key. '</td> 
                            <td>' .$value. '</td>
                            </tr>';
                    }

                } else echo '<p> Нет текста для анализа </p>';

            }
            ?>
            </table>
            
            
            
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