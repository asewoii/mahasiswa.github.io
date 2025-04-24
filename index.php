<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plus Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/berkas/css/mahasiswa.css">
</head>

<body>
    <!-- PHP -->
    <?php
        // Data Koneksi ke database
        $__HOST = "127.0.0.1";
        $__DB   = "http://localhost/phpmyadmin/index.php?route=/database/structure&db=nyoman_magang";
        $__USER = "root";
        $__PW   = "";

        // Koneksi ke database
        $conn = new mysqli($__HOST, $__USER, $__PW, $__DB);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data mahasiswa
        $sql = "SELECT * FROM table_mahasiswa";
        $result = $conn->query($sql);

        $conn->close();

        // Menghapus data jika ada request DELETE
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];

            // Query untuk menghapus data
            $conn = new mysqli($__HOST, $__USER, $__PW, $__DB);
            $delete_sql = "DELETE FROM table_mahasiswa WHERE id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            // Redirect setelah penghapusan
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Update data jika ada request POST untuk update
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $jurusan = $_POST['jurusan'];

            // Query untuk mengupdate data
            $conn = new mysqli($__HOST, $__USER, $__PW, $__DB);
            $update_sql = "UPDATE table_mahasiswa SET nama = ?, nim = ?, jurusan = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssi", $nama, $nim, $jurusan, $update_id);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            // Redirect setelah pengupdatean
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    ?>
    <!-- ! CLOSE ! -->

    <!-- ! Navbar ! -->
    <nav class="nav_nyoman navbar navbar-expand-sm navbar-dark">
        <h1 class="judul_nby text-end">Table Mahasiswa</h1>
        <button class="plus_mahasiswa " type="button" data-bs-target="#mahasiswaplus" data-bs-toggle="modal">Tambah Data
            Mahasiswa</button>
    </nav>
    <!-- ! CLOSE ! -->

    <!-- Pesan Sukses/Error -->

    <!-- ! CLOSE ! -->

    <!-- Form untuk Menambah Data Mahasiswa -->
    <div class="modal_nby modal" id="mahasiswaplus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="judul_input_m modal-title">Mahasiswa</div>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button> <!-- LOGO CLOSE -->
                </div>

                <div class="modal-body">
                    <form class="row g-1" action="/mahasiswa" method="POST" id="inputdatamahasiswabro">
                        <label for="name" class="form-text">Name</label>
                        <input class="form-control" type="text" name="nama" placeholder="Masukan Nama" required>

                        <label for="jurusan" class="form-text">Jurusan</label>
                        <select class="form-select" aria-label="Default select example" type="text" name="jurusan"
                            id="listjurusan" required>
                            <option selected disabled hidden>Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>

                        <label for="nim" class="form-text">Nim</label>
                        <input class="form-control" type="text" name="nim" placeholder="Masukan Nim" required>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="bt_nby_broo btn btn-primary" type="submit" form="inputdatamahasiswabro">save data
                        mahasiswa</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ! CLOSE ! -->

    <!-- edit -->
    <div class="modal" id="editmahasiswa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Edit Mahasiswa</div>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form class="g-1" action="" method="POST" id="editdatamahasiswabro">
                        <input type="hidden" name="update_id" id="update_id">

                        <label for="nama" class="form-text">Name</label>
                        <input class="form-control" type="text" name="nama" id="update_nama" placeholder="Masukan Nama"
                            required>

                        <label for="jurusan" class="form-text">Jurusan</label>
                        <select class="form-select" type="text" name="jurusan" id="update_jurusan" required>
                            <option selected disabled hidden>Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>

                        <label for="nim" class="form-text">Nim</label>
                        <input class="form-control" type="text" name="nim" id="update_nim" placeholder="Masukan Nim"
                            required>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="bt_nby_broo btn btn-primary" type="submit" form="editdatamahasiswabro">update data
                        mahasiswa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ! Table Data Mahasiswa ! -->
    <div class="container mt-3">
        <table class="table">
            <thead class="table-dark">
                <tr class="hmm_table_mahasiswa">
                    <th class="hmm_text_mahasiswa">No</th>
                    <th>Name</th>
                    <th>Nim</th>
                    <th>Jurusan</th>
                    <th>Date</th>
                    <th>Update</th>
                    <th>Delet</th>
                </tr>
            </thead>

            <?php
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['nim']}</td>
                            <td>{$row['jurusan']}</td>
                            <td>{$row['updated_at']}</td>
                            <td><button class='btn btn-warning' onclick='editData({$row['id']}, \"{$row['nama']}\", \"{$row['nim']}\", \"{$row['jurusan']}\")' data-bs-toggle='modal' data-bs-target='#editmahasiswa'>Edit</button></td>

                            <td><a href='?delete_id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "
                    <div class='alert alert-info alert-dismissible fade show'>
                        <strong>Data Kosong!</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>";
            }?>
        </table>
    </div>
    <!-- ! CLOSE ! -->

    <!-- ! Mahasiswa ! -->
    <script>
        document.getElementById('listjurusan').value = jurusan; // select jurusan

        function editData(id, nama, nim, jurusan) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_nama').value = nama;
            document.getElementById('update_jurusan').value = jurusan;
            document.getElementById('update_nim').value = nim;
        }
    </script>
    <!-- ! CLOSE ! -->


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>