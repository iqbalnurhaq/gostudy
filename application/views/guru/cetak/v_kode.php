


<div class="content">
  <div class="container-fluid">

<div class="row">
 
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Nilai Siswa</h4>
            
      </div>

      <form action="<?php echo base_url("guru_usr_clx/G_cetak/kirim_kode") ?>" method="POST">
      <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Masukkan Kode</label>
                                <input type="text" name="kode" class="form-control" name="kode" required>
                            </div>
                             <input type="submit" class="btn btn-primary pull-right" name="submit" value="Save">
                        </div>
                    </div> 
      </div>
      </form>
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









