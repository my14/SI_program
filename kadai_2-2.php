<!DOCTYPE html>
<head>
<title>課題2-2</title>
</head>
<body>
<form type="kadai_2-2.php" method="post">
  簡易掲示板<br /><br />
  名前:<br />
<input type="text" name="name"/><br /><br />
  コメント:<br />
<textarea cols="50" rows="5" name="comment"></textarea><br />
  <br />
  <input type="submit" value="送信" />
</form>
</body>
</html>

<?php 
$fp = fopen("kadai_2-2.txt",'a');
  $arry_file = file('kadai_2-2.txt');
  $i = count($arry_file)+1;
  $str = "$i"."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y/m/d/H:i")."\n";
  fwrite($fp,$str);
  fclose($fp);
?>


