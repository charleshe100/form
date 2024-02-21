<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->
 <?php

if(isset($_GET['err'])){
    echo $_GET['err'];
}

?>
<form action="./api/upload.php" method="post" enctype="multipart/form-data">
    <!-- <label class="input-group-text" for="inputGroupFile01">Upload</label>
    <input type="file" class="form-control" id="inputGroupFile01"> -->
<div class="input-group mb-3 w-50 mx-auto">
  <input type="file" class="form-control" name="img" id="">
  <input type="text" class="form-control w-25" name="desc" value="" placeholder="請輸入檔案描述">
  <input type="submit" class="form-control" value="上傳">
</div>
</form>



<!----建立一個連結來查看上傳後的圖檔---->  
<?php

if(isset($_GET['img'])){
    echo "<img src='./imgs/{$_GET['img']}' style='width:250px;height:150px'>";
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>