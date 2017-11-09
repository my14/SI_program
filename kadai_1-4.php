<?php echo htmlspecialchars($_POST["name"]); ?>


<!DOCTYPE html>
<head>
<title>課題1-4</title>
</head>
<body>
<form action="kadai_1-4.php" method="post">
  フォームの送信：<br />
  <input type="text" name="name"/><br />
  <br />
  <input type="submit" value="送信" />
</form>
</body>
</html>