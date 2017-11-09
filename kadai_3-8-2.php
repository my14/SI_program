<?php
    try {

        $dbh = new PDO('データベース名', 'ユーザー名', 'パスワード');

        $data = "SELECT ftype, raw_data FROM Board WHERE id ='".$_GET['id']."'";
        $res = $dbh->query($data);
        if($res){
            $MIMETypes = array(
                               'png'  => 'image/png',
                               'jpg'  => 'image/jpeg',
                               'jpeg' => 'image/jpeg',
                               'gif'  => 'image/gif',
                               'mpg'  => 'video/mpeg',
                               'mp4'  => 'video/mp4',
                               'mov'  => 'video/quicktime',
                               'm4v'  => 'video/quicktime',
                               'avi'  => 'video/x-msvideo'
                               );
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if(!empty($row["raw_data"])){
                header("Content-Type:".$MIMETypes[$row['ftype']]);
                echo $row["raw_data"];
            }else{
                echo "empty";
            }
        }
    } catch (PDOException $e) {
        die();
    }
?>
