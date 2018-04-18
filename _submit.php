<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/13/2018
 * Time: 5:57 PM
 */
session_start();
$tag = $_POST["name"];
if (isset($tag) && $tag !== "") {
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

    mysqli_autocommit($conn, false);

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
//    if ($name == null || !isset($name) || $name === ""){
//        $_SESSION["notfound"] = true;
//        header("Location: index.php");
//    }
    $sr = $decoded["profile"]["rank"];
    $rank = $decoded["profile"]["ranking"];
    $wins = $decoded["competitive"]["global"]["games_won"];
    $losses = $decoded["competitive"]["global"]["games_lost"];
    $gp = $decoded["competitive"]["global"]["games_played"];
    $winrate =  round(($wins / $gp) * 100);
    if (!$new_user) {
        $update = "UPDATE player SET sr = $sr WHERE tag = \"$tag\"";
    }
    else{
        $update = "INSERT INTO player(tag, sr) VALUES (\"$tag\", $sr)";
    }
    $_SESSION['str'] = $update;
    if ($conn->query($update) === TRUE) {
        $_SESSION['added'] = true;
       // echo "New record created successfully\n";
    } else {
//        $_SESSION["notfound"] = true;
//        header("Location: index.php");
    }
    if ($new_user) {
        $update = "INSERT INTO general_stats( winrate, wins, losses, games_played, tag) VALUES"
            . "($winrate, $wins, $losses, $gp, \"$tag\")";
    }
    else{
        $update = "UPDATE general_stats SET winrate = $winrate, "
        ."wins = $wins, losses = $losses, games_played = $gp "
        .    "WHERE tag = \"$tag\" AND "
        .    "hero IS NULL";
    }
//    if (!isset($_SESSION['sql']))
//        $_SESSION['sql'] = $update ."\n";
//    else
//        $_SESSION['sql'] .= $update ."\n";
    if ($conn->query($update) === TRUE) {
        //echo "New record created successfully\n";
    } else {
        $_SESSION["notfound"] = true;
        $_SESSION["sql"] = $update;
        header("Location: index.php");
    }
//    echo $url;
    foreach ($decoded["competitive"]["heroes"] as $hname => $hero){
        $sql = "SELECT * from general_stats WHERE tag = \"$tag\" AND hero = \"$hname\"";
        $results = $conn->query($sql);
        $new_hero;
        if (!isset($results) || !$results || $results->num_rows == 0) {
            $new_hero = true;
//            $_SESSION["sql"] .= $hname . "    ";
        }
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
        if ($new_hero) {
            $sql = "INSERT INTO general_stats(winrate, wins, losses, games_played, tag, hero) VALUES"
                . "($winrate, $wins, $losses, $gp, \"$tag\", \"$hname\")";
            $_SESSION["sql"] .= "True ($hname)   ";

        }
        else{
            $sql = "UPDATE general_stats SET winrate = $winrate, "
                ."wins = $wins, losses = $losses, games_played = $gp, hero = \"$hname\""
                .    "WHERE tag = \"$tag\"";
            $_SESSION["sql"] .= "False($hname)   ";

        }
//        if (!isset($_SESSION['sql']))
//            $_SESSION['sql'] = $sql ."\n";
//        else
//            $_SESSION['sql'] .= $sql ."\n";
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully\n";
        } else {
            $_SESSION["notfound"] = true;
            $_SESSION["sql"] = $sql;
            header("Location: index.php");
        }
        $conn->commit();
        $conn->close();
    }
    $_SESSION['new_user'] = $new_user;
    $_SESSION['notfound'] = false;
    $_SESSION['sql'] = count($decoded["competitive"]["heroes"]);
    header("Location: details.php");
    exit;
}
else{
    $_SESSION["notfound"] = true;
    unset($_SESSION["tag"]);
    header("Location: index.php");
}
?>
<html></html>
