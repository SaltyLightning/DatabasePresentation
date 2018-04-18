<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/14/2018
 * Time: 10:25 AM
 */
session_start();
if (isset($_SESSION['name'])){
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "overwatch";
// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $name = $_SESSION['name'];
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT AVG(winrate), catagory FROM general_stats INNER JOIN hero_friendly ON api_name = hero ".
        "WHERE tag = \"$name\" GROUP BY Catagory ORDER BY AVG(winrate) DESC";

    $best_cat = $conn->query($sql);
    if ($best_cat->num_rows !== 0) {
        // echo "New record created successfully\n";
    } else {
//        header("Location: details.php")
    }

    $sql = "SELECT MAX(games_played), catagory FROM general_stats INNER JOIN hero_friendly ON api_name = hero ".
        "WHERE tag = \"$name\" GROUP BY Catagory ORDER BY games_played";

    $most_played = $conn->query($sql);

    $sql = "SELECT friendly_name, winrate, catagory  FROM general_stats INNER JOIN hero_friendly ON api_name = hero ".
        "WHERE tag = \"$name\" AND games_played >= 1 AND winrate = " .
        "(SELECT MAX(winrate) FROM general_stats WHERE tag = \"$name\" AND games_played >= 1)";

    $best_hero = $conn->query($sql);
    if ($best_hero->num_rows !== 0) {
        // echo "New record created successfully\n";
    } else {
        echo 'failed';
    }
    $best_hero = $best_hero->fetch_array();
    $hero = $best_hero[0];

    $sql = "SELECT sr FROM player ".
        "WHERE tag = \"$name\"";
    $sr = $conn->query($sql);
    $sr = $sr->fetch_array()[0];
    $sql = "SELECT rank, sr FROM ranks ".
        "WHERE sr > $sr ORDER BY ranks.sr ASC";

    $rank_stats = $conn->query($sql);

    $sql = "SELECT * from cat_stats where hero = \"$hero\" and tag = \"$name\"";
    $best_stats = $conn->query($sql);

    $sql = "SELECT * from overall_stats where Hero = \"$hero\"";
    $overall_b = $conn->query($sql);
//    echo $sr;
//    if ($best_hero->num_rows !== 0) {
//        // echo "New record created successfully\n";
//    } else {
////        header("Location: details.php")
//    }
}
else{
    $heroes[0]["hero"] = "Not found";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Overstatted</title>
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
        .row.content {height: 2000px}

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
<!--                <li>--><?php //echo $name ?><!--</li>-->
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
    <?php
        $best_cat = $best_cat->fetch_array();
        $cat = $best_cat[1];
        $avg = number_format((float) $best_cat[0], 2, '.', '');
        $most_played_cat = $most_played->fetch_array()[1];
        if ($cat !== $most_played_cat){
            $mess4 = "You play <strong>$most_played_cat</strong> the most, but your best category is <strong>$cat</strong>.";
        }
        else{
            $mess4 = "You play <strong>$most_played_cat</strong> the most, and you're good at it. Keep it up!.";
        }
        if ($cat === $best_hero[2]){
            $is_cat = "is ";
        }
        else
            $is_cat = "is not ";
        $hwr = number_format((float) $best_hero[1], 2, '.', '');
        $rank_stats = $rank_stats->fetch_array();
        $dist = $rank_stats[1] - $sr;
        $rank = $rank_stats[0];
        if ($avg > 50)
            $num_games = ceil(($dist / 20) / ($avg / 100));
        else{
            $dist = $sr - ($rank_stats[1] - 500);
            $num_games = ceil(($dist / 20) / ($avg / 100));
        }
        if ($sr >= 4000){
            $mess = "you're already a grandmaster.";

        }
        else {
            if ($avg > 50) {
                $mess = "you will reach the next rank (<strong>$rank</strong>) in <strong>$num_games</strong> games";
            } else {
                $mess = "you will not reach the next rank <strong>($rank)</strong> (<50% winrate). In fact, you will derank in <strong>$num_games</strong> games.";
            }
        }


        if ($hwr > 50)
            $num_games = ceil(($dist / 20) / ($hwr / 100));
        else{
            $dist = $sr - ($rank_stats[1] - 500);
            $num_games = ceil(($dist / 20) / ($hwr / 100));
        }
        if ($sr >= 4000){
            $mess2 = "you're already a grandmaster.";
        }
        else {
            if ($hwr > 50) {
                $mess2 = "you will reach the next rank (<strong>$rank</strong>) in $num_games games (your are $dist sr away)";
            }
            else {
                $mess2 = "you will not reach the next rank (<strong>$rank</strong>) (<50% winrate). In fact, you will derank in $num_games games.";
            }
        }
        $overall_b = $overall_b->fetch_assoc();
        $best_stats = $best_stats->fetch_assoc();
        $improvements = "";
        $average_e = $overall_b["Elims"];
        $your_e = $best_stats["elims"];
        $average_f = number_format((float) $overall_b["Final_Blows"] * 100, 2, '.', '');
        $your_f = number_format((float) $best_stats["final_blows"] * 100, 2, '.', '');
        $average_h = $overall_b["Healing"];
        $your_h = $best_stats["healing"];
        if ($average_e > $your_e)
            $improvements .= " <strong>eliminations</strong>(avg=<strong>$average_e</strong>,yours=<strong>$your_e</strong>)";
        if ($average_f > $your_f)
            $improvements .= " <strong>final-blows</strong>(avg=<strong>$average_f%</strong>,yours=<strong>$your_f%</strong>)";
        if ($average_h > $your_h && $average_h != 0)
            $improvements .= " <strong>healing</strong>(avg:<strong>$average_h</strong>,yours:<strong>$your_h</strong>)";

        if (!isset($improvements)){
            $mess3 = "You are already above average for all of your stats on <strong>$hero</strong>, so keep it up!";
        }
        else {
            if (substr_count($improvements, ' ') > 1){
                $improvements = str_replace(" ", ', ', substr($improvements, 1));
                $improvements = str_replace('final-blows', 'final blows', $improvements);

                $t = "these";
            }
            else
                $t = "this";
            $mess3 = "To improve your <strong>$hero</strong>, you should work on$improvements. You are at or below average in $t.";
        }
    ?>
        <div class="col-sm-2 sidenav">
            <p><a href="suggestions.php">Suggestions</a></p>
            <p><a href="heroes.php">Hero Stats</a></p>
            <p><a href="details.php">Winrate Details</a></p>
            <p><a href="overall.php">Overall Stats</a></p>
<!--            <p><a href="clear.php">Clear</a></p>-->
        </div>
        <div class="col-sm-8 text-left">
            <?php
            echo "<h1>Suggestions for $name</h1>";
            echo "<h3>You should be focusing on playing <strong>$cat</strong>. It is your highest winrate category at <strong>$avg%</strong></h3>";

            echo "<hr>";

            echo "<h3>$mess4</h3>";

            echo "<hr>";

            echo "<h3>Your best hero is <strong>$hero</strong> (winrate: <strong>$hwr%</strong>), which $is_cat in your highest winrate category</h3>";

            echo "<hr>";

            echo "<h3>If you played your best catagory at you current level, $mess</h3>";

            echo "<hr>";

            echo "<h3>If you played your best hero at you current level, $mess2</h3>";

            echo "<hr>";

            echo "<h3>$mess3</h3>"

            ?>
        </div>

    </div>
</div>
</div>

<footer class="container-fluid text-center">
    <p></p>
</footer>

</body>
</html>

