<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>H5AI</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="http://localhost/H5AI/jquery3.js"></script>
    <script src="http://localhost/H5AI/model/script.js"></script>
    <link href="http://localhost/H5AI/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="body">
<?php
    echo $path.'<script type="text/javascript">getCurrentDirectory("'.$_GET["pathName"].'")</script>';
?>
<div class="row">
    <input type="text" id="searchBar" placeholder="Type here to search..." oninput="searchByName()">
    <div class="col-3 directoryTreeContainer" id="directoryTree">
        
    </div>
    <div class="col-9" id="fileTable">
        
    </div>
</div>

</body>