<!DOCTYPE html>
<head>
<title>�ۑ�2-1</title>
</head>
<body>
<form type="kadai_2-1.php" method="post">
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
echo "���O:".$_POST['name'].",�R�����g:" .$_POST['comment']; 
?>