<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>     
  <head>       
    <meta http-equiv="content-type" content="text/html; charset=utf-8">       
    <meta name="generator" content="PSPad editor, www.pspad.com">       
    <title>    
    </title>       
    <style>    .s{text-align:center}
               .f{background-color:red} 
               .p{background-color:yellow} 
               .pf{background-color:orange}       
    </style>     
  </head>     
  <body>         
    <form method="post">      
      <table border="1">              
        <tr><td>add</td><td>modify</td>        
        </tr>              
        <tr><td>            
            <input type="radio" name="action" value="add"></td><td>            
            <input type="radio" name="action" value="mod" checked></td>        
        </tr>              
        <tr><td>name:             
            <input type="text" name="name"></td><td>id:             
            <input type="text" name="id"></td>        
        </tr>              
        <tr><td>coords:             
            <input type="text" name="coords" size="6"></td><td>robbery:             
            <input type="radio" name="mod" value="rob" checked>scout:             
            <input type="radio" name="mod" value="scout">delete:             
            <input type="radio" name="mod" value="del"></td>        
        </tr>              
        <tr>          
          <td class="s">            
            <img src="ikony/Wood_small.png"></td><td>            
            <input type="text" name="wood" size="10">k</td>        
        </tr>              
        <tr>          
          <td class="s">            
            <img src="ikony/Wine_small.png"></td><td>            
            <input type="text" name="vine" size="10">k</td>        
        </tr>              
        <tr>          
          <td class="s">            
            <img src="ikony/Marble_small.png"></td><td>            
            <input type="text" name="rock" size="10">k</td>        
        </tr>              
        <tr>          
          <td class="s">            
            <img src="ikony/icon_glass.png"></td><td>            
            <input type="text" name="glass" size="10">k</td>        
        </tr>              
        <tr>          
          <td class="s">            
            <img src="ikony/Sulphur_small.png"></td><td>            
            <input type="text" name="sira" size="10">k</td>        
        </tr>        
        <tr><td colspan="2">        
              <textarea rows="5" cols="60" name="c"></textarea>        </td>
        </tr>              
        <tr>          
          <td>zbysek             
            <input type="radio" name="kdo" value="z"> ondra             
            <input type="radio" name="kdo" value="o"></td>
            <td>add production:<input type="radio" name="mod" value="pro"> (1 hour after)</td>        
        </tr>          
        <tr>          
          <td colspan="2">            zmenit vztazne mesto
            <input type="radio" name="action" value="city">            (enter name and coords)</td>        
        </tr>             
        <tr>          
          <td colspan="2">            
            <input type="submit"></td>        
        </tr>                 
      </table>         
    </form>              
