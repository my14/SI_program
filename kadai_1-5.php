<?php
if(isset($_POST['word'])){
  $word = $_POST['word'];
  echo $word;
  $fp = fopen("kadai_1-5.txt",'w');  //�t�@�C���̃I�[�v��
  $str = mb_convert_encoding($word,"euc-jp","utf-8");   //�t�@�C���ɏ����o��
  fwrite($fp,"$str");
  //�t�@�C�������
  fclose($fp);
}
?>

<!DOCTYPE html>
<head>
<title>�ۑ�1-5</title>
</head>
<body>
<form action = "kadai_1-5.php" method = "post">
�t�H�[���̑��M:<br/ >
<input type = "text" name = "word"/><br />
<input type = "submit" value = "���M" />
</form>
</body>
</html>
