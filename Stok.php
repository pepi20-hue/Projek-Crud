<?php
include 'db/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="status.php">Diskominfo</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link" href="Stok.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stok Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Status</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Status Barang
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">Barang Ready</a>
                                <a class="nav-link" href="#">Barang Hilang</a>
                                <a class="nav-link" href="#">Barang Rusak</a>
                                <a class="nav-link" href="#">Barang Digunakan</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Diskominfo
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Admin</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Stok Barang</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Barang
                            </button>
                            <i class="fas fa-table me-1"></i>
                            Stok Barang
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama barang</th>
                                        <th>Status</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tablestk= mysqli_query($conn, "SELECT * FROM stok_barang");
                                    $i = 1;
                                    while($data = mysqli_fetch_array($tablestk)){   
                                        $namabarang = $data['nama_barang'];
                                        $status = $data['status'];
                                        $stok = $data['stok'];
                                        $idb = $data['id'];
                                    ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$namabarang?></td>
                                        <td><?=$status?></td>
                                        <td><?=$stok?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>">Edit</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idb;?>">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                <div class="modal fade" id="edit<?=$idb;?>" tabindex="-1" aria-labelledby="editModalLabel<?=$idb;?>" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="editModalLabel<?=$idb;?>">Edit Barang</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                <div class="modal-body">
                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                <input type="text" name="nama_barang" value="<?=$namabarang;?>" class="form-control" required><br>
                                <select class="form-control" name="status" required>
                                    <option value="ready" <?=$status == 'ready' ? 'selected' : '';?>>Ready</option>
                                    <option value="hilang" <?=$status == 'hilang' ? 'selected' : '';?>>Hilang</option>
                                    <option value="rusak" <?=$status == 'rusak' ? 'selected' : '';?>>Rusak</option>
                                    <option value="digunakan" <?=$status == 'digunakan' ? 'selected' : '';?>>Digunakan</option>
                                </select><br>
                                <button type="submit" class="btn btn-primary" name="editbarang">Edit</button>
                            </div>
            </form>
        </div>
    </div>
</div>


                                    <!-- Delete Modal -->
<div class="modal fade" id="delete<?=$idb;?>" tabindex="-1" aria-labelledby="deleteModalLabel<?=$idb;?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deletebarang<?=$idb;?>">Delete Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <strong><?=$namabarang;?></strong>?</p>
                    <input type="hidden" name="idhapus" value="<?=$idb;?>">
                    <button type="submit" class="btn btn-danger" name="hapusbarang">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                    <?php 
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required><br>
                    <select class="form-control" name="status" required>
                        <option value="ready">Ready</option>
                        <option value="hilang">Hilang</option>
                        <option value="rusak">Rusak</option>
                        <option value="digunakan">Digunakan</option>
                    </select><br>
                    <input type="number" name="stok" placeholder="Stok" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="tambahbarang">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>
