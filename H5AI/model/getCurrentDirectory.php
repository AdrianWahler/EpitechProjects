<?php
    ini_set('display_errors', '1');
    ini_set('log_errors', '0');


    
    if ( isset($_GET["pathName"]) ){
        $path =  $_GET["pathName"];
    } else {
        $path = "";
    }

    $scannedFiles = scandir("../".$path);
    $directories = [];  
    $files = [];

    foreach ($scannedFiles as $key => $file) {
        if (is_dir("../".$path."/".$file)){
            $directories[] = $file;
        } else {
            $files[] = $file;
        }
    }

    echo '<table class="table table-striped">
        <thead>
        <tr>
            <th class="col-6" scope="col">Name</th>
            <th class="col-4" scope="col">Last Modified</th>
            <th class="col-2" scope="col">Size</th>
        </tr>
        </thead>
        <tbody>';

    if ($path != ""){
        echo '<tr onclick=goToPreviousDirectory()>
            <td>'."<- Previous".'</td>
            <td></td>
            <td></td>
        </tr>';
    }
        
    foreach ($directories as $key => $file) {
        $stats = stat("../".$path."/".$file);
        

        echo '<tr onclick=changeDirectory("'.$file.'")>
            <td>'.$file.'</td>
            <td>'.gmdate("Y-m-d  H:i:s", $stats["mtime"]).'</td>
            <td>-</td>
        </tr>';
    }
        
    foreach ($files as $key => $file) {
        $stats = stat("../".$path."/".$file);
        

        echo '<tr>
            <td>'.$file.'</td>
            <td>'.gmdate("Y-m-d  H:i:s", $stats["mtime"]).'</td>
            <td>'.$stats["size"].'</td>
        </tr>';
    }   
        
    echo '</tbody>
    </table>';