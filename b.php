<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>  
  <head>  
    <meta http-equiv="content-type" content="text/html; charset=utf-8">  
    <meta name="generator" content="PSPad editor, www.pspad.com">  
    <title>
    </title>  
  </head>  
  <body> 
  <form method="post">
  <textarea rows="5" cols="60" name="c"></textarea>  
  <input type="submit">
  </form>
  
  <?php 

    function get_numerics ($str) {
      preg_match_all('/\d+/', $str, $matches);
      return $matches[0];
    } 
    if(!empty($_POST['c'])){
      $text = chop($_POST['c']);
      $pole = get_numerics($text);
      $lup = 0;
      for($i=0;$i<count($pole);$i++){
        $lup = $lup + $pole[$i];
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
    }
     ?> 
  </body>
</html>