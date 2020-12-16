

<div class="content">
  <div class="container-fluid">


  <!-- ------------------------------- ///// ------------------ -->
  <div class="row">

    <div class="col-md-3">
      <div class="card">
        <div class="card-header card-header-primary">
              <h4 class="card-title">Nilai</h4>
        </div>
        <div class="card-body">
          <table class="table table-hover">
                  <thead>
                    <th>Nama Tugas</th>
                    <th>Nilai</th>
                  </thead>
                  <tbody>
                    <?php  
                      if ($nilai) { 
                          foreach ($nilai as $val) { ?>
                            <tr>
                              <td><?php echo $val->nama_nilai ?></td>
                              <td><?php echo $val->nilai ?></td>
                             
                            </tr>
                        <?php 
                          }
                          
                        
                       }else { ?>
                        
                      <?php }
                      
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: center"><a class="btn btn-primary btn-sm" href="<?php echo site_url().'siswa/S_nilai' ?>">--More--</a></td>
                    </tr>
                  </tbody>
                </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
       <div class="card">
        <div class="card-header card-header-primary">
              <h4 class="card-title">Beranda</h4>
        </div>
        <div class="card-body">

          <form action="<?php echo base_url("siswa/S_dashboard/kirim_beranda") ?>" method="POST">

            
            <div class="form-group">
              <label>Apa yang anda pikirkan?</label>
            <div class="form-group">
              <label class="bmd-label-floating"> Masukkan pertanyaan dan diskusi diberanda</label>
              <textarea class="form-control" rows="3" name="isi" required></textarea>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary pull-right">Kirim</button>
        </form>
          <br>
          <br>

          

          <?php 
          if ($beranda) {
    
          foreach ($beranda as  $ber) { ?>
            <div class="card">
              <div class="card-body">
                <h4><?php echo $ber->nama_user ?> 
                  <?php if ($ber->role == "Guru") { ?>
                    <span class="pull-right badge badge-primary"> <?php echo $ber->role ?> </span>
                  <?php }else{ ?>

                    <span class="pull-right badge badge-secondary"><?php echo $ber->role ?> </span>
                  <?php } ?>
              
                </h4>
                <hr>
                
                  <h5><?php echo $ber->isi ?></h5>
                
                  <p>--<?php echo $ber->created_at ?>-- <?php if($kode_user == $ber->user_code){echo '<span class="pull-right"><a href="#" style="color:red; margin-left:10px" onClick="aksi_hapus('.$ber->id.',1)">Hapus</a></span>';}else{} ?>  <span class="pull-right"><a href="#" style="color:blue" onClick="aksi_balas('<?php echo $ber->id ?>', '<?php echo $ber->nama_user ?>', '<?php echo $ber->role ?>')">Balas</a></span> </p>

               
                   
                  
                  <hr>
                  <?php if ($com_one) { ?>
                    
                    <?php foreach ($com_one as $c_one) { 
                      if ($ber->id == $c_one->id_beranda) { ?>
                        <p>| <?php echo $c_one->nama_user ?>  <span class="badge badge-<?php if($c_one->role == "Guru"){?>primary<?php }else{ ?>secondary<?php } ?>"><?php echo $c_one->role ?> </span> | --> <?php echo $c_one->isi ?>  <?php if($kode_user == $c_one->user_code){echo '<span class="pull-right"><a href="#" style="color:red; margin-left:10px" onClick="aksi_hapus('.$c_one->id.', 2)">Tarik Pesan</a></span>';}else{} ?> <span class="pull-right"><a href="#" style="color:blue" onClick="aksi_balas_one('<?php echo $c_one->id ?>', '<?php echo $c_one->nama_user ?>')">Balas</a></span></p>  
                        <?php if ($com_two) { 
                            foreach ($com_two as $key => $c_two) { 
                                if ($c_one->id == $c_two->id_comment_one) { ?>
                                    <p style="margin-left: 30px">| <?php echo $c_two->nama_user ?>  <span class="badge badge-<?php if($c_two->role == "Guru"){?>primary<?php }else{ ?>secondary<?php } ?>"><?php echo $c_two->role ?> </span> | --> <?php echo $c_two->isi ?> <?php if($kode_user == $c_two->user_code){echo '<span class="pull-right"><a href="#" style="color:red; margin-left:10px" onClick="aksi_hapus('.$c_two->id.', 3)">Tarik Pesan</a></span>';}else{} ?></p>  
                                <?php }
                              ?>

                            <?php }
                          ?>
                            
                       <?php }else{ ?>
                            <div class="card">
                              <div class="card-body">
                                Belum ada balasan
                              </div>
                            </div>
                       <?php } ?>
                      
                      <?php 
                      } 
                    }
                  }else{
                     ?>
                        <div class="card">
                          <div class="card-body">
                            Belum ada balasan
                          </div>
                        </div>
                     <?php } ?>
              </div>
            </div>
           
          <?php }
          
          }else{
          ?>
              <div class="card">
                <div class="card-body">
                  Belum ada isi
                </div>
              </div>
          <?php } ?>
          


        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header card-header-primary">
                    <h4 class="card-title">Tugas</h4>
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <th>Nama Tugas</th>
                    <th>Open</th>
                  </thead>
                  <tbody>
                    <?php  
                      if ($tugas) { 
                          foreach ($tugas as $val) { ?>
                            <tr>
                              <td><?php echo $val->nama_tugas ?></td>
                              <td><a class="btn btn-primary btn-sm" href="<?php echo site_url().'siswa/S_tugas/detail_tugas/'.$val->kode_tugas ?>">Open</a></td>
                            </tr>
                        <?php 
                          }
                          
                        
                       }else { ?>
                        
                      <?php }
                      
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: center"><a class="btn btn-primary btn-sm" href="<?php echo site_url().'siswa/S_tugas' ?>">--More--</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header card-header-primary">
                    <h4 class="card-title">Ujian</h4>
              </div>
              <div class="card-body">
                 <table class="table table-hover">
                  <thead>
                    <th>Nama Ujian</th>
                    <th>Open</th>
                  </thead>
                  <tbody>
                    <?php  
                      if ($ujian) { 
                          foreach ($ujian as $val) { ?>
                            <tr>
                              <td><?php echo $val->nama_ujian ?></td>
                              <td><a class="btn btn-primary btn-sm" href="<?php echo site_url().'siswa/S_ujian/' ?>">Open</a></td>
                            </tr>
                        <?php 
                          }
                          
                        
                       }else { ?>
                        
                      <?php }
                      
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: center"><a class="btn btn-primary btn-sm" href="<?php echo site_url().'siswa/S_ujian' ?>">--More--</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>


      </div>
            
    </div>
  </div>

    
    
  </div>
