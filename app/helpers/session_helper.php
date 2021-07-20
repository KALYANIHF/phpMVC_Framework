<?php
session_start();

// flash massage
function flash($name = '', $massage = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($massage) && empty($_SESSION[$name])) {
            // if server['name'] contain something then empty it
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            // if server[class_name] contain something then emtpy it
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            // if both are not set then set them
            $_SESSION[$name] = $massage;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($massage) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id-"msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;

    } else {
        return false;
    }
}
