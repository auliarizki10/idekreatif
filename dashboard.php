<?php
include (".includes/header.php");
$tiitle = "Dashboard";
//menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- card untuk menampilkan tebel postingan -->
     <div class="card">
      <!-- Tabel dengan baris yang di dapat di-hover -->
       <div class="card">
        <!-- Header Tabel -->
         <div class="card-header d-flex justify-content-between align-items-center">
            <h4>semua postingan</h4>
         </div>
         <div class="card-body">
            <!-- Tabel responsif -->
             <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                        <th width="50px">#</th>
                        <th>Judul Post</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th widht="150px">pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <!-- menampilkan data dari tabel database -->
                         <?php
                         $index = 1; //variabel untuk nomor urut
                         /*Query untuk mengambil data dari tabel posts, users, dan categories */
                         $query = "SELECT posts.*, user.name as user_name, categories.category_name FEOM posts INNER JOIN users ON posts.user_id = users_id LEFT JOIN categories ON posts.category_id = categories.category_id WHERE posts.user_id = $userId";
                         //eksekusi query
                         $exec =mysqli_query($conn, $query);

                         //perulangan untuk menampilkan setiap baris hasil query
                         while ($post = mysqli_fetch_assoc($exec)) :
                            ?>
                            <tr>
                                <td><?= $index++; ?></td>
                                <td><?= $post['post_title']; ?></td>
                                <td><?= $post['user_name']; ?></td>
                                <td><?= $post['category_name']; ?></td>
                                <td>
                                    <div class="dropdwon">
                                        <!-- Tombol dropdown untuk pilihan -->
                                    </div>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"> <i class = "bx bx-dots-dots-vertical-rounded"></i></button>
                                    <!-- menu dropdown -->
                                     <div class="dropdown-menu">
                                        <!-- pilihan edit -->
                                         <a href="edit_post.php?post_id=<?= $post['id_post']; ?> "class="dropdown-item">
                                            <i class="'bx bx-edit-alt me-2"></i> Edit
                                         </a>
                                         <!-- pilihan delete -->
                                          <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="deletePost_<?= $post['id_post']; ?>">
                                            <i class="bx bx-trash me-2"></i>
                                          </a>
                                     </div>
                                     </div>
                                </td>
                            </tr>
                            <!-- modal untuk hapus konten blog -->
                             <div class="modal fade" id="deletePost_<?= $post['id_post']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="model-header">
                                        <h5 class="modal-title">hapus post?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            < action="proses_post.php" method="POST">
                                                <div>
                                                    <p>Tindakan ini tidak bisa dibatalkan.</p>
                                                    <input type="hidden" name="postID" value="<?=$post['id_post']; ?>">
                                                </div>
                                                 <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">batal</button>
                                                    <button type="submit" name="delete" class="'btn btn-primary">hapus</button>
                                                 </div>
                                             </form>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <?php endwhile; ?>
                    </tbody>
                </table>
             </div>
         </div>
       </div>
       <!-- akhir tabel dengan baris yang dapat di-hover -->
     </div>
  </div>

  <?php
  include (".includes/footer.php");
  ?>