<?php
    function get_numerics($str) {
      preg_match_all('/([\d]+)/', $str, $matches);
      return $matches[0];
    }

    include "db.php";
    $pos = mysql_fetch_array(mysql_query('SELECT * FROM `kamaradi` WHERE id=1'));
    $posx = $pos['is_x'];
    $posy = $pos['is_y'];
    if($_POST){
      
      $res = array(0,0,0,0,0);
      $resNam = array("Stavební","Víno","Mramor","sklo","Síra");
      $bla = array(" materiál","Krystalické ");
      if(!empty($_POST['c']) && $_POST['action']=='mod' && $_POST['mod']=='rob'){
        $text = chop($_POST['c']); 
        $pole = get_numerics($text);
        $blabla = array_merge($bla, $pole);
        $text = str_replace($blabla, "", $text);
        $text = explode(" ", trim(chop($text)));  
        $lup = 0;
        for($i=0;$i<count($pole);$i++){
          $lup = $lup + $pole[$i];
          for($j=0;$j<count($resNam);$j++){
            if($resNam[$j]==$text[$i]){
              $res[$j]=$pole[$i];
            }
          }
        }
        echo $lup.'<br>';
        if(($lup + 0)%500>494){
          echo 'na stejnem ostrove plno';
        }
        if(($lup + 330)%500>494){
          echo 'plno s 30 hoplity a 6 katapulty';
        }
        if(($lup + 510)%500>494){
          echo 'plno s 30 hoplity a 12 katapulty';
        }
        if(($lup + 690)%500>494){
          echo 'plno s 30 hoplity a 18 katapulty';
        }
        if(($lup + 560)%500>494){
          echo 'plno s 40 hoplity a 12 katapulty';
        }
        if(($lup + 740)%500>494){
          echo 'plno s 40 hoplity a 18 katapulty';
        }
        if(($lup + 920)%500>494){
          echo 'plno s 40 hoplity a 24 katapulty';
        }
        if(($lup + 970)%500>494){
          echo 'plno s 50 hoplity a 24 katapulty';
        }
      }else if(!empty($_POST['c']) && ($_POST['action']=='add' || ($_POST['action']=='mod' && $_POST['mod']=='scout') || ($_POST['action']=='mod' && $_POST['mod']=='pro'))){
        echo 'jsem tu <br>';
        $text = chop($_POST['c']);
        $text = str_replace(",", "", $text);
        //echo $text; echo '<br>';
        $pole = get_numerics($text);
        //print_r($pole); echo '<br>';
        for($i=0;$i<count($pole);$i++){
          $res[$i]=$pole[$i];
        }
      }else{
        $res[0]=(!empty($_POST['wood']))?$_POST['wood']:0;
        $res[1]=(!empty($_POST['vine']))?$_POST['vine']:0;
        $res[2]=(!empty($_POST['rock']))?$_POST['rock']:0;
        $res[3]=(!empty($_POST['glass']))?$_POST['glass']:0;
        $res[4]=(!empty($_POST['sira']))?$_POST['sira']:0;
      }
      //print_r($res); echo '<br>';
      
       if((($_POST['action']=='add' || $_POST['action']=='city') && !empty($_POST['name']) && !empty($_POST['coords'])) 
          || ($_POST['action']=='mod' && !empty($_POST['id']))){
        if($_POST['action']=='add'){
          $coords = explode(":", $_POST['coords']);
          $dist = sqrt((($posx-$coords[0])*($posx-$coords[0]))+(($posy-$coords[1])*($posy-$coords[1])));
          $query = "INSERT INTO `kamaradi` (`id`,`name`,`is_x`,`is_y`,`wood`,`vine`,`rock`,`glass`,`sira`, `dist`, `pWood`, `pVine`, `pRock`, `pGlass`, `pSira`, `note`, `lastedit`) 
VALUES ('','".$_POST['name']."','".$coords[0]."','".$coords[1]."','".$res[0]."','".$res[1]."','".$res[2]."','".$res[3]."','".$res[4]."','".$dist."', '0', '0', '0', '0', '0', '', '".time()."')";
          echo $query;
          if(mysql_query($query)){
            echo '<br>done<br>';
          }
        }else if($_POST['action']=='mod'){
          switch($_POST['mod']){
            case 'rob':
              $query = "UPDATE kamaradi SET wood=(wood - ".$res[0]."), vine=(vine - ".$res[1]."), rock=(rock - ".$res[2]."), glass=(glass - ".$res[3]."), sira=(sira - ".$res[4]."), lastedit=".time()." WHERE id=".$_POST['id'];
              //echo $query;
              mysql_query($query);
              break;
            case 'scout':
              $query = "UPDATE kamaradi SET wood=".$res[0].", vine=".$res[1].", rock=".$res[2].", glass=".$res[3].", sira=".$res[4].", lastedit=".time()." WHERE id=".$_POST['id'];
              //echo $query;
              mysql_query($query);
              break;
            case 'del':
              mysql_query("DELETE FROM kamaradi WHERE id=".$_POST['id']);
              break;
            case 'pro':
              $query = "UPDATE kamaradi SET pWood=(".$res[0]." - wood), pVine=(".$res[1]." - vine), pRock=(".$res[2]." - rock), pGlass=(".$res[3]."- glass), pSira=(".$res[4]." - sira), lastedit=".time()." WHERE id=".$_POST['id'];
              //echo $query;
              mysql_query($query);
              break;
          }
        }else if($_POST['action']=='city'){
          $coords = explode(":", $_POST['coords']);
          $query = "UPDATE kamaradi SET name='".$_POST['name']."', is_x=".$coords[0].", is_y=".$coords[1]." WHERE id=1";
          echo $query;
          mysql_query($query);
          $change = mysql_query('SELECT * FROM  `kamaradi` WHERE id>1');
          while($ch = mysql_fetch_array($change)){
            $dist = sqrt((($ch['is_x']-$coords[0])*($ch['is_x']-$coords[0]))+(($ch['is_y']-$coords[1])+($ch['is_y']-$coords[1])));
            $query = "UPDATE kamaradi SET dist=".$dist." WHERE id=".$ch['id'];
            echo $query;
            mysql_query($query);
          }
        }
       } else {
          echo 'vypln vsechno';
       }     
      }
        //zapis lupu do souboru
         
        if($_POST['action']=='mod' && $_POST['mod']=='rob'){
          $soubor = fopen("lup.txt", "r+");
          $old = fread($soubor, filesize("lup.txt"));
          $sur = explode(";", $old); 
          $ukr = $_POST['wood']+$_POST['vine']+$_POST['rock']+$_POST['glass']+$_POST['sira'];
          if($_POST['kdo']=='z'){
            $sur[0] = $sur[0]+$ukr;
          }
          if($_POST['kdo']=='o'){
            $sur[1] = $sur[1]+$ukr;
          }
          $new = implode(";", $sur);
          rewind($soubor);
          fwrite($soubor, $new);
          fclose($soubor); 
        }
        $f = fopen("lup.txt", "r+");
        $o = fread($f, filesize("lup.txt"));
        $s = explode(";", $o);
        echo '<br>zbysek ukradl: '.round($s[0]/1000).'k, ondra: '.round($s[1]/1000).'k<br>';
        fclose($f);
        
        //pricitani produkce
        
        $cas = fopen("cas.txt", "r+");
        $oldTime = fread($cas, filesize("cas.txt"));
        echo $oldTime.'x'.time().'<br>';
        if((time()-$oldTime)>3600){
          $hours = round((time()-$oldTime)/3600);
          echo 'uplynulo '.$hours.' hodin<br />';
          //aktualizuj bunky
          $update = mysql_query('SELECT * FROM  `kamaradi` WHERE id>1');
          while($up = mysql_fetch_array($update)){
            $query = "UPDATE kamaradi SET wood=(wood + (".$hours."*pWood)), vine=(vine + (".$hours."*pVine)), rock=(rock + (".$hours."*pRock)), glass=(glass + (".$hours."*pGlass)), sira=(sira + (".$hours."*pSira)) WHERE id=".$up['id'];
            echo $query.'<br />';
            mysql_query($query);
          }
          rewind($cas);
          $newTime = ($oldTime + $hours*3600);
          fwrite($cas, $newTime);
        }else{
          echo 'jeste neuplynula ani jedna hodina<br />';
        }
        
        fclose($cas);
        
        
        //vypsani tabulky
        
        echo 'vzdalenost je pocitana od '.$posx.':'.$posy.'('.$pos['name'].')<br>';
        $res = mysql_query('SELECT * FROM  `kamaradi` WHERE id>1 ORDER BY dist');
        echo '<table border="1">';
        echo '<tr><td>id</td><td>coords</td><td>name</td><td><img src="ikony/Wood_small.png"></td><td><img src="ikony/Wine_small.png"></td><td><img src="ikony/Marble_small.png"></td><td><img src="ikony/icon_glass.png"></td><td><img src="ikony/Sulphur_small.png"></td><td>dist</td><td>Last Edit</td></tr>';
        while($result = mysql_fetch_array($res)){
          if($result['wood']<0 || $result['vine']<0 || $result['rock']<0 || $result['glass']<0 || $result['sira']<0){
            $f=true;
          }else{
            $f=false;
          }
          if($result['pWood']>0 || $result['pVine']>0 || $result['pRock']>0 || $result['pGlass']>0 || $result['pSira']>0){
            $p=true;
          }else{
            $p=false;
          }
          if($result['pWood']<0 || $result['pVine']<0 || $result['pRock']<0 || $result['pGlass']<0 || $result['pSira']<0){
            $pf=true;
          }else{
            $pf=false;
          }
          echo '<tr'.($f?' class="f"':($pf?' class="pf"':($p?' class="p"':''))).'><td>'.$result['id'].'</td><td>'.$result['is_x'].':'.$result['is_y'].'</td>
          <td>'.$result['name'].'</td>
          <td>'.round($result['wood']/1000).'k+'.$result['pWood'].'/hod</td>
          <td>'.round($result['vine']/1000).'k+'.$result['pVine'].'/hod</td>
          <td>'.round($result['rock']/1000).'k+'.$result['pRock'].'/hod</td>
          <td>'.round($result['glass']/1000).'k+'.$result['pGlass'].'/hod</td>
          <td>'.round($result['sira']/1000).'k+'.$result['pSira'].'/hod</td>
          <td>'.$result['dist'].'</td>
          <td'.((time()-$result['lastedit']>(24*60*60))?' class="f"':'').'>'.StrFTime("%d/%m %H:%M:%S", $result['lastedit']).'</td>';
        }
        echo '</table>';
    
    
            ?>     <br />    
    <a href="show.php">back</a>
    <br>      
    <a href="calc.php">kalkulacka</a>
    <br>        
  </body>
</html>