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
 			$checkedFormat = true;
 		}
 		else if($cert_ext == "p12") {
 			
 		}
 		else {
 			$checkedFormat = false;
 		}
 		if($checkedFormat) {
 			move_uploaded_file($file_tmp, ("./tmp/" . $file_name));
 			move_uploaded_file($cert_tmp, ("./tmp/" . $cert_name));
 			$out = shell_exec('openssl smime -decrypt -in ' . '"./tmp/' . $file_name . '" -inkey ' . '"./tmp/' . $cert_name . '" -inform DER -passin pass:' . $_POST['pass']);
 			unlink("./tmp/" . $file_name);
 			unlink("./tmp/" . $cert_name);
 			if(empty($out)) {
		 		$_SESSION['valid'] = 'There is an error while decrypting';
 			}
 			else {
	 			$start = strpos($out,"quoted-printable") + 18;
	    		$start = substr($out, $start);
	    		$end = strpos($start,"--------------") - 2;
	    		$message = substr($start, 0, $end);
		 		$_SESSION['valid'] = 'Decryption success!';
		 		$tmp = "key" . $_SESSION['idx'];
		 		$_SESSION['dataUpload'][$tmp] = "<tr><td>" . $file_name . "</td><td>" . $uploadTime . "</td><td><form action=\"app.php\" method=\"post\" enctype=\"multipart/form-data\"><input type=\"hidden\" value=\"" . $file_name . "\" name=\"hapus\"/><input type=\"hidden\" value=\"" . $_SESSION['idx'] . "\" name=\"idxHapus\"/><input type=\"Submit\" value=\"Delete\" name=\"submit\"/></form></td><td>" . $message . "</td>";
		 		$_SESSION['idx'] += 1;
		 	}
	 	}
	 	else {
	 		$_SESSION['valid'] = 'Unsupported certificate format, only accept .p12 and .pem';
	 	}
 	}
 	else {
 		$_SESSION['valid'] = 'Unsupported message format, only accept .p7m';
 	}
 	header("location: index.php");
}
else {
	echo "hah";
}

if(isset($_POST['hapus'])) {
	unlink("./uploads/" . $_POST['hapus']);
	$tmp = "key" . $_POST['idxHapus'];
	unset($_SESSION['dataUpload'][$tmp]);
	header("location: index.php");
}