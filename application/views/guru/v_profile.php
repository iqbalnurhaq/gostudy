


<div class="content">
  <div class="container-fluid">



        <!-- ===== User ===== -->

        <?php foreach ($guru as $value) { ?>
           
        

        <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Profile Guru</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url("guru_usr_clx/G_profile/update_profile") ?>" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">NIS</label>
                          <input type="text" class="form-control" value="<?php echo $value->nip ?>" disabled>
                        </div>
                      </div>
                     
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" name="email" class="form-control" value="<?php if($value->email == NULL){echo "---";}else{echo $value->email;} ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama Guru</label>
                          <input type="text" class="form-control" value="<?php if($value->nama_guru == NULL){echo "---";}else{echo $value->nama_guru;} ?>">
                        </div>
                      </div>
                     
                    </div>
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal Lahir</label>
                          <input type="text" class="form-control" value="<?php if($value->tgl_lahir == NULL){echo "---";}else{echo $value->tgl_lahir;} ?>" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jenis Kelamin</label>
                          <input type="text" class="form-control" value="<?php if($value->jk == NULL){echo "---";}else{echo $value->jk;} ?>">
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Alamat</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"></label>
                            <textarea class="form-control" rows="3"><?php if($value->alamat == NULL){echo "---";}else{echo $value->alamat;} ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <div class="clearfix"></div>
                   <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
                   <button type="submit" class="btn btn-warning btn-sm">Ganti Password</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                
                <div class="card-body" style="text-align:center">
                  <h6 class="card-category text-gray">Guru</h6>
                  <h4 class="card-title"><?php if($value->nama_guru == NULL){echo "---";}else{echo $value->nama_guru;} ?></h4>
                  <p class="card-description">
                   <?php if($value->note == NULL){echo "---";}else{echo $value->note;} ?>
                  </p>
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
                </div>
              </div>
            </div>
          </div>

        <!-- ========== -->
        <?php } ?>



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>

$(document).ready(function() {

    // -------------NAVBAR ---------
  $('.nav li a[href~="http://localhost/gostudy/guru_usr_clx/G_siswa"]').parents('li').addClass("active");    
  $('.nav li a').click(function(){
        $('.nav li').removeClass("active");
        $('.nav li a[href~="' + location.href + '"]').parents('li').addClass("active");    
    });
    //------------- END -----------

    
    var no =1;
    $('#example').DataTable();
    $('#date_time_mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_siswa",
        "url": "http://localhost/gostudy/guru_usr_clx/G_siswa/ambil_data_siswa", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nis" }, // Tampilkan nis
        { "data": "nama_siswa" }, // Tampilkan nis
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_siswa/aksi_download/')?>'+ row.kode_siswa +'"> Lihat </a> ';

            return html
          }
        } 
       
      ],
    });
    
}); 



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
  }else{ ?>
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









