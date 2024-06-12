<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link rel="icon" type="image/png" href="http://localhost/suryajaya/assets/img/bookstore.jpg"/>
        <link href="http://localhost/suryajaya/assets/css/styles.css" rel="stylesheet" />
        <script src="http://localhost/suryajaya/assets/js/all.min.js"></script>
    </head>
    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>    
                                    <div class="card-body">
                                    <?php 
                                        if(isset($_GET['gagal'])){
                                            echo '
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Username atau Password salah!</strong><br> silahkan cek username dan password kembali.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                                        } 
                                        ?>
                                        <form action="../controllers/Userolah.php" method="POST">
                                            <!-- <div class="alert alert-danger" role="alert">
                                                Username atau Password salah
                                            </div> -->
                                            <div class="form-group">
                                                <label class="small mb-1" for="username">Username</label>
                                                <input class="form-control py-4" id="username" type="text" name="username" required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" id="password" type="password" name="password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="login">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">System by Citra Ratu Sona, G20 Sistem Informasi Politeknik Caltex Riau</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>  
        <script src="http://localhost/suryajaya/assets/js/jquery-3.4.1.min.js"></script>
        <script src="http://localhost/suryajaya/assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
