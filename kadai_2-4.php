<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset = "utf-8">
<title>課題2-4</title>
</head>
<body>
簡易掲示板<br /> <br /> 
<form type = "kadai_2-4.php" method = "post">
名前:<input type = "text" name = "name"><br />
コメント:<br />
<textarea cols = "50" rows="5" name = "comment"></textarea><br />
<input type = "submit" value = "送信"><br /><br />
</form>
<form type = "kadai_2-4.php" method = "post">
削除番号:<input type ="text" name = "delete">
<input type ="submit" value = "送信"><br /><br />
</form>

<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST['delete']) != "" && file_exists('kadai_2-2.txt')){
  $fp = fopen("kadai_2-2.txt",'r');
  $arry_file = file('kadai_2-2.txt');
  fclose($fp);
  $fp = fopen("kadai_2-2.txt",'w');
  $j = 0;
  while(count($arry_file) > $j){
    $arry_file[$j] = mb_convert_encoding($arry_file[$j],"utf-8","euc-jp");
    $cell = explode("<>",$arry_file[$j]);
    if($cell[0] != $_POST['delete']){
      $arry_file[$j] = mb_convert_encoding($arry_file[$j],"euc-jp","utf-8");
      fwrite($fp,$arry_file[$j]);
      echo $cell[0].$cell[1]."<br>".$cell[2]."<br>".$cell[3]."<br>";
    }else{
      $str = mb_convert_encoding($cell[0]."".":削除されました。\n","euc-jp","utf-8");
      fwrite($fp,$str);
      echo $cell[0].":削除されました。<br>";
    }
    $j++;
  }
  fclose($fp);
}else if(file_exists('kadai_2-2.txt')||isset($_POST['name'])){

  $fp = fopen("kadai_2-2.txt",'a+');
  $arry_file = file('kadai_2-2.txt');
  $i=0;
  while($arry_file[$i] != null){
    $arry_file[$i] = mb_convert_encoding($arry_file[$i],"utf-8","euc-jp");
    $cell = explode("<>",$arry_file[$i]);
    echo $cell[0].":".$cell[1]."<br>".$cell[2]."<br>".$cell[3]."<br>";
    $i++;
  }
  if(isset($_POST['name'])&&isset($_POST['comment'])){
    $i = count($arry_file)+1;
    $str = "$i"."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y年m月d日H時i分");
    $str = str_replace(array("\r", "\n"), '', $str);
    $str = $str."\n";
    $cell = explode("<>",$str);
    echo $cell[0].":".$cell[1]."<br>".$cell[2]."<br>".$cell[3]."<br>";
    $str = mb_convert_encoding($str,"euc-jp","utf-8");
    fwrite($fp,$str);
  }
  fclose($fp);
}

?>
</form>
</body>
</html>

