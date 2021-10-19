<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        ini_set('desplay_errors',1);
        error_reporting(E_ALL);
        
        require_once 'lib/Application.php';
        
        $application = new Application();
        $application->dispatch();
        
        ?>
    </body>
</html>
