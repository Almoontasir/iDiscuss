<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
        session_start();
       
        if(isset($_SESSION['login']))
        {
            session_unset();
            session_destroy();
            $logout = "true";

        }
        else
        {
            $logout = "false";
        }
        header("location:/php/harry/foram/index.php?logout=$logout");
}
?>