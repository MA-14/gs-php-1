<!-- リセットがうまく機能しない！！！ -->


<?php
//勝敗に応じて書き込み用ファイル作成
$winfile="win.txt";
$losefile="lose.txt";
$drawfile="draw.txt";
$score0="score0.txt";
$score1="score1.txt";
$score2="score2.txt";
$score3="score3.txt";
$score4="score4.txt";
$score5="score5.txt";
$score6="score6.txt";
$score7more="score7more.txt";

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,"UTF-8");
}

//勝敗予想をパーセンテージで出す
function rate($a,$b,$c){
  return round($a/($a+$b+$c)*100);
}

if ($_SERVER['REQUEST_METHOD']=='POST'){

  if (isset($_POST["getscore"]) && isset($_POST["lostscore"])){
    $name= trim($_POST['name']);
    $name = ($name==='')? '名無し':$name;
    $name = str_replace("\t", " ",$name);

    $comment= trim($_POST['comment']);
    $comment = str_replace("\t", " ",$comment);

    $getScore= $_POST["getscore"];
    $lostScore= $_POST["lostscore"];
    $postedAt = date('Y/m/d H:i:s');
  }else{
    $getScore= "";
    $lostScore= "";
  }

  if ($getScore!=="" && $lostScore!==""){

    $newData = $name . "\t" . $getScore . "\t".$lostScore ."\t".$comment ."\t".$postedAt . "\n";
    
    if ($getScore > $lostScore){
      $fp = fopen($winfile, 'a');
      fwrite($fp, $newData);
      fclose($fp);
    }elseif($getScore < $lostScore){
      $fp = fopen($losefile, 'a');
      fwrite($fp, $newData);
      fclose($fp);
    }elseif((int)$getScore === (int)$lostScore){
      $fp = fopen($drawfile, 'a');
      fwrite($fp, $newData);
      fclose($fp);
    }

    //得点に応じて、該当ファイルに０を記入
      if ((int)$getScore===0){
        $fp = fopen($score0, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==1){
        $fp = fopen($score1, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==2){
        $fp = fopen($score2, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==3){
        $fp = fopen($score3, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==4){
        $fp = fopen($score4, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==5){
        $fp = fopen($score5, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($getScore==6){
        $fp = fopen($score6, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }elseif($lostScore>=7){
        $fp = fopen($score7more, 'a');
        fwrite($fp, 0);
        fclose($fp);
      }

      //失点に応じて、該当ファイルに１を記入
      if ((int)$lostScore===0){
        $fp = fopen($score0, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==1){
        $fp = fopen($score1, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==2){
        $fp = fopen($score2, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==3){
        $fp = fopen($score3, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==4){
        $fp = fopen($score4, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==5){
        $fp = fopen($score5, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore==6){
        $fp = fopen($score6, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }elseif($lostScore>=7){
        $fp = fopen($score7more, 'a');
        fwrite($fp, 1);
        fclose($fp);
      }
  }
}

  $winPosts =file($winfile,FILE_IGNORE_NEW_LINES);
  $winPosts =array_reverse($winPosts);
  
  $losePosts =file($losefile,FILE_IGNORE_NEW_LINES);
  $losePosts =array_reverse($losePosts);
  
  $drawPosts =file($drawfile,FILE_IGNORE_NEW_LINES);
  $drawPosts =array_reverse($drawPosts); 

  //ファイル内の0、1の数を数える
  $find0 = '/0/';
  $find1 = '/1/';

  //得点それぞれの予想数
  $get_score_vote0 = preg_match_all($find0,file("score0.txt")[0]);
  $get_score_vote1 = preg_match_all($find0,file("score1.txt")[0]);
  $get_score_vote2 = preg_match_all($find0,file("score2.txt")[0]);
  $get_score_vote3 = preg_match_all($find0,file("score3.txt")[0]);
  $get_score_vote4 = preg_match_all($find0,file("score4.txt")[0]);
  $get_score_vote5 = preg_match_all($find0,file("score5.txt")[0]);
  $get_score_vote6 = preg_match_all($find0,file("score6.txt")[0]);
  $get_score_vote7more = preg_match_all($find0,file("score7more.txt")[0]);

  //失点それぞれの予想数
  $lost_score_vote0 = preg_match_all($find1,file("score0.txt")[0]);
  $lost_score_vote1 = preg_match_all($find1,file("score1.txt")[0]);
  $lost_score_vote2 = preg_match_all($find1,file("score2.txt")[0]);
  $lost_score_vote3 = preg_match_all($find1,file("score3.txt")[0]);
  $lost_score_vote4 = preg_match_all($find1,file("score4.txt")[0]);
  $lost_score_vote5 = preg_match_all($find1,file("score5.txt")[0]);
  $lost_score_vote6 = preg_match_all($find1,file("score6.txt")[0]);
  $lost_score_vote7more = preg_match_all($find1,file("score7more.txt")[0]);  

  //ファイルの中身を削除するファンクション
  function deleateContent($f){
    $fp = fopen($f, "w");
    fclose($fp);
  }

  if(isset($_POST['reset'])) {
      deleateContent($score0);
      deleateContent($score1);
      deleateContent($score2);
      deleateContent($score3);
      deleateContent($score4);
      deleateContent($score5);
      deleateContent($score6);
      deleateContent($score7more);
      deleateContent($winfile); 
      deleateContent($losefile);
      deleateContent($drawfile);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>巨人戦予想掲示板</title>
</head>

<body>
  <h1 class="title">みんなの巨人戦予想</h1>
  <div class="titlemessage">今日の巨人戦のスコアを予想しよう</div>
  <h2>投票</h2>
  <div class="form">
    <form action="" method ="post">
      名前　　：<input type="text" name="name">
      <br>
      得点　　：<input type="number" name="getscore" min="0" max="100">
      <br>
      失点　　：<input type="number" name="lostscore" min="0" max="100">
      <br>
      コメント：<input name="comment" size=40>
      <input type="submit" value="投票">
    </form>
  </div>

<h2>みんなの投票分析</h2>
<div class="allcharts">
  <div class="win_lose_rate chart_wrapper">
    <p>勝敗予想</p>
    <div id="vote_none1">・投稿はありません</div>
    <div class="result_figure figures" style="width:350px">
      <canvas id="mychart1" class="mychart1"></canvas>
    </div>
  </div>

  <div class="getScore_rate chart_wrapper">
    <p>得点数予想</p>
    <div id="vote_none2">・投稿はありません</div>
    <div class="getScore_figure figures" style="width:350px">
      <canvas id="mychart2" class="mychart2"></canvas>
    </div>
  </div>

  <div class="lostScore_rate chart_wrapper">
    <p>失点数予想</p>
    <div id="vote_none3">・投稿はありません</div>
    <div class="lostScore_figure figures" style="width:350px">
      <canvas id="mychart3" class="mychart3"></canvas>
    </div>
  </div>

</div>

<h2 class="commentall">みんなの投票一覧</h2>
  <div class="vote_all">
      <div class="win_vote comment">
        <p class="vote_title">勝ち予想（<?php echo count($winPosts);?>件）</p>
        <ul class="win_vote_content">
          <?php if (count($winPosts)!==0): ?>
          <?php foreach($winPosts as $post):?>
          <?php list($name, $getScore, $lostScore, $comment)= explode("\t",$post); ?>
          <li><?php echo h($getScore);?> vs <?php echo h($lostScore);?> - <?php echo h($comment);?> (<?php echo h($name); ?>) </li>
          <?php endforeach; ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
      <div class="lose_vote comment">
        <p class="vote_title">負け予想（<?php echo count($losePosts);?>件）</p>
        <ul class="lose_vote_content">
          <?php if (count($losePosts)!==0): ?>
          <?php foreach($losePosts as $post):?>
          <?php list($name, $getScore, $lostScore, $comment)= explode("\t",$post); ?>
          <li><?php echo h($getScore);?> vs <?php echo h($lostScore);?> - <?php echo h($comment);?> (<?php echo h($name); ?>) </li>
          <?php endforeach; ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
      <div class="draw_vote comment comment">
        <p class="vote_title">引き分け予想（<?php echo count($drawPosts);?>件）</p>
        <ul class="draw_vote_content">
        <?php if (count($drawPosts)!==0 && isset($drawPosts)): ?>
          <?php foreach($drawPosts as $post):?>
          <?php list($name, $getScore, $lostScore, $comment)= explode("\t",$post); ?>
          <li><?php echo h($getScore);?> vs <?php echo h($lostScore);?> - <?php echo h($comment);?> (<?php echo h($name); ?>) </li>
          <?php endforeach; ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
  </div>

  <form  method="post">
    <button type="submit" name="reset">リセット</button>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // 予想がある時に図を表示
    <?php if(count($winPosts) !==0 || count($losePosts) !==0 || count($drawPosts) !==0): ?>
      document.getElementById("vote_none1").style.display ="none";
      document.getElementById("vote_none2").style.display ="none";
      document.getElementById("vote_none3").style.display ="none";

      var ctx = document.getElementById('mychart1');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['勝ち', '引き分け', '負け'],
          datasets: [{
            data: [<?php echo rate(count($winPosts),count($losePosts),count($drawPosts)); ?>, <?php echo rate(count($drawPosts),count($winPosts),count($losePosts));?>, <?php echo rate(count($losePosts),count($drawPosts),count($winPosts)); ?>],
            backgroundColor: ['#f88', '#484', '#48f'],
            weight: 100,
          }],
        },
      });
      var ctx = document.getElementById('mychart2');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['0点', '1点', '2点', '3点', '4点','5点','6点', '7点以上'],
          datasets: [{
            data: [<?php echo $get_score_vote0 ?>,<?php echo $get_score_vote1 ?>,<?php echo $get_score_vote2 ?>,<?php echo $get_score_vote3 ?>,<?php echo $get_score_vote4 ?>,<?php echo $get_score_vote5 ?>,<?php echo $get_score_vote6 ?>,<?php echo $get_score_vote7more ?>],
            backgroundColor: ['#e6b8c2','#f88','#e68a9e','#e65c7a','#e62e56','#ff0037','#cc002c','#990021'],
            weight: 100,
          }],
        },
      });
      var ctx = document.getElementById('mychart3');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['0点', '1点', '2点', '3点', '4点','5点','6点', '7点以上'],
          datasets: [{
            data: [<?php echo $lost_score_vote0 ?>,<?php echo $lost_score_vote1 ?>,<?php echo $lost_score_vote2 ?>,<?php echo $lost_score_vote3 ?>,<?php echo $lost_score_vote4 ?>,<?php echo $lost_score_vote5 ?>,<?php echo $lost_score_vote6 ?>,<?php echo $lost_score_vote7more ?>],
            backgroundColor: ['#abcbd9', '#82bdd9', '#57b0d9','#2ba2d9','#0095d9','#00aeff','#008bcc','#006999'],
            weight: 100,
          }],
        },
      });
    //予想がない時は図を非表示
    <?php else: ?>  
      document.getElementById("vote_none").style.display ="block";
    <?php endif ?>
  </script>
</body>
</html>