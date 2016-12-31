<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SMIME Decrypter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.min.css">
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
        table {
            table-layout: fixed;
        }
        th {
            border: 1px solid #ddd !important;
            text-align: center;
        }
        td {
            border: 1px solid #ddd !important;            
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
                      <input type="file" name="msg" id="msg" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="cert"><p style="float:left;">P12 Certificate</p>:</label>
                    <div class="col-sm-8">
                      <input type="file" name="cert" id="cert" class="form-control" required>
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
                        <th>File Name</th>
                        <th width="20%">Upload Time</th>
                        <th width="7%">Delete</th>
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
</body>
</html>