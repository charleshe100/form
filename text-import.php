<style>
    table{
        border-collapse: collapse;
    }
    th{
        background-color: black;
        color: white;
    }
    tr,th,td{
        border: 1px solid black;
        padding: 5px;
    }
</style>
<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */

if(!empty($_FILES['text']['tmp_name'])){
    $filename=$_FILES['text']['name'];
    $filesize=$_FILES['text']['size'];
    echo "檔案上傳成功！檔名為：".$filename;
    echo "<br>檔案大小：".$filename;
    echo "<br>";
    $file=fopen($_FILES['text']['tmp_name'], 'r'); //要從哪兒開，怎麼開    
    $line=fgets($file);
    $cols=explode(',',$line);
    echo "<table>";
    echo "<tr>";
    foreach($cols as $col){
        echo "<th>";
        echo $col;
        echo "</th>";
    }
    echo "</tr>";    

    while (!feof($file)){
        $line=fgets($file);
        $cols=explode(',',$line);
        echo "<tr>";
        foreach($cols as $col){
            echo "<td>";
            echo $col;
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">文字檔案匯入練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">
    <input type="file" name="text" id="text">
    <input type="submit" value="上傳">
</form>


<!----讀出匯入完成的資料----->



</body>
</html>