</div>

      <?php $this->load->view('siswa/footer'); ?>



<script>

$(document).ready(function() {

    
    var no =1;
    $('#example').DataTable();
    $('#date_time_mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

}); 



async function aksi_balas(id_beranda, nama, role){
    
    const { value: text } = await Swal.fire({
      input: 'textarea',
      inputLabel: 'Message',
      inputPlaceholder: 'Balas pesan '+nama,
      inputAttributes: {
        'aria-label': 'Balas pesan '+nama,
      },
      showCancelButton: true
    })

    if (text) {
      input_balas(text, id_beranda, role)
    }


}
async function aksi_hapus(id, table){
    
  
    Swal.fire({
    title: 'Are you sure?',
    text: "Apakah kamu ingin menhapus Guru !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
        url : "http://localhost/gostudy/siswa/S_dashboard/hapus_pesan",
        method: 'POST',
        dataType: 'json',
        data: {id:id, table:table},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          $.notify({
              icon: "done",
              message: "Pesan berhasil dihapus."

          },{
              type: 'success',
              timer: 400,
              placement: {
                  from: 'top',
                  align: 'center'
              }
          });

          setTimeout(function(){
              window.location.href = "<?php echo base_url('siswa/S_dashboard'); ?>";
          }, 1100);
          

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

      }
    });

}


async function aksi_balas_one(id, nama){
    
    const { value: text } = await Swal.fire({
      input: 'textarea',
      inputLabel: 'Message',
      inputPlaceholder: 'Balas pesan '+nama,
      inputAttributes: {
        'aria-label': 'Balas pesan '+nama,
      },
      showCancelButton: true
    })

    if (text) {
      input_balas_one(text, id)
    }
}

function input_balas(isi, id_beranda, role){
  $.ajax({
      url : "http://localhost/gostudy/siswa/S_dashboard/kirim_balas",
      method: 'POST',
      dataType: 'json',
      data: {isi:isi, id_beranda:id_beranda, role:role},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
         $.notify({
            icon: "done",
            message: "Pesan berhasil terkirim."

        },{
            type: 'success',
            timer: 400,
            placement: {
                from: 'top',
                align: 'center'
            }
        });

        setTimeout(function(){
            window.location.href = "<?php echo base_url('siswa/S_dashboard'); ?>";
        }, 1100);

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
}


function input_balas_one(isi, id_com_one){
  $.ajax({
      url : "http://localhost/gostudy/siswa/S_dashboard/kirim_balas_one",
      method: 'POST',
      dataType: 'json',
      data: {isi:isi, id_com_one:id_com_one},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
         $.notify({
            icon: "done",
            message: "Pesan berhasil terkirim."

        },{
            type: 'success',
            timer: 400,
            placement: {
                from: 'top',
                align: 'center'
            }
        });

        setTimeout(function(){
            window.location.href = "<?php echo base_url('siswa/S_dashboard'); ?>";
        }, 1100);
        

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
}



// ===========================


function hapus_pesan(id){
  $.ajax({
      url : "http://localhost/gostudy/siswa/S_dashboard/hapus_pesan",
      method: 'POST',
      dataType: 'json',
      data: {id:id},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
         $.notify({
            icon: "done",
            message: "Pesan berhasil dihapus."

        },{
            type: 'success',
            timer: 400,
            placement: {
                from: 'top',
                align: 'center'
            }
        });

        setTimeout(function(){
            window.location.href = "<?php echo base_url('siswa/S_dashboard'); ?>";
        }, 1100);
        

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
}



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



