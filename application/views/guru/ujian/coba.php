

<div class="content">
  <div class="container-fluid">

    <button class="btn btn-primary" >Reset</button>


                                  



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

<script src="<?php echo base_url('assets/js/core/jquery.min.js') ?>"></script>



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
 

function reset(){
  console.log("aaaavvvv");
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









