<?php
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nomor = $mobil = $alamat = "";
$namaErr = $emailErr = $nomorErr = $alamatErr = "";

// Fungsi untuk membersihkan input
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk validasi formulir
function validateForm($nama, $email, $nomor, $alamat) {
    $errors = [];

    if (empty($nama)) {
        $errors['nama'] = "Nama wajib diisi";
    } else {
        $nama = validateInput($nama);
    }

    if (empty($email)) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid!";
    } else {
        $email = validateInput($email);
    }

    if (empty($nomor)) {
        $errors['nomor'] = "Nomor Telepon wajib diisi";
    } elseif (!ctype_digit($nomor)) {
        $errors['nomor'] = "Nomor Telepon harus berupa angka";
    } else {
        $nomor = validateInput($nomor);
    }

    if (empty($alamat)) {
        $errors['alamat'] = "Alamat wajib diisi";
    } else {
        $alamat = validateInput($alamat);
    }

    return $errors;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <h1>Quick<span>Rent</span></h1>
        </div>
        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#kami.php" >Tentang Kami</a></li>
            <li><a href="#">Ulasan</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="#login-section" class="auth-link">Masuk</a></li>
            <li><a href="#register-section" class="auth-link">Daftar</a></li>
        </ul>
    </nav>

    <div class="container" style="margin-top: 30px;">
        <h2>Form Penyewaan Mobil</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Telepon:</label>
                <input type="text" id="nomor" name="nomor" value="<?php echo $nomor; ?>">
                <span class="error"><?php echo $nomorErr ? "* $nomorErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                    <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Motor">Motor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nama_kendaraan">Nama Kendaraan:</label>
                <input type="text" id="nama_kendaraan" name="nama_kendaraan" placeholder="Masukkan nama kendaraan" required>
            </div>

            <div class="form-group">
                <label for="mulai_sewa">Mulai Sewa:</label>
                <input type="date" id="mulai_sewa" name="mulai_sewa" required>
            </div>

            <div class="form-group">
                <label for="selesai_sewa">Selesai Sewa:</label>
                <input type="date" id="selesai_sewa" name="selesai_sewa" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat"><?php echo $alamat; ?></textarea>
                <span class="error"><?php echo $alamatErr ? "* $alamatErr" : ""; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Konfirmasi Penyewaan</button>
            </div>
        </form>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$alamatErr) { ?>
    <div class="container">
        <h3>Data Pembelian:</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="20%">Nama</th>
                        <th width="20%">Email</th>
                        <th width="30%">Alamat Pengiriman</th>
                        <th width="20%">Jenis Kendaraan</th>
                        <th width="20%">Model Kendaraan</th>
                        <th width="15%">Tanggal Sewa</th>
                        <th width="15%">Tanggal Kembali</th>
                        <th width="30%">Catatan Tambahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td><?php echo $jenis_kendaraan; ?></td>
                        <td><?php echo $model_kendaraan; ?></td>
                        <td><?php echo $tanggal_sewa; ?></td>
                        <td><?php echo $tanggal_kembali; ?></td>
                        <td><?php echo $catatan_tambahan; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</body>

</html>