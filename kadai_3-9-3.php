    <?php
        if(empty($_GET['action'])){
        echo '<pre>';
        
        $last_line = system('crontab -l', $retval);
        
        echo '
        </pre>
        <hr />Last line of the output: ' . $last_line . '
        <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "ls"){
            echo '<pre>';
            
            $last_line = system('ls -l', $retval);
            
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "pwd"){
            echo '<pre>';
            
            $last_line = system('pwd', $retval);
            
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "php"){
            echo '<pre>';
            
            $last_line = system('which php', $retval);
            
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "error"){
            echo '<pre>';
            
            $last_line = system('cat /var/log/cron', $retval);
           
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "status"){
            echo '<pre>';
            
            $last_line = system('/etc/rc.d/init.d/crond status', $retval);
           
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else if($_GET['action'] == "config"){
            echo '<pre>';
            
            $last_line = system('chkconfig --list crond', $retval);
           
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }else{
            echo '<pre>';
            
            $last_line = system('crontab /home/データベース名/public_html/cron.conf', $retval);
            
            echo '
            </pre>
            <hr />Last line of the output: ' . $last_line . '
            <hr />Return value: ' . $retval;
        }
    ?>
