<!DOCTYPE html>
<head>
<title>�ۑ�2-2</title>
</head>
<body>
<form type="kadai_2-2.php" method="post">
  �ȈՌf����<br /><br />
  ���O:<br />
<input type="text" name="name"/><br /><br />
  �R�����g:<br />
<textarea cols="50" rows="5" name="comment"></textarea><br />
  <br />
  <input type="submit" value="���M" />
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


