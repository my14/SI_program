<!DOCTYPE html>
<head>
<title>課題2-3</title>
</head>
<body>
<form type = "kadai_2-3.php" method = "post">
簡易掲示板<br /> <br />
名前:<br />
<input type = "text" name = "name"><br /><br />
コメント:<br />
<textarea cols = "50" rows="5" name = "comment"></textarea><br />
<input type = "submit" value = "送信" />
</form>
</body>
</html>

<?php
if(file_exists('kadai_2-2.txt') || isset($_POST['name'])){
  $fp = fopen("kadai_2-2.txt",'a');
  $arry_file = file('kadai_2-2.txt');
  $i = count($arry_file)+1;
  $str = "$i"."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y/m/d/H:i");
  $str = str_replace(array("\r", "\n"), '', $str);
  $str = $str."\n";
  fwrite($fp,$str);
  fclose($fp);
  $i=0;
  while($arry_file[$i] != null){
    $cell = explode("<>",$arry_file[$i]);
    echo $cell[0].":"."名前:".$cell[1]."<br>".$cell[2]."<br>".$cell[3]."<br>";
    $i++;
  }
  $cell = explode("<>",$str);
  echo $cell[0].":"."名前:".$cell[1]."<br>".$cell[2]."<br>".$cell[3]."<br>";
}
?>