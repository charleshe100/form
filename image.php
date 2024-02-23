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
    $src_path='./imgs/'.$_FILES['img']['name'];
    $type=$_FILES['img']['type'];
    switch($type){
        case 'image/jpeg':
            $src=imagecreatefromjpeg($src_path);
            list($width,$height)=getimagesize($src_path);
        break;
        case 'image/png':
            $src=imagecreatefrompng($src_path);
            list($width,$height)=getimagesize($src_path);
        break;
        case 'image/gif':
            $src=imagecreatefromgif($src_path);
            list($width,$height)=getimagesize($src_path);
        break;
        case 'image/bmp':
            $src=imagecreatefrombmp($src_path);
            list($width,$height)=getimagesize($src_path);
        break;
    }
    $dst_path='./imgs/thumb_'.$_FILES['img']['name'];
    $dst_width=300; // 修改
    $dst_height=300; // 修改
    $border=30; //新增

    $dst_src=imagecreatetruecolor($dst_width,$dst_height);
    // 新增，設定背景顏色，填入背景顏色
    $white=imagecolorallocate($dst_src,255,255,255);
    $red=imagecolorallocate($dst_src,255,0,0);
    $skyblue=imagecolorallocate($dst_src,122 ,204 ,244);
    imagefill($dst_src,0,0,$red);

    // 判斷方向性（新增）
    if($width==$height){
        // 正方形
        $scale=($dst_width-($border*2))/$width;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_x=$border;
        $dst_y=$border;
    }else if($width<$height){
        // 直向
        $scale=($dst_width-($border*2))/$height;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_x=floor(($dst_width-$new_width)/2);
        $dst_y=$border;
    }else{
        // 橫向
        $scale=($dst_width-($border*2))/$width;
        $new_width=$width*$scale;
        $new_height=$height*$scale;
        $dst_x=$border;
        $dst_y=floor(($dst_width-$new_height)/2);
    }


    imagecopyresampled($dst_src,$src,$dst_x,$dst_y,0,0,$new_width,$new_height,$width,$height);
    switch($type){
        case 'image/jpeg':
            imagejpeg($dst_src,$dst_path);
        break;
        case 'image/png':
            imagepng($dst_src,$dst_path);
        break;
        case 'image/gif':
            imagegif($dst_src,$dst_path);
        break;
        case 'image/bmp':
            imagebmp($dst_src,$dst_path);
        break;
    }
    imagedestroy($src);
    imagedestroy($dst_src); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形處理練習</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .box{
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->
<div class="box">
    <form action="?" method="post" enctype="multipart/form-data">
        <label for="">選擇檔案：</label>
        <input type="file" name="img" id="">
        <input type="submit" value="上傳">
    </form>
</div>


<!----縮放圖形----->
<div class="box">
    <img src="<?=$dst_path;?>" alt="">
</div>

<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>