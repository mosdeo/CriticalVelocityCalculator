<?php
  //Study for pass HTML var to PHP.
  header("Content-Type:text/html; charset=utf-8"); //使中文正常顯示
  
  //取陣列平均
  function AvgOfArray($Array)
  {
    $tempSum=0;
    for($i=0;$i<count($Array);$i++)
    {
      $tempSum += $Array[$i];
    }
    return $tempSum/count($Array);
  }

  //從HTML取得陣列值
  $Distance = array($_POST['Distance0'],$_POST['Distance1'],$_POST['Distance2']);
  if(NULL == $Distance[0]) $Distance[0]=1500;
  if(NULL == $Distance[1]) $Distance[1]=800;
  if(NULL == $Distance[2]) $Distance[2]=400;
  
  $RaceTime = array($_POST['RaceTime0'],$_POST['RaceTime1'],$_POST['RaceTime2']);
  if(NULL == $RaceTime[0]) $RaceTime[0]=2500;
  if(NULL == $RaceTime[1]) $RaceTime[1]=1000;
  if(NULL == $RaceTime[2]) $RaceTime[2]=480;
  
  //計算平均的最佳速度和距離
  $AvgDistance = AvgOfArray($Distance);
  $AvgRaceTime = AvgOfArray($RaceTime);

  //(T-MT)
  $T_AvgT = array();
  for($i=0;$i<count($RaceTime);$i++)
  {
    $T_AvgT[$i] = $RaceTime[$i] - $AvgRaceTime;
  }
  
  //(D-MD)
  $D_AvgD = array();
  for($i=0;$i<count($Distance);$i++)
  {
    $D_AvgD[$i] = $Distance[$i] - $AvgDistance;
  }
  
  //Sum((T-MT)(D-MD))/Sum((T－MT)^2)
  $CV = ($D_AvgD[0]*$T_AvgT[0] + $D_AvgD[1]*$T_AvgT[1] + $D_AvgD[2]*$T_AvgT[2])/
        (pow($T_AvgT[0],2) + pow($T_AvgT[1],2) + pow($T_AvgT[2],2));
  $CV =  number_format($CV,2);
  $min_Per_km = number_format((1000.0/$CV)/60.0,1);
?>
<style type="text/css">
  .body {
    font-size: 20px;
    font-family: "微軟正黑體", "新細明體";
    }
  .title {
    font-family: "微軟正黑體", "新細明體";
    color: #006600;
    font-weight: bold;
    margin-bottom:-10px;
  }
  .Subtitle {
    font-family: "微軟正黑體", "新細明體";
    color:#00CC66;
    font-weight: bold;
    margin-bottom:50px;
  }
  .label {
    font-size: 38px;
    font-family: "微軟正黑體", "新細明體";
    color: #006600;
    font-weight: bold;
  }
 .input {
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 38px;
    color: #00CC66;
    border-top-width: 3px;
    border-right-width: 3px;
    border-bottom-width: 3px;
    border-left-width: 3px;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: solid;
    border-left-style: none;
    border-top-color: #FF5FAA;
    border-right-color: #FF5FAA;
    border-bottom-color: #006600;
    border-left-color: #FF5FAA;
    font-weight: bold;
    height: 45px;
    width: 100%;
    max-width: 120px;
    text-align: center;
  }
.button {
    font-family: "微軟正黑體", "新細明體";
    font-size: 38px;
    color: black;
    font-weight: bold;
    background-color: #00CC66;
    text-align: center;
    vertical-align: middle;
    height: 100%;
    width: 90%;
    max-width: 350px;
    border-radius:5px;
    border: 5px solid #006600;
  }
</style>

<html>
  <head>
    
    <title>臨界速度計算機(Critical Velocity Calculator)</title>
    <!-- made by Lin Kao-Yuan, mosdeo@gmail.com -->
    <!-- This is my first PHP project! -->
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
      ga('create', 'UA-64570213-1', 'auto');
      ga('send', 'pageview');
    </script>
  </head>
  <body bgcolor="#CCFFCC">
    <div align="center">
      <form action="CriticalVelocityCalculator.php" method="post">
        <table class="body">
          <caption class="title" style="font-size:38px">臨界速度計算機</caption>
          <tr>
            <th colspan="3"><a class="Subtitle">不會累積疲勞的最高速度</a></th>
          </tr>
          <tr>
            <th></th>
            <th>項目(m)</th>
            <th>時間(sec)</th>
          </tr>
          <tr>
            <th>
              第一種<br>
              最佳成績<br>
            </th>
            <th><input type="text" name="Distance0" value="<?php echo $Distance[0];?>" class="input"/></th>
            <th><input type="text" name="RaceTime0" value="<?php echo $RaceTime[0];?>" class="input"/></th>
          </tr>
          <tr>
            <th>
              第二種<br>
              最佳成績<br>
            </th>
            <th><input type="text" name="Distance1" value="<?php echo $Distance[1];?>" class="input"/></th>
            <th><input type="text" name="RaceTime1" value="<?php echo $RaceTime[1];?>" class="input"/></th>
          </tr>
          <tr>
            <th>
              第三種<br>
              最佳成績<br>
            </th>
            <th><input type="text" name="Distance2" value="<?php echo $Distance[2];?>" class="input"/></th>
            <th><input type="text" name="RaceTime2" value="<?php echo $RaceTime[2];?>" class="input"/></th>
          </tr>
          <tr>
            <th colspan="3">
              <div style="background-color:#99C299;">
                <button class="button">按此計算</button><br>
                <input class="input" readonly="readonly" name="txtOutput" value="<?php echo $CV;?>"/><a class="label">m/s</a><br>
                <a class="label">每公里</a><input class="input" readonly="readonly" name="txtOutput" value="<?php echo $min_Per_km;?>"/><a class="label">分鐘</a>
              </div>
            </th>
          </tr>
          <tr>
            <th colspan="3" style="font-size:12px;">
              <br>
              <a>公式與學理是跟據</a><br>
              <a>《運動生理學 林正常》臺北市:師大書苑出版</a><br>
            </th>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>