<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

 if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],'./imgs/'.$_FILES['img']['name']);
    $source_path='./imgs/'.$_FILES['img']['name'];
    $type=$_FILES['img']['type'];
    switch($type){
        case 'image/jpeg':
            $source=imagecreatefromjpeg($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/png':
            $source=imagecreatefrompng($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/gif':
            $source=imagecreatefromgif($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/bmp':
            $source=imagecreatefrombmp($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
    }
    $dst_path='./imgs/thumb_'.$_FILES['img']['name']; // 修改
    $dst_width=300; // 修改
    $dst_height=300; // 修改
    $border=30; //新增
    $dst_source=imagecreatetruecolor($dst_width,$dst_height);
    // 判斷方向性（新增）
    if($width==$height){
        // 正方形
        $scale=($dst_width-($border*2))/$width;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_w_x=$border;
        $dst_w_y=$border;
    }else if($width<$height){
        // 直向
        $scale=($dst_width-($border*2))/$height;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_w_x=$border;
        $dst_w_y=$border;
    }else{
        // 橫向
        $scale=($dst_width-($border*2))/$width;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_w_x=$border;
        $dst_w_y=$border;
    }


    imagecopyresampled($dst_source,$source,0,0,0,0,$dst_width,$dst_height,$width,$height); //修改
    switch($type){
        case 'image/jpeg':
            imagejpeg($dst_source,$dst_path);
        break;
        case 'image/png':
            imagepng($dst_source,$dst_path);
        break;
        case 'image/gif':
            imagegif($dst_source,$dst_path);
        break;
        case 'image/bmp':
            imagebmp($dst_source,$dst_path);
        break;
    }

    imagedestroy($source);
    imagedestroy($dst_source);

 }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形檔案處理</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">
    <label for="">選擇檔案:</label>
    <input type="file" name="img" id="">
    <input type="submit" value="上傳">
</form>


<!----縮放圖形----->
<img src="<?=$dst_path;?>" alt="">

<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>