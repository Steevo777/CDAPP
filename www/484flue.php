<?PHP
if ($_POST) {
    define('UPLOAD_DIR', './fups/');
    $img = $_POST['image'];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $unid = uniqid() . '.jpg';
    $file = UPLOAD_DIR . $unid;
    $success = file_put_contents($file, $data);
    //print $success ? $file : 'Unable to save the file.';
    $data = $success ? array('file' => $unid,'status' => 'success') : array('file' => '','status' => 'error');
	echo json_encode($data);    
}

?>