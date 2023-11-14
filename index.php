<?php
include("koneksi.php");
include("layout/header.php");

$query = "SELECT * FROM data_siswa";
$result = $koneksi->query($query);
?>

<!-- konten -->
<a href="create.php" class="btn btn-primary mb-3">tambah</a>
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Foto</th>
        <th>Action</th>
    </tr>

    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            //read data
    ?>
        <tr>
            <td><?php echo "{$row['id']}" ?></td>
            <td><?php echo "{$row['nama']}" ?></td>
            <td><?php echo "{$row['jurusan']}" ?></td>
            <td>
                <img src="uploads/<?php echo "{$row['foto']}" ?>" width="100">
            </td>
        <td>
            <a href="edit.php?id= <?php echo "{$row['id']}" ?>" class="btn btn-warning">Edit</a>
            <a href="delete.php?id=<?php echo "{$row['id']}" ?>" class="btn btn-danger" onclick="return confirm ('yakin ga?')">Delete</a>
        </td>
    </tr>
    <?php
        }
        } else{
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
    ?>
</table>
