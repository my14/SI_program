<?php
    if(isset($_COOKIE['PHPSESSID'])){
        session_start();
        $editname = $_SESSION['id'];
    }else{
        header("location: kadai_3-7.php");
    }
?>

<script type="text/javascript">
function submitChk(){
  var flag = confirm("この投稿を変更しますか？");
  return flag;
}
function check(){
  var flag = 0;

  if(document.form1.name.value == ""){
    flag = 1;
  }else if(document.form1.comment.value == ""){
    flag = 1;
  }
  if(flag){
    alert("未入力のものがあります。");
  }
}
function passerror(){
    alert("パスワードが間違っています。");
}
function exiterror(){
    alert("その投稿は既に削除されています。");
}

</script>
    <?php
        if(isset($_POST['edit'])){
            try {
                $dbh = new PDO('データベース名', 'ユーザー名', 'パスワード');
                $data = 'SELECT * FROM Board WHERE id='.$_POST['edit'];
                $res = $dbh->query($data);
                if($res){
                    $row = $res->fetch(PDO::FETCH_ASSOC);
                    if(empty($row['password'])){
                        $editname = $row['name'];
                        $editcomment = $row['comment'];
                        $editcode = $_POST['edit'];
                        $editpass = "変更できません。";
                    }else{
                        if($_POST['pass'] == $row['password']){
                            $editname = $row['name'];
                            $editcomment = $row['comment'];
                            $editcode = $_POST['edit'];
                            $editpass = "変更できません。";
                        }else{
                            print "<script type=text/javascript>passerror()</script>";
                        }
                    }
                }else{
                    print "<script type=text/javascript>exiterror()</script>";
                }
                $dbh = null;
            } catch (PDOException $e) {
                print "エラーです。<br> " . $e->getMessage();
                die();
            }
             }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset = "utf-8">
<title>掲示板</title>
</head>
<body>
<h1>掲示板</h1>
<form action = "kadai_3-8.php" method = "post" enctype="multipart/form-data" name="form1">
名前:<input type = "text" name = "name" value = "<?php echo $editname; ?>"><br>
<input type = "hidden" name = "editcode" value = "<?php echo $editcode; ?>">
パスワード:<input type = "text" name = "pass" value = "<?php echo $editpass; ?>"><br>
投稿コメント:<br>
<textarea cols = "50" rows="5" name = "comment"><?php echo $editcomment; ?></textarea><br>
ファイルを添付する(画像,動画):<input type="file" name="upfile"><br>
<input type = "submit" name = "hoge" value = "送信"><br><br>
</form>
<form type = "kadai_3-8.php" method = "post" name="form2" onsubmit = "return submitChk()">
編集番号:<input type = "text" name = "edit">
パスワード:<input type ="text" name = "pass">
<input type ="submit" value ="送信"><br>
</form>
<form type = "kadai_3-8.php" method = "post" name="form3" onsubmit = "return submitChk()">
削除番号:<input type ="text" name = "delete">
パスワード:<input type ="text" name = "pass">
<input type ="submit" value = "送信"><br><br>
</form>

