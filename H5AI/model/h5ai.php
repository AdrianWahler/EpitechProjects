<?php

    ini_set('display_errors', '1');
    ini_set('log_errors', '0');

    class H5AI
    {   
        private $_path;
        private $_tree;

        function __construct() {

            if ( isset($_GET["pathName"]) && $_GET["pathName"] != "null"){
                $this->_path =  "../../".$_GET["pathName"];
            } else {
                $this->_path = "../../";
            }

            try
            {
                $db = new PDO('mysql:host=localhost;dbname=h5ai;charset=utf8', 'root', '');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
            $statement = $db->prepare("SELECT * FROM tags WHERE tags.path = ?");
            $statement->execute([$_GET["pathName"]]);

            $this->_tagList = $statement->fetchAll();            
            $this->_directoryTree = [];
            $this->_currentFiles = $this->getFiles($this->_result,"../../");

            $this->_result = [$this->_result,$this->_tagList];
            echo json_encode($this->_result);
        }

        function getPath(){

            return $this->_path;

        }

        function getTree(){

            return $this->_tree;

        }

        function getFiles(&$fileList, $parent){

            $handler = opendir($parent);
            $numberOfFiles = 0;

            while (false !== ($entry = readdir($handler))) {
                if (!is_dir($parent."/".$entry) && $entry != "." && $entry != ".."){
                    $fileList[] = array("type"=>"file",
                        "name"=>$entry,
                        "size"=>stat($parent."/".$entry)["size"],
                        "modified"=>gmdate("Y-m-d  H:i:s",stat($parent."/".$entry)["mtime"]),
                        //"fileType"=>mime_content_type($parent."/".$entry)
                    );

                    if (explode(".",$fileList[$numberOfFiles]["name"])[count(explode(".",$fileList[$numberOfFiles]["name"]))-1] == "txt" ||
                        explode(".",$fileList[$numberOfFiles]["name"])[count(explode(".",$fileList[$numberOfFiles]["name"]))-1] == "html" ||
                        explode(".",$fileList[$numberOfFiles]["name"])[count(explode(".",$fileList[$numberOfFiles]["name"]))-1] == "php") {
                        $fileList[$numberOfFiles]["fileContent"] = file_get_contents($parent."/".$entry);
                    }

                    $numberOfFiles++;
                } else if ($entry != "." && $entry != ".."){
                    $fileList[$entry] = array("type"=>"directory",
                        "name"=>$entry,
                        "modified"=>gmdate("Y-m-d  H:i:s",
                        stat($parent."/".$entry)["mtime"]),
                        "content"=>[]
                    );
                    $this->getFiles($fileList[$entry]["content"],$parent."/".$entry);
                }
            }
        }

        function getDirectories(&$fileList, $parent){

            $handler = opendir($parent);

            while (false !== ($entry = readdir($handler))) {
                if (is_dir($parent."/".$entry) && $entry != "." && $entry != ".."){
                    $fileList[$entry] = [];
                    $this->getDirectories($fileList[$entry],$parent."/".$entry);
                }
            }   
        }
    }

$test = new H5AI();
    