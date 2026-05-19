<?php
## Validation if there is no session 
if (session_status() === PHP_SESSION_NONE) {
    ## Protect cookies from getting stolen with js (Prevents cross-site Skripting)
    ini_set('session.cookie_httponly', 1);

    ## Lifetime of garbage Collector -> After 8h php deletes session data automatically 
    ini_set('session.gc_maxlifetime',8 * 60* 60);
    ## Lifetime of cookies in browser -> Cookies die when browser gets closed
    ini_set('session.cookie_maxlifetime',8 * 60* 60);
    ## Starts session - only now $_SESSION available
    session_start();
}
## Function to check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['userId']);
}
## Function to move user to login-page
function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: index.php?page=login');
        exit;
    };
}

