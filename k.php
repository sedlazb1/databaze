<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>
     jupiii zadna reklama <br />
     <a href="add.php">add/modify</a>
     <?php
        include "db.php";
        $res = mysql_query('SELECT * FROM  `kamaradi`');
        echo '<table border="1">';
        echo '<tr><td>id</td><td>coords</td><td>name</td><td><img src="ikony/Wood_small.png"></td><td><img src="ikony/Wine_small.png"></td><td><img src="ikony/Marble_small.png"></td><td><img src="ikony/icon_glass.png"></td><td><img src="ikony/Sulphur_small.png"></td></tr>';
        while($result = mysql_fetch_array($res)){
          echo '<tr><td>'.$result['id'].'</td><td>'.$result['is_x'].':'.$result['is_y'].'</td>
          <td>'.$result['name'].'</td><td>'.$result['wood'].'</td><td>'.$result['vine'].'</td>
          <td>'.$result['rock'].'</td><td>'.$result['glass'].'</td><td>'.$result['sira'].'</td>';
        }
        echo '</table>';
        
        
        
        /*INSERT INTO  `kamaradi` (  `id` ,  `name` ,  `is_x` ,  `is_y` ,  `wood` ,  `vine` ,  `rock` ,  `glass` ,  `sira` ) 
VALUES (
'',  'Jirotkovice',  '38',  '56',  '35286',  '14',  '1297',  '19825',  '1297'
); */

     
     
     
     ?>
  </body>
</html>
