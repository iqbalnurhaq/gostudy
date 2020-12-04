
<div class="content">
  <div class="container-fluid">


<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Materi</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
      </div>
      <div class="card-body table-responsive">
     
        <table id="" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Nilai</th>
                <th>Nilai</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($nilai as $val) { ?>
              

                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $val->nama_nilai ?></td>
                    <?php if ($val->nilai==null) { ?>
                      
                    <td>Belum ada nilai</td>
                    <?php }else{ ?>
                    <td><?php echo $val->nilai ?></td>

                    <?php } ?>
                    
                </tr>
              <?php }?>
             
           
          </tbody>
          
        </table>  
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









