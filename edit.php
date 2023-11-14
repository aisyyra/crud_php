<?php
include("koneksi.php");
include("layout/header.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
    //ambil data dari db
    $query = "SELECT * FROM data_siswa WHERE id = $id";
    $result = $koneksi ->query($query);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $jurusan = $row['jurusan'];
        $foto = $row['foto'];
    }else {
        echo "data tidak di temukan";
        exit();
    }

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $jurusan =$_POST['jurusan'];

    //upload gambar
    $foto = 'default.jpg';
    if($_FILES['foto']['error'] === 0){
        if ($foto != "default.jpg"){
            unlink('uploads/' . $foto);
        }
        $extension = pathinfo($foto, PATHINFO_EXTENSION); //ambil extension dari file gambar
        $foto = time() . '_' . rand(1000, 9999) . '.' . $extension; //ubah nama file + kasih extension

        $destination = 'uploads/' . $foto; //path file yang diupload

        move_uploaded_file($_FILES['foto']['tmp_name'], $destination); //memindahkan file yang diupload ke dalam path yang sudah di definisikan
    }

    //updte ke database
    $query = "UPDATE data_siswa SET nama = ?, jurusan = ?, foto = ? WHERE id = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("sssi", $nama, $jurusan, $foto, $id);
    $result = $statement->execute();

    if($result){
        header("Location: index.php");
    } else {
        echo "Error" . $query ."<br>" . $koneksi->error;
    }
}
?>

<!-- content -->
<form method="POST" enctype="multipart/form-data">
    <label class="form-label">Nama :</label>
    <input type="text" name="nama" class="form-control mb-3" value="<?php echo $nama; ?>" required>
    <label class="form-label">Jurusan :</label>
    <input type="text" name="jurusan" class="form-control mb-3 " value="<?php echo $jurusan; ?>" required>
    <label class="form-label">Foto :</label>
    <input type="file" name="foto" class="form-control mb-3" accept="image/*">
    <img src="uploads/<?php echo $foto; ?>">
    <a href="index.php" class="btn btn-secondary">Back</a>
    <input type="submit" class="btn btn-primary" name="update" value="Tambah">
</form>

<?php
    include("layout/footer.php");
?>