


<div class="content">
  <div class="container-fluid">

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Profile</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url("guru_usr_clx/G_profile/aksi_g_pass") ?>" method="POST">
                  <?php  
                    foreach ($profile as $val) { ?>
                      
                  
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" name="lama" class="form-control" >
                        </div>
                      </div>
                    
                     
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Ulangi Password</label>
                          <input type="password" name="baru" class="form-control" >
                        </div>
                      </div>
                       
                   
                    </div>

                  
                 
                   
                    <button type="submit" class="btn btn-primary pull-right">Ganti Password</button>
                    <div class="clearfix"></div>
                     <?php  }
                  ?>
                  </form>
                </div>
              </div>
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


    
}); 







</script>

<?php 
if($this->session->flashdata('pesan')){
  if ($this->session->flashdata('pesan') == 'sukses') { ?>
    <script>
      $.notify({
            icon: "done",
            message: "Data berhasil dirubah."
  
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









