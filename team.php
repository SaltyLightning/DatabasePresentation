<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/14/2018
 * Time: 10:25 AM
 */
session_start();
$tag = $_POST["name"];
if (isset($_SESSION["team"]))
    $c = count($_SESSION["team"]) + 1;
else
    $c = 2;
if (isset($tag) && isset($_POST["add$c"])){
    if (!isset($_SESSION["members"])){
        $_SESSION["members"][0] = $tag;
    }
    else{
        $_SESSION["members"][count($_SESSION["members"])] = $tag;
    }
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
                ."wins = $wins, losses = $losses, games_played = $gp, hero = \"$hname\""
                .    "WHERE tag = $tag";
        }
        $_SESSION['sql'] = $sql;
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully\n";
        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_SESSION["team"])) {
    if ($c == 2){
       $_SESSION["team"][0] = null;
    }
    else {
        for ($it = 1; $it < count($_SESSION["team"]); $it++) {
            if (isset($_POST["cur$it"])) {
                $_SESSION["team"][$it] = $_SESSION["team"][count($_SESSION["team"])];
                $_SESSION["team"][count($_SESSION["team"])] = null;
            }
        }
    }
}

//if (isset($_SESSION['name'])){
//    $servername = "localhost:3306";
//    $username = "root";
//    $password = "";
//    $dbname = "overwatch";
//// Create connection
//    $conn = mysqli_connect($servername, $username, $password, $dbname);
//    $name = $_SESSION['name'];
//// Check connection
//    if (!$conn) {
//        die("Connection failed: " . mysqli_connect_error());
//    }
//
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 450px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
        .hicons{
            height: 30px;
            width: 30px;
        }
    </style>
    <!--    <link href="main.css" rel="stylesheet">-->
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Overstatted</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <!--                <li class="active"><a href="#">Home</a></li>-->
                <!--                <li><a href="#">About</a></li>-->
                <!--                <li><a href="#">Projects</a></li>-->
                <!--                <li><a href="#">Contact</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><a href="suggestions.php">Suggestions</a></p>
            <p><a href="heroes.php">Hero Details</a></p>
            <p><a href="details.php">Overall Details</a></p>
            <p><a href="team.php">Team</a></p>
            <p><a href="clear.php">Clear</a></p>
        </div>
        <div class="col-sm-8 text-left">
            <h1>Team</h1>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">Team Member</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <form action="team.php" method="post">
                <?php

                if (isset($_SESSION["members"])) {
                    foreach ($_SESSION["members"] as $key => $member) {
                        echo "<tr>";
                        echo "<td>$member</td>";
                        echo "<td><button name=\"remove$key\" type=\"submit\" class=\"btn btn-primary btn-sm\">Remove from team</button></td>";
                        echo "</tr>";
                    }

                    if (count($_SESSION["members"]) < 6) {
                        $cur = count($_SESSION["members"]) + 1;
                        echo "<tr>";
                        echo "<td><input type=\"text\" name=\"name\" class=\"form-control form-control-lg\" placeholder=\"Enter your Battletag...\"></td>";
                        echo "<td><button name=\"del$cur\" class=\"btn btn-primary btn-sm\">Add team member</button></td>";
                        echo "</tr>";
                    }
                }
                else{
                    $cur = 2;
                    echo "<tr>";
                    echo "<td><input type=\"text\" name=\"name\" class=\"form-control form-control-lg\" placeholder=\"Enter your Battletag...\"></td>";
                    echo "<td><button name=\"add$cur\" class=\"btn btn-primary btn-sm\">Add team member</button></td>";
                    echo "</tr>";
                }
                ?>
                </form>
                </tbody>
            </table>
        </div>

    </div>
</div>
</div>

<footer class="container-fluid text-center">
    <p></p>
</footer>

</body>
</html>

