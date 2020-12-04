

<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">

  <?php
    if ($backup == 1) { ?>
      <div class="alert alert-warning" role="alert">
        Anda sudah melakukan backup untuk nilai ini.
      </div>
    <?php }
  
  ?>

  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Materi</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
      </div>

      
      <div class="card-body table-responsive">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: <?php echo $progress ?>%;" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progress ?>%</div>
        </div>
        <table id="data_hasil_siswa" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nilai</th>
                <th>Action</th>
                
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
                <?php 
                 
                    foreach ($hasil as $val) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $val->nis ?></td>
                            <td><?php echo $val->nama_siswa ?></td>
                            <?php if ($val->kode_ujian) { ?>
                                <td><?php echo $val->nilai_ujian ?></td>
                            <?php }else{ ?>
                                <td><span class="badge badge-pill badge-danger">Belum Mengerjakan</span></td>
                            <?php } ?>
                            <td>
                              <?php  
                                if ($val->kode_ujian) { ?>
                                  <button class="btn btn-warning btn-sm" onClick="reset('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">Reset</button>
                                  
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-danger btn-sm" onClick="diskualifikasi('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">diskualifikasi</button>

                               <?php }
                              ?>
                            </td>
                            
                        </tr>
                   <?php }
                ?>
          </tbody>
      
        </table>

        <?php 

        if ($backup == 1) { ?>
           <button class="btn btn-info pull-right disabled" style="margin-top:20px">Backup Nilai Disabled</button>
        <?php }else{ 
            if ($progress == 100) { ?>
            
            <button class="btn btn-info pull-right" style="margin-top:20px" onClick="backup_nilai()">Backup Nilai</button>
          <?php } else { ?>
            <button class="btn btn-info pull-right disabled" style="margin-top:20px">Backup Nilai Disabled</button>
          <?php }
         }
          
          
        ?>  

      </div>
    </div>
  </div>
</div>

                                  



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>

$(document).ready(function() {


    var no =1;
    $('#example').DataTable();
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#data_hasil_siswa').DataTable();
    
  });
 

function reset(kode_siswa, nama_siswa){
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin reset siswa " + nama_siswa+ " ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/reset",
        method: 'POST',
        dataType: 'json',
        data: {kode_siswa : kode_siswa},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Success!', 'Berhasil reset.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/load_hasil_ujian'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });
}


function diskualifikasi(kode_siswa, nama_siswa){
  
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin diskualifikasi siswa " + nama_siswa+ " ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/diskualifikasi",
        method: 'POST',
        dataType: 'json',
        data: {kode_siswa : kode_siswa},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Success!', 'Berhasil reset.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/load_hasil_ujian'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });
}


function backup_nilai(){

   $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_ujian/ambil_nilai",
      method: 'GET',
      dataType: 'json',
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        console.log(data);
        aksiPilih(data.nilai);
      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
   
}

async function aksiPilih(data, kode_guru){
  const { value: fruit } = await Swal.fire({
  title: 'Select field validation',
  input: 'select',
  inputOptions: data,
  inputPlaceholder: 'Pilih Nilai',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      resolve()
    })
  }
})

if (fruit) {
  aksi_backup_nilai(fruit)
}
}

function aksi_backup_nilai(kode_nilai){
  $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/aksi_backup_nilai",
        method: 'POST',
        data : {kode_nilai:kode_nilai}, 
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          Swal.fire('Berhasil!', 'Berhasil Backup', 'success');
          setTimeout(function(){
              window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/load_hasil_ujian'); ?>";
          }, 1100);
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);
          
        }

      });
}





</script>

<?php 
if($this->session->flashdata('pesan')){
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
  }else if($this->session->flashdata('pesan') == 'error'){ ?>
    <script>
    $.notify({
          icon: "done",
          message: "something went wrong"
  
      },{
          type: 'danger',
          timer: 400,
          placement: {
              from: 'top',
              align: 'center'
          }
      });
  </script>  
  <?php }
  
  
}

?>  









