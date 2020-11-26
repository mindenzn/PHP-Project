<?php
/**
 * Check its logged in or not
 *
 * @return bool
 */
function is_logged_in()
{
    if ($_SESSION) {
        $fileDB = new FileDB(DB_FILE);
        $fileDB->load();
        return (bool) $fileDB->getRowWhere('users', [
            'email' => $_SESSION['email'],
            'password' => $_SESSION['password']
        ]);
    }

    return false;
}

/**
 * @param $redirect
 * $redirect i funkcija paduotas param kur norim nusiusti user pvz. ( index )
 * ir baigiamas Session.
 */
function logout($redirect = null): void
{
    session_destroy();
    $_SESSION = [];
    if ($redirect) {
        header("Location:$redirect.php");
    }

}

/**
 * redirectina user i kta page
 */
function redirect($location)
{
    header("location:$location");
}