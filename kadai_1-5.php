<?php
if(isset($_POST['word'])){
  $word = $_POST['word'];
  echo $word;
  $fp = fopen("kadai_1-5.txt",'w');  //ファイルのオープン
  $str = mb_convert_encoding($word,"euc-jp","utf-8");   //ファイルに書き出す
  fwrite($fp,"$str");
  //ファイルを閉じる
  fclose($fp);
}
?>

<!DOCTYPE html>
<head>
<title>課題1-5</title>
</head>
<body>
<form action = "kadai_1-5.php" method = "post">
フォームの送信:<br/ >
<input type = "text" name = "word"/><br />
<input type = "submit" value = "送信" />
</form>
</body>
</html>
