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
        .    "WHERE tag = $tag";
    }
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    foreach ($decoded["competitive"]["heroes"] as $hname => $hero){
        $sql = "SELECT * from general_stats WHERE tag = \"$tag\" AND hero = $hname";
        $results = $conn->query($sql);
        $wins = $hero["games_won"];
        if (!isset($wins))
            $wins = 0;
        $losses = $hero["games_lost"];
        if (!isset($losses))
            $losses = 0;
        $gp = $hero["games_played"];
        if (!isset($gp))
            $gp = 0;
        $winrate = $hero["win_percentage"];
        if (!isset($winrate))
            $winrate = 0;
        if ($new_user) {
            $sql = "INSERT INTO general_stats(winrate, wins, losses, games_played, tag, hero) VALUES"
                . "($winrate, $wins, $losses, $gp, \"$tag\", \"$hname\")";
        }
        else{
            $sql = "UPDATE general_stats SET winrate = $winrate, "
                ."wins = $wins, losses = $losses, games_played = $gp, hero = $hname "
                .    "WHERE tag = $tag";
        }
        $_SESSION['sql'] = $sql;
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
