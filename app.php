<?php 
if (! $_POST) {echo "400 Bad Request"; die();} session_start();
if(isset($_FILES['msg']) && isset($_FILES['cert'])) {
	$file_name = $_FILES['msg']['name'];
	$cert_name = $_FILES['cert']['name'];
	
	$file_size = $_FILES['msg']['size'];
	if($file_size > 1000000) {
		$file_size = round($file_size / 1048576, 2) . " MB";
	}
	else if($file_size > 1024) {
		$file_size = round($file_size / 1024, 2) . " KB";
	}
	else {
		$file_size .= " B";
	}
	
	$file_tmp = $_FILES['msg']['tmp_name'];
	$cert_tmp = $_FILES['cert']['tmp_name'];
 	
 	$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
 	$cert_ext = pathinfo($cert_name, PATHINFO_EXTENSION);

 	$time = date_create(null, timezone_open("Asia/Jakarta"));
 	$uploadTime = date_format($time, "d-m-Y H:m:s");
 	
 	if(($file_ext == "p7m") && $file_size <= 4194304) {
 		if($cert_ext == "pem") {
 			move_uploaded_file($file_tmp, ("./tmp/" . $file_name));
 			move_uploaded_file($cert_tmp, ("./tmp/" . $cert_name));
 			$out = shell_exec('openssl smime -decrypt -in ' . '"./tmp/' . $file_name . '" -inkey ' . '"./tmp/' . $cert_name . '" -inform DER -passin pass:' . $_POST['pass'] . ' 2>&1');
 			unlink("./tmp/" . $file_name);
 			unlink("./tmp/" . $cert_name);
 			$start = strpos($out,"quoted-printable") + 18;
    		$start = substr($out, $start);
    		$end = strpos($start,"--------------") - 2;
    		$message = substr($start, 0, $end);
            echo $message;
 			echo "pop";
	 		// move_uploaded_file($file_tmp, ("./uploads/".$file_name));
	 		// $_SESSION['valid'] = 'File berhasil diupload';
	 		// array_push($_SESSION['dataUpload'], "<tr><td>" . $file_name . "</td><td>" . $file_size . "</td><td>" . $uploadTime . "</td><td><form action=\"app.php\" method=\"post\" enctype=\"multipart/form-data\"><input type=\"hidden\" value=\"" . $file_name . "\" name=\"hapus\"/><input type=\"hidden\" value=\"" . $_SESSION['idx'] . "\" name=\"idxHapus\"/><input type=\"Submit\" value=\"Hapus\" name=\"submit\"/></form></td><td>" .  . "</td>");
	 		// $_SESSION['idx'] += 1;
	 	}
	 	else {
	 		echo $cert_ext;
	 	}
 	}
 	else {
 		$_SESSION['valid'] = 'File gagal divalidasi, tidak bisa diupload';
 	}
 	//header("location: index.php");
}
else {
	echo "hah";
}

if(isset($_POST['hapus'])) {
	unlink("./uploads/" . $_POST['hapus']);
	unset($_SESSION['dataUpload'][$_POST['idxHapus']]);
	header("location: index.php");
}