<?php
    //header('Content-Type: text/html; charset=utf-8');
    try {
        $dbh = new PDO('データベース名', 'ユーザー名', 'パスワード');
        $table= 'CREATE TABLE Board (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30),
        comment TEXT,
        ftype VARCHAR(10),
        filename VARCHAR(255),
        raw_data mediumblob,
        create_datetime DATETIME,
        password VARCHAR(30)
        ) engine=innodb default charset=utf8';
        
        if($dbh->query($table)){
        }else{
        }
        
        if(!empty($_POST['delete'])){
            $data = 'SELECT * FROM Board WHERE id='.$_POST['delete'];
            $res = $dbh->query($data);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($_POST['pass'] == $row['password']){
                    
                $data = 'DELETE FROM Board WHERE id= '.$_POST['delete'];
                $res = $dbh->prepare($data);
                $res -> execute();
            }else{
                print "<script type=text/javascript>passerror()</script>";
            }
        }else if($_POST['editcode'] >= 1){
            $t = getdate();
            $data = "UPDATE Board SET comment = '".$_POST['comment']."',create_datetime = "."'".$t['year']."/".$t['mon']."/".$t['mday']."/".$t['hours'].":".$t['minutes'].":".$t['seconds']."'" ."WHERE id=".$_POST['editcode'];
            $res = $dbh->prepare($data);
            $res -> execute();
            $editcode = 0;
        }else if(!empty($_POST['name'])&&!empty($_POST['comment'])){
            $t = getdate();
            if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
                $type = ExtensionDiscrimination();
                $img_binary = file_get_contents($_FILES['upfile']['tmp_name']);
                $data = "INSERT INTO Board (id,name,comment,ftype,filename,raw_data,create_datetime,password)VALUES('','".$_POST['name']."','".$_POST['comment']."','".$type."','".$_FILES['upfile']['name']."',".$dbh->quote($img_binary).",'".$t['year']."/".$t['mon']."/".$t['mday']."/".$t['hours'].":".$t['minutes'].":".$t['seconds']."','".$_POST['pass']."')";
            }else{
                $data = "INSERT INTO Board (id,name,comment,create_datetime,password)VALUES('','".$_POST['name']."','".$_POST['comment']."','".$t['year']."/".$t['mon']."/".$t['mday']."/".$t['hours'].":".$t['minutes'].":".$t['seconds']."','".$_POST['pass']."')";
            }
            if($dbh->query($data)){
                echo "保存成功";
            }else{
                echo "保存失敗";
                var_dump($dbh->errorInfo());
            }
            
        }else if(isset($_POST["hoge"])){
            print "<script type=text/javascript>check()</script>";
        }
        
        $data = 'SELECT * FROM Board';
        $res = $dbh->query($data);
        $FTypes = array(
                           'png'  => 'image',
                           'jpg'  => 'image',
                           'jpeg' => 'image',
                           'gif'  => 'image',
                           'mpg'  => 'video',
                           'mp4'  => 'video',
                           'm4v'  => 'video',
                           'mov'  => 'video',
                           'avi'  => 'video'
                           );

        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo $row["id"] .":名前:". $row["name"] .":投稿日時".$row["create_datetime"] ."<br>". $row["comment"] . "<br>";
            if($FTypes[$row['ftype']] == 'image'){
                echo "<img src=\"kadai_3-8-2.php?id=".$row["id"]."\">";
                echo "<br>";
            }else if($FTypes[$row['ftype']] == 'video'){
                echo "<video controls loop width=\"640\" height=\"360\"><source src=\"kadai_3-8-2.php?id=".$row["id"]."\"></video>";
                echo "<br>";
            }else{
                echo $FTypes[$row['ftype']];
                echo "<br>";
            }
        }
        
        $dbh = null;
        $res = null;
        

    } catch (PDOException $e) {
        print "エラーです。<br> " . $e->getMessage();
        die();
    }

    function ExtensionDiscrimination(){
        echo "tmp_name=".$_FILES['upfile']['tmp_name']."<br>";
        echo "name=".$_FILES['upfile']['name']."<br>";
        echo "error=".$_FILES['upfile']['error']."<br>";
        echo "type=".$_FILES['upfile']['type']."<br>";
        $ext = pathinfo($_FILES['upfile']['name'], PATHINFO_EXTENSION);
        if("png" == $ext){
            echo "pngです<br>";
            return "png";
        }else if("gif" == $ext){
            echo "gifです<br>";
            return "gif";
        }else if("jpg" == $ext){
            echo "jpgです<br>";
            return "gif";
        }else if("mp4" == $ext){
            echo "mp4です<br>";
            return "mp4";
        }else if("jpeg" == $ext){
            echo "jpegです<br>";
            return "jpeg";
        }else if("mpg" == $ext){
            echo "mpgです<br>";
            return "mpg";
        }else if("mov" == $ext || "m4v" == $ext){
            echo "movです<br>";
            return "mov";
        }else if("avi" == $ext){
            echo "aviです<br>";
            return "avi";
        }else{
            echo "対応外です".$ext."<br>";
            return null;
        }
    }

?>
</body>
</html>

