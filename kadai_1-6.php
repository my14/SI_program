<?php
if(isset($_POST['word'])){
  $word = $_POST['word'];
  echo $word;
  $fp = fopen("kadai_1-6.txt",'a');     //�t�@�C���̃I�[�v��
  $str = $word."\n";
  //$str = mb_convert_encoding($str,"euc-jp","utf-8");     //�t�@�C���ɏ����o��
  fwrite($fp,$str);
  //�t�@�C�������
  fclose($fp);
}
?>
<!DOCTYPE html>
<head>
<title>�ۑ�1-6</title>
</head>
<body>
<form action = "kadai_1-6.php" method = "post">
  �t�H�[���̑��M:<br/>
<input type = "text" name = "word"/><br />
<input type = "submit" value = "���M" />
</form>
</body>
</html>
