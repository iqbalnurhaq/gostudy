
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


           <form method="post" action="<?php echo base_url('guru_usr_clx/G_ujian/import') ?>">

              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No Soal</th>
                      <th>Soal</th>
                      <th>Option A</th>
                      <th>Option B</th>
                      <th>Option C</th>
                      <th>Option D</th>
                      <th>Option E</th>
                      <th>Jawaban</th>
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
                          $no_soal = $row['A'];
                          $soal = $row['B']; // Ambil data nama
                          $optA = $row['C']; // Ambil data jenis kelamin
                          $optB = $row['D']; // Ambil data jenis kelamin
                          $optC = $row['E']; // Ambil data jenis kelamin
                          $optD = $row['F']; // Ambil data jenis kelamin
                          $optE = $row['G']; // Ambil data jenis kelamin
                          $jwb = $row['H']; // Ambil data jenis kelamin
                          if($no_soal == ""){
                            continue;
                          }
                          if($numrow > 1){
                            // Validasi apakah semua data telah diisi
                            $no_soal_td = ( ! empty($no_soal))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $soal_td = ( ! empty($soal))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $optA_td = ( ! empty($optA))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $optB_td = ( ! empty($optB))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $optC_td = ( ! empty($optC))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $optD_td = ( ! empty($optD))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $optE_td = ( ! empty($optE))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $jwb_td = ( ! empty($jwb))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            
                            // Jika salah satu data ada yang kosong
                            if($no_soal == ""){
                              $kosong++; // Tambah 1 variabel $kosong
                            }
                              echo "<tr>";
                              echo "<td".$no_soal_td.">".$no_soal."</td>";
                              echo "<td".$soal_td.">".$soal."</td>";
                              echo "<td".$optA_td.">".$optA."</td>";
                              echo "<td".$optB_td.">".$optB."</td>";
                              echo "<td".$optC_td.">".$optC."</td>";
                              echo "<td".$optD_td.">".$optD."</td>";
                              echo "<td".$optE_td.">".$optE."</td>";
                              echo "<td".$jwb_td.">".$jwb."</td>";
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
                    echo "<a href='".base_url("guru_usr_clx/G_ujian/detail_ujian/").$kode_ujian."' class='btn btn-secondary pull-right' style='margin-top: 20px;'>Cancel</a>";      
                    
                        
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

      <?php $this->load->view('guru/footer'); ?>



      <script>

      $(document).ready(function() {

  // -------------NAVBAR ---------
  $('.nav li a[href~="http://localhost/gostudy/guru_usr_clx/G_ujian"]').parents('li').addClass("active");    
  $('.nav li a').click(function(){
        $('.nav li').removeClass("active");
        $('.nav li a[href~="' + location.href + '"]').parents('li').addClass("active");    
    });
    //------------- END -----------
    
  });
      
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



