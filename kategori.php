<?php
//memasukan header halaman
include '.includes/header.php';
//menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container -p-y">
    <!-- tabel data kategori -->
     <div class="card">
        <div class="card-header d-flex justify-content-between align-item-center">
            <h4>Data kategori</h4>
            <!-- tabel data kategori-->
             <button type= "button" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#addCategory">
                Tambah kategori
             </button>
              </div>
              <div class="card-body">
               <div class= "table-responsive text-nowrap">
               <table id="datatable"class="table tablek-hover">
                <thead>
                    <tr class="text-center">
                     <th widht=50px>#</th>
                     <th>Nama</th>
                     <th widht="150px">pilihan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    
             <!-- mengambil data kategori dari database-->
              <?php
              $index = 1;
              $query = "SELECT * FROM categories";
              $exec = mysqli_query($conn, $query);
              while ($category = mysqli_fetch_assoc($exec)) :
              ?>
              <tr>
                <!--menampilkan nomor, nama kategori, dan opsi -->
                <td><?= $index++; ?></td>
                <td><?= $category ['category_name']; ?></td>
                
                <td>
                <!--Dropdown untuk opsi edit dan delete-->
               <div class="dropdown">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="Dropdwon">
               <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
              <a herf="#" class="dropdown-item" data-bs-toggle="modal"
             data-bs-target="#editCategory_<?= $category['category_id']; ?>">
             <i class " bx bx-edit-alt me-2></i>">
             data-bs-target="bx bx-transh me-2">edit</i>
             <a herf="#" class="dropdown-item" data-bs-toggle="modal"
             data-bs-target="#deleteCategory_<?= $category['category_id']; ?>">
             <i class " bx bx-edit-alt me-2></i>">
             data-bs-target="bx bx-transh me-2">Delete</i>
             </tr>
             <!-- modal untuk hapus Data kategori-->
             <!-- modal untuk update data ketegory-->

             <?php endwhile; ?>
             </tbody>
             </table>
             </div>
             </div>
             </div>
             </div>
             <?php include '.includes/footer.php'; ?>