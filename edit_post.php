<?php
//memasukan file konfigurasi database
include 'config.php';

//memasukan header halaman
include '.includes/header.php';

//mengambil id postingan yang akan di edit dari parameter URL //../edit_post.php?post_id=
$postIdToEdit = $_GET['post_id']; //pastikan paramenter 'post_id' ada di URL

//Query untuk mengambil data postingan berdasarkan ID
$query ="SELECT *FROM posts WHERE id_post = $postIdToEdit";
$result = $conn->query($query);

//memeriksa apakah data postingan ditemukan
if ($result->num_rows >0) {
    $post = $result->fetch_assoc(); //mengambil data postiingan ke dalam array
} else {
    echo "Post not found.";
    exit(); //menghentikan eksekusi jika tidak ada postingan 
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- judul halaman -->
     <div class="row">
        <!-- form untuk mengedit postingan -->
        <div class="col-md-10">
            <div class="card mb-4">
                <class="card-body">
                    <!-- formulir menggunakan metode POST untuk mengirim data -->
                     <form  method="POST"action="proses_post.php" enctype="multipart/form-data">
                        <!-- input tersembunyi untuk menyimpan ID postingan -->
                         <input type="hidden" name="post_id" value="<?php echo $postIdToEdit; ?>">

                         <!--input untuk judul postingan-->
                         <div class="mb-3">
                            <label for="post_title" class="form-label">Judul postingan</label>
                            <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post['post_title']; ?>" required>
                         </div>
                         
                        <!--input untuk unggah gammbar -->
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah gambar</label>
                            <input class="form-control" type="file" id="formFile" name="image_path" accept="image/*">
                            <?php if (!empty($post['image_path'])): ?>
                            <!-- menampilkan gambar yang sudah di unggah -->
                             <div class="mt-2">
                                <img src="<?= $post['image_path']; ?>" alt="Current Image" class="img-thunbnail" style="max-widht: 200px;">
                             </div>
                             <?php endif; ?>
                        </div>

                        <!-- Dropdown untuk kategori -->
                         <div class="mb-3">
                            <label for="category_id" class="form-label">kategori</label>
                            <select class="form-select" id="category_id"name="category_id" required>
                                <option value="" selected disabled>Select one</option>
                                <?php
                                //mengambil data kategori dari database
                                $queryCategories = "SELECT *FROM categories";
                                $resultCategories = $conn->query($queryCategories);
                                //menambahkan opsi ke dropdown
                                if ($resultCategories->num_rows > 0) {
                                    while ($row= $resultCategories->fetch_assoc()) {
                                        //menandai kategori yang sudah dipilih
                                        $selectd = ($row["category_id"] == $post['category_id'] ) ? "selected" :"";
                                        echo "<option valua='" . $row["category_id"] . "'</option>";
                                    }
                                }
                                ?>
                            </select>
                         </div>
                         <!-- textarea untuk konten postingan -->
                        <div class="mb-3">
                            <label for="content" class="form-label">konten</label>
                            <textarea class="form-control" id="content" name="content" required><?php echo $post['content']; ?></textarea>
                            </div>

                            <!-- Tombol untuk memperbarui postingan -->
                             <button type="submit" name="update" class="btn btn-primary">Update</button>
                     </form>
                </div>
            </div>
        </div>
     </div>
</div>

<?php
//memasukan footer halaman
include '.includes/footer.php';
?>