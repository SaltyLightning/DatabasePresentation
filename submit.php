<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/13/2018
 * Time: 5:57 PM
 */
session_start();
$tag = $_POST["name"];
if (isset($tag)) {
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "overwatch";
// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $ch = curl_init();
    $url = "https://owjs.ovh/overall/pc/us/$tag";
    $sql = "SELECT * from player WHERE tag = \"$tag\"";
    $results = $conn->query($sql);
    $_SESSION['num'] = $results->num_rows;

    $new_user = $results->num_rows == 0;

// Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
    curl_setopt($ch, CURLOPT_URL, $url);
// Execute
    $result = curl_exec($ch);
// Closing
    curl_close($ch);
    $decoded = json_decode($result, true);

    $name = $decoded["profile"]["nick"];
    $sr = $decoded["profile"]["rank"];
    $rank = $decoded["profile"]["ranking"];
    $wins = $decoded["competitive"]["global"]["games_won"];
    $losses = $decoded["competitive"]["global"]["games_lost"];
    $gp = $decoded["competitive"]["global"]["games_played"];
    $winrate =  round(($wins / $gp) * 100);
    $elims = $decoded["competitive"]["global"]["eliminations"] / $gp;
    $deaths = $decoded["competitive"]["global"]["deaths"];
    if (!isset($deaths))
        $deaths = 1;
    $ed = $elims /  $deaths;
    $final_blows = $decoded["competitive"]["global"]["final_blows"] / $elims;
    $healing = $decoded["competitive"]["global"]["healing_done"];
    if (!isset($decoded["competitive"]["global"]["healing_done"]))
        $healing = 0;
    if (!$new_user) {
        $update = "UPDATE player SET sr = $sr WHERE tag = $tag";
    }
    else{
        $update = "INSERT INTO player(tag, sr) VALUES (\"$tag\", $sr)";
    }
    $_SESSION['str'] = $update;
    if ($conn->query($update) === TRUE) {
        $_SESSION['added'] = true;
       // echo "New record created successfully\n";
    } else {
        $_SESSION['added'] = false;
    }
    if ($new_user) {
        $sql = "INSERT INTO general_stats( winrate, wins, losses, games_played, tag) VALUES"
            . "($winrate, $wins, $losses, $gp, \"$tag\")";
    }
    else{
        $sql = "UPDATE general_stats SET winrate = $winrate, "
        ."wins = $wins, losses = $losses, games_played = $gp "
        .    "WHERE tag = \"$tag\" AND hero IS NULL";
    }
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO team(team_leader) VALUE(\"$tag\")";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    foreach ($decoded["competitive"]["heroes"] as $hname => $hero){
        $sql = "SELECT * from general_stats WHERE tag = \"$tag\" AND hero = $hname";
        $results = $conn->query($sql);
        if (isset($hero["games_won"]))
            $wins = $hero["games_won"];
        else
            $wins = 0;
        if (!isset($hero["games_lost"]))
            $losses = $hero["games_lost"];
        else
            $losses = 0;
        if (isset($hero["games_played"]))
            $gp = $hero["games_played"];
        else
            $gp = 0;
        if (isset($hero["win_percentage"]))
            $winrate = $hero["win_percentage"];
        else
            $winrate = 0;
        if (isset($hero["eliminations"]))
            $elims = $hero["eliminations"] / ($gp >= 1 ? $gp : 1);
        else
            $elims = 0;
        if (isset($hero["deaths"]))
            $deaths = $hero["deaths"] / ($gp >= 1 ? $gp : 1);
        else
            $deaths = 1;
        $ed = $elims / $deaths;
        if ($elims > 0) {
            if (isset($hero["final_blows"]))
                $final_blows = $hero["final_blows"] / $hero["eliminations"];
            else
                $final_blows = 0;
        }
        else
            $final_blows = 0;
        if (isset($hero["healing_done"]))
            $healing = $hero["healing_done"] / ($gp >= 1 ? $gp : 1);
        else
            $healing = 0;

        if ($new_user) {
            $sql = "INSERT INTO general_stats(winrate, wins, losses, games_played, tag, hero) VALUES"
                . "($winrate, $wins, $losses, $gp, \"$tag\", \"$hname\")";
        }
        else{
            $sql = "UPDATE general_stats SET winrate = $winrate, "
                ."wins = $wins, losses = $losses, games_played = $gp, hero = \"$hname\""
                .    "WHERE tag = $tag";
        }
//        $_SESSION['sql'] = $sql;
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully\n";
        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($new_user) {
            $sql = "INSERT INTO cat_stats(elims, deaths, final_blows, healing, tag, hero) VALUES"
                . "($elims, $deaths, $final_blows, $healing, \"$tag\", \"$hname\")";
        }
        else{
            $sql = "UPDATE cat_stats SET deaths = $deaths, "
                ."elims = $elims, final_blows = $final_blows, healing = $healing "
                .    "WHERE tag = $tag AND hero = \"$hname\"";
        }
//        $_SESSION['sql'] .= $sql;
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully\n";
        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $_SESSION['name'] = $tag;
    $_SESSION['new_user'] = $new_user;
    header("Location: details.php");
    exit;
}

?>
<html>
<body>
<a href="index.php">Go back to the previous page</a>
</body>
</html>
