
 <?php $this->load->view('guru/header'); ?>
<div class="content">
  <div class="container-fluid">
  

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        Previews
      </div>

      <div class="card-body">

        <?php 
            if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form     
              if(isset($upload_error)){ // Jika proses upload gagal      
              echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload      
            die;
            } // stop skrip    }
           ?>

          


           <form method="post" action="<?php echo base_url('guru_usr_clx/G_nilai/import') ?>">

              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Nilai</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      $numrow = 1;
                      $kosong = 0;
                      $noUrut = 0;
                    ?>
                    <?php
                      foreach($sheet as $row){
                          $kode_siswa = $row['B'];
                          $nis = $row['C'];
                          $nama = $row['D']; // Ambil data nama
                          $nilai = $row['E']; // Ambil data jenis kelamin
                          if($kode_siswa == "" && $nis == "" && $nama == "" && $nilai == ""){
                            continue;
                          }
                          if($numrow > 1){
                            // Validasi apakah semua data telah diisi
                            $kode_siswa_td = ( ! empty($kode_siswa))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $nilai_td = ( ! empty($nilai))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            
                            // foreach ($siswa as $value) {
                            //   if ($kode_siswa == $value->kode_siswa) {
                            //     continue;
                            //   }else{
                            //     $kode_siswa_td = " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            //     $nis_td = " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            //     $nama_td =" style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            //     $nilai_td = " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            //   }
                            // }
                            // Jika salah satu data ada yang kosong
                            $sql = "SELECT * FROM siswa WHERE kode_siswa='$kode_siswa'";
                            $cek = $this->db->query($sql)->num_rows();
                           
                            if ($cek == 1) {
                              
                            }else{
                               $kode_siswa_td = " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                               $kosong++;
                            }

                            if($kode_siswa == "" or $nis == "" or $nama == "" or $nilai == ""){
                              $kosong++; // Tambah 1 variabel $kosong
                            }

                              echo "<tr>";
                              echo "<td>".$noUrut."</td>";
                              echo "<td".$kode_siswa_td.">".$kode_siswa."</td>";
                              echo "<td".$nis_td.">".$nis."</td>";
                              echo "<td".$nama_td.">".$nama."</td>";
                              echo "<td".$nilai_td.">".$nilai."</td>";
                              echo "</tr>";
                           }
                          $numrow++;
                          $noUrut++;
                        }
                     ?>
                  </tbody>
                </table>
              </div>
        
                        
              <?php 
                    if($kosong > 0){    
                    ?>        
                    <script>      
                      $(document).ready(function(){        
                        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong        
                        $("#jumlah_kosong").html('<?php echo $kosong; ?>');                
                        $("#kosong").show(); // Munculkan alert validasi kosong      
                      });      
                    </script>    
                    <?php    
                    }else{ // Jika semua data sudah diisi        
                    // Buat sebuah tombol untuk mengimport data ke database
                   
                   
                    echo "<input type='submit' class='btn btn-primary pull-right' value='Upload Data' style='margin-left:15px; margin-top: 20px;'> ";
                    echo "<a href='".base_url("A_guru")."' class='btn btn-secondary pull-right' style='margin-top: 20px;'>Cancel</a>";      
                    
                        
                  }
               ?>

               <input type="hidden" name="kode_nilai" value="<?php echo $kode_nilai ?>">
                           
       
        

          </form>

          <?php 
            }
           ?>




      </div>
    </div>
  </div>
</div>


       
        

          <!-- DataTales Example -->

          


  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



      <script>
         tabel = $('#example1').DataTable({});
      </script>


<?php 

if ($this->session->flashdata('pesan') == 'sukses') { ?>
  <script>
    $.notify({
          icon: "done",
          message: "Data berhasil ditambahkan."

      },{
          type: 'success',
          timer: 400,
          placement: {
              from: 'top',
              align: 'center'
          }
      });
  </script>  
<?php 
}

?>



