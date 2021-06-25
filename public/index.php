<?php
$jsonmachtigingen = file_get_contents('http://localhost:3000/machtigingen');
$machtigingen = json_decode($jsonmachtigingen);

$jsonpersonen = file_get_contents('http://localhost:3000/personen');
$personen = json_decode($jsonpersonen);

$gebruiker = 2;
$website = "SVB";


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css">
    <title></title>
  </head>
  <body>
    <?php
    echo "<h1>" .  $website . "</h1>";
    echo "<h4>Alle machtigingen van instantie:</h4>";



    $gefilterdemachtigingen = array_keys(array_column($machtigingen, 'instantie'), $website);
    // var_dump($keys);
    foreach ($gefilterdemachtigingen as $machtiging) {
      echo $machtigingen[$machtiging]->naam;
      echo "<br>";
    };



    ?>


    <br><br><p><h4>Met DigiD ingelogde gebruiker:</h4></p>
    <?php

    $ingelogd = array_search($gebruiker, array_column($machtigingen, 'id'));
    echo $personen[$ingelogd]->naam;

    ?>


    <br><br><br><p></p>
    <?php
    echo "<h4>Dit zijn zijn actieve machtigingen:</h4>";
    foreach ($personen[$ingelogd]->machtigingen as $machtiging) {
      // var_dump($machtiging);
      if (in_array($machtiging, $gefilterdemachtigingen)) {
        echo $machtigingen[$machtiging]->naam;
        echo "<br>";
      }
    }

    // echo $machtigingen[$key]->naam;


    echo "<br><br><br><h4>Dit zijn machtigingen die nog open staan en aangevraagd kunnen worden op deze website:</h4>";
    foreach ($gefilterdemachtigingen as $machtiging) {
      // var_dump($machtiging);
      if (in_array($machtiging, $personen[$ingelogd]->machtigingen)) {

      }
      else {
        echo $machtigingen[$machtiging]->naam;
        echo "<br>";
      }
    }
    // echo $machtigingen[$key]->naam;

    ?>


    <br><br><br><br><br><h4></h4>
    <p id="jsdata"></p>
    <script type="text/javascript">
    //  fetch('http://localhost:3000/machtigingen')
    //    .then(response => response.json())
    //    .then(data => {
    //      console.log(data)
    //      document.querySelector("#jsdata").innerText = data[1]["naam"]
    //    })
    </script>
  </body>
</html>
