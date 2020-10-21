
 <?php $this->load->view('admin/header'); ?>
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


           <form method="post" action="<?php echo base_url('go_ciclx_usradmin/G_ujian/import') ?>">

              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama ujian</th>
                      <th>Jenis Kelamin</th>
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
                          $nip = $row['A'];
                          $nama = $row['B']; // Ambil data nama
                          $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
                          if($nama == "" && $jenis_kelamin == "" && $nip == ""){
                            continue;
                          }
                          if($numrow > 1){
                            // Validasi apakah semua data telah diisi
                            $nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            
                            // Jika salah satu data ada yang kosong
                            if($nama == "" or $jenis_kelamin == "" or $nip == ""){
                              $kosong++; // Tambah 1 variabel $kosong
                            }
                              echo "<tr>";
                              echo "<td>".$noUrut."</td>";
                              echo "<td".$nip_td.">".$nip."</td>";
                              echo "<td".$nama_td.">".$nama."</td>";
                              echo "<td".$jk_td.">".$jenis_kelamin."</td>";
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
                    echo "<a href='".base_url("A_ujian")."' class='btn btn-secondary pull-right' style='margin-top: 20px;'>Cancel</a>";      
                    
                        
                  }
               ?>
                           
       
        

          </form>

          <?php 
            }
           ?>




                <!-- <table id="example1" class="table table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Mengampu</th>
                        <th>Aksi</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Mengampu</th>
                        <th>Aksi</th>
                        
                    </tr>
                    </tfoot>
                </table> -->
      </div>
    </div>
  </div>
</div>


       
        

          <!-- DataTales Example -->

          


  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('admin/footer'); ?>



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



