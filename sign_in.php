<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/16/2018
 * Time: 11:34 PM
 */?>
<head>
    <link rel="stylesheet" href="sign.scss">
</head>
<div class="wrapper">
    <form class="form-signin">
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
</div>