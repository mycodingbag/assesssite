<?php

function deleteDir($dirPath)
{
    if (!is_dir($dirPath)) {
        if (file_exists($dirPath) !== false) {
            unlink($dirPath);
        }
        return;
    }

    if ($dirPath[strlen($dirPath) - 1] != '/') {
        $dirPath .= '/';
    }

    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }

    rmdir($dirPath);
}

    if(isset($_POST['mode'])){
        $mode = $_POST['mode'];
        

        switch($mode){
            case 'shows':
                $adds = scandir('../images'.$_POST['addsdata']);
                $arr_data = json_encode($adds, JSON_PRETTY_PRINT);
                echo($arr_data);
            break;
            case 'delete':
                $items = $_POST['addsdata'];
                $itemtype = $_POST['itemtype'];

                if($itemtype=='folder'){
                    deleteDir('../images'.$items);

                }else if($itemtype == 'file'){
                    unlink('../images'.$items);
                }
                
            break;

            case 'newfolder':
                $adds = '../images'.$_POST['addsdata'];
                mkdir($adds);
                echo 'ok';
            break;
            
            case 'imgupload':

                if(!empty(array_filter($_FILES['imgupload']['name']))) { 
                    foreach ($_FILES['imgupload']['tmp_name'] as $key => $value) { 
                        $file_name = strtolower($_FILES['imgupload']['name'][$key]);
                        $file_tem_loc = $_FILES['imgupload']['tmp_name'][$key];
                        $file_store = '../images'.$_POST['uploaddir'].'/'.$file_name;

                        move_uploaded_file($file_tem_loc,$file_store);  
                    }
                }
                header("Location: gallery.html");

            break;

            default:
                echo 'not ok';
            break;
        }
    }

?>