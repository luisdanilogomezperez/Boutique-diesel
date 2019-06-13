<?php
if (isset($_SESSION["Cliente"])) {
    session_destroy();
    header("location:Inicio");
}
?>