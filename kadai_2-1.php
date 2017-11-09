<!DOCTYPE html>
<head>
<title>課題2-1</title>
</head>
<body>
<form type="kadai_2-1.php" method="post">
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
echo "名前:".$_POST['name'].",コメント:" .$_POST['comment']; 
?>