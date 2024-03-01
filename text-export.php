<?php include "db.php";
if(!empty($_POST)){
    // echo "你希望匯出";
    // print_r($_POST['select']);
    // echo "這些資料";
    $rows=all("20200706"," where `投票所編號` in ('" .join("','",$_POST['select'])."')");

    $filename=date("Ymd").rand(100000000,999999999);//將檔案以日期加上隨機數字命名
    $file=fopen("./doc/{$filename}.csv",'w+');//從哪裡打開，用什麼方式讀取或寫入
    fwrite($file,"\xEF\xBB\xBF"); // 轉為中文，excel可正常顯示中文
    $chk=false; //11~17行的功能是撈出檔案的第一行標題欄後，就不再撈出
    foreach($rows as $row){
        if(!$chk){
            $cols=array_keys($row);
            
            fwrite($file,join(",",$cols)."\r\n");
            $chk=true;
        }
        fwrite($file,join(",",$row)."\r\n"); //寫入
    }
    fclose($file); //關檔案

    echo "<a href='./doc/{$filename}.csv' download>檔案已匯出，請點此連結下載</a>";
}
?>
<style>
    table{
        border-collapse: collapse;
        margin-top: 10px;
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
<form action="?" method="post" enctype="multipart/form-data">
    <input type="submit" value="匯出">
<table>
    <tr>
        <th><input type="checkbox" id="allCheckbox">全選</th>
        <th>投票所編號</th>
        <th>投票所</th>
        <th>候選人1</th>
        <th>候選人1票數</th>
        <th>候選人2</th>
        <th>候選人2票數</th>
        <th>候選人3</th>
        <th>候選人3票數</th>
        <th>有效票數</th>
        <th>無效票數</th>
        <th>投票數</th>
        <th>已領未投票數</th>
        <th>發出票數</th>
        <th>用餘票數</th>
        <th>選舉人數</th>
        <th>投票率</th>
    </tr>
<?php
$rows=all('20200706');
foreach($rows as $row){
    echo "<tr>";
    echo "<td>";
    echo "<input type='checkbox' name='select[]' value='{$row['投票所編號']}'>"; 
            //select[]用陣列，才不會只送出最後一筆，設定value，才知道是選取哪一列
    echo "</td>";        
    foreach($row as $value){
        echo "<td>";
        echo $value;
        echo "</td>";        
    }
    echo "</tr>";
}
?>
</table>
</form>
<script src="./api/jquery-3.4.1.min.js"></script>
<script>
//用jquery讓checkbox可以全選與取消
let allCheckbox=$('#allCheckbox')
allCheckbox.on("change",function(){
    if($(this).prop('checked')){
        $("input[name='select[]']").prop('checked',true)
    }else{
        $("input[name='select[]']").prop('checked',false)

    }
})
</script>