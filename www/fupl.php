<?php


        $error_types = array(
        1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        'The uploaded file was only partially uploaded.',
        'No file was uploaded.',
        6=>'Missing a temporary folder.',
        'Failed to write file to disk.',
        'A PHP extension stopped the file upload.'
        );

        // Outside a loop...
        if($_FILES['file']['error']==0) { // here userfile is the name i.e(<input type="file" name="*userfile*" size="30" id="userfile">
         echo"no error ";
        } else {
          $error_message = $error_types[$_FILES['file']['error']];
          echo $error_message;
        } 

     if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
       
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'fups/' . $_FILES['file']['name']);
        echo 'Moved: ' . $_FILES['file']['tmp_name'] . 'TEST<br>';
    }

?>