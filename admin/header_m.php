<?php
  session_start();
  if (!(isset($_SESSION['activeuser'])) ) {
     // echo '<script>alert("hello");</script>';
    header("Location: /assess classes/admin/login.html");
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />      
        <title>Assess Admin</title>
        <link rel="shortcut icon" href="../images/assess icon.png" type="image/x-icon">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>


    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">
                <img src="../images/logo.png" alt="assess classes"></a>
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
                    <i class="fas fa-bars fa-2x"></i>
                </button>
            <!-- Navbar Logout btn-->
            <form action="..\codeengine.html" method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <input type="hidden" name="mode" value="logout">
                <button type="submit" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">&nbsp;</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon">
                                   <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Report</div>
                            <a class="nav-link" href="enquirylist.html">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                 Enquirys
                            </a>
                            <a class="nav-link" href="subscriber.html">
                                <div class="sb-nav-link-icon">
                                <i class="fas fa-at"></i>
                                </div>
                                Subscribers
                            </a>

                            <div class="sb-sidenav-menu-heading">Setting</div>
                            <a class="nav-link" href="changepassword.html">
                                <div class="sb-nav-link-icon">
                                <i class="fas fa-key"></i>
                                </div>
                                Change Password
                            </a>
                            <a class="nav-link" href="gallery.html">
                                <div class="sb-nav-link-icon">
                                <i class="far fa-images"></i>
                                </div>
                                Gallery
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin Mode
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">


