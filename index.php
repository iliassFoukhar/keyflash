<!DOCTYPE HTML>
<html>
<head>
  <title>Key Flash</title>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Iliass Foukhar">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">

  <script type="text/javascript" src="words.js"></script>
  <script type="text/javascript" src="typer.js"></script>

  <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
  <nav align="center">
    <a id="titlee" align="center" href="index.html">
      <h3 align="center" id="title">Key Flash</h3>
    </a>
    </nav>
  <div id="firstSec">
    <div id="playSec">
      <form action="submission.php" method="post" name="formulaire">
      <h4 class='label' align="center">What's your name ?</h4><br>
      <table id="game" align="center">
        <tr>
          <td class="nothing" style="color :white;">000CPM</td>
          <td>
            <input type="text" align="center" id="typingZone2" name="nom" placeholder="Type you name...">
          </td>
          <td class="nothing" style="color :white;">000CPM</td>
        </tr>
      </table>
      <div id="inputsHidden">
        <input type="hidden" name="cpm" class="hiddens">
        <input type="hidden" name="wpm" class="hiddens">
        <input type="hidden" name="err" class="hiddens">
      </div>
      <!-----  The Actual Game ------>
      <h4 class='label' align="center">Wanna give it try ?</h4><br>
      <table id="game" align="center">
        <tr>
          <td></td>
          <td align="center" id="wordy"><span id="quote"  class="displays quote">Word</span></td>
          <td></td>
        </tr>
          <tr>
            <td></td>
            <td>
              <input type="text" align="center" id="typingZone" class="typingZone" name="typing" placeholder="Type anything to start the game !">
            </td>
            <td></td>
          </tr>
          <tr id="paramRow">
            <td id="params"><span id="cpm" class="displays cpm">000</span><span class="green">CPM</span>
              <br><span id="wpm" class="displays wpm">000</span><span class="orange">WPM</span>
              <br><span id="err" class="displays err">000</span><span class="counter">Err</span>
            </td>
            <td id="timer" align="center">TIMER <br><br><span id="counter" class="counter displays">60</span></td>
            <td><input id="button_b" class ="buttonn" type="submit" name="done" value="Submit"></td>
          </tr>
      </table>
    </form>
    </div>
    <!------------  SCORING ------->
    <div id="scoreSec">
    <h4 class='label' align="center">TOP 10</h4>
    <div id="tablesScoring">
    <table id="scoresTable" align="center">

        <?php
        //connection to the DAATABASE
        try {
      $dbh = new PDO('mysql:host=localhost;port=3308;dbname=typerr', "root", "");
      $dbh->exec("SET character_set_connection = 'utf8'");
      $dbh->exec("SET NAMES 'UTF8'");
      $rank = 1;
      foreach($dbh->query('SELECT * from score ORDER BY wpm DESC LIMIT 10') as $row) {
          echo "<tr>";
          echo "<td class='scoreName whity'>".$rank."- </td>";
          echo "<td class='scoreName orangy'>".$row[1]." </td>";//1 = name
          echo "<td class='scoreValue orangy'><span class='whity'>".$row[2]."</span>WPM</td>";//wpm = wpm
          echo "</tr>";
          $rank++;
      }

  }
  catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
  }
      ?>

    </table>
    <table id="scoresTable2" align="center">
      <?php
      $rank = 1;
      foreach($dbh->query('SELECT * from score ORDER BY cpm DESC LIMIT 10') as $row) {
          echo "<tr>";
          echo "<td class='scoreName'>".$rank."- </td>";
          echo "<td class='scoreName greeny'>".$row[1]." </td>";//1 = name
          echo "<td class='scoreValue'>".$row[3]."<span class='greeny'>CPM</span></td>";//wpm = wpm
          echo "</tr>";
          $rank++;
      }

      ?>
    </table>
  </div>
  </div>
  </div>
  <footer>
      <h5 align="center" id="myName">Developed by : Iliass Foukhar</h5>
      <h6 align="center" style="font-size: 11px;position:relative; bottom : 2px;" id="myName">nextgendevelopement@gmail.com</h6>
  </footer>
</body>
</html>
