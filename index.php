<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SMIME Decrypter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.min.css">
    <style>
        th {
            border: 1px solid #ddd !important;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 3vh;">
        <div class="col-md-5">
            <form class="form-horizontal" action="app.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="msg"><p style="float:left;">Pesan</p>:</label>
                    <div class="col-sm-8">
                      <input type="file" name="msg" id="msg" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="cert"><p style="float:left;">P12 Certificate</p>:</label>
                    <div class="col-sm-8">
                      <input type="file" name="cert" id="cert" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="pass"><p style="float:left;">Password</p>:</label>
                    <div class="col-sm-8">
                      <input type="password" name="pass" id="pass" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <input type="submit" value="Upload" name="submit" class="btn btn-default">
                    </div>
                </div>
            </form>
        </div>

        <?php
            if(isset($_SESSION['valid'])) {
                echo $_SESSION['valid'];
                unset($_SESSION['valid']);
            }
            if(!isset($_SESSION['dataUpload'])) {
                $_SESSION['dataUpload'] = array();
            }
            if(!isset($_SESSION['idx'])) {
                 $_SESSION['idx'] = 0;
            }   
        ?>
        <div class="result">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th width="20%">Waktu Upload</th>
                        <th width="7%">Hapus</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_SESSION['dataUpload'])) {
                            foreach($_SESSION['dataUpload'] as $fileInfo) {
                                echo $fileInfo;
                            }  
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <?php
            //$out = shell_exec('openssl smime -decrypt -in smime.p7m -inkey cert.pem -inform DER -passin pass:JJSrRU');
            //echo $out;
            // $p12Content = file_get_contents("./cert.p12");
            // openssl_pkcs12_read($p12Content, $certs, "JJSrRU");
            // $tes = file_get_contents("./cert.crt.pem");
            // $tes2 = file_get_contents("./cert.key.pem");
            // openssl_pkcs7_decrypt("./smime.p7m", "./decryptedMsg.txt", $tes, $tes2);
            // if(openssl_pkcs7_decrypt("./smime.p7m", "./decryptedMsg.txt", $tes . $tes2)) {
            //     print_r("A");
            // }
            // else {
            //     print_r("B");
            // }
            // print_r(file_get_contents("./decryptedMsg.txt"));
            //print_r(openssl_pkcs7_verify("./decryptedMsg.txt", PKCS7_DETACHED));
        ?>
    </div>

    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>