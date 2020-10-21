
<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('siswa/S_tugas/upload_tugas') ?>" method="POST"  enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Upload Tugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 

            <div class="form-group form-file-upload form-file-multiple">
              <input type="file" multiple="" class="inputFileHidden" name="file">
              <div class="input-group">
                  <input type="text" class="form-control inputFileVisible" placeholder="Upload File">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-fab btn-round btn-primary">
                          <i class="material-icons">attach_file</i>
                      </button>
                  </span>
              </div>
            </div>

      

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg-excel-lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Upload Tugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 
             
                

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>


<div class="content">
  <div class="container-fluid">
  
  <div class="row">
      <div class="col-md-12">
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel" style="margin-bottom: 10px">Upload</button>  
                          
              
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table" style="width:100%">
                  <thead>
                    <tr class="table-dark">
                        <th>Nama File</th>
                        <th>Revisi</th>
                        <th>Status</th>
                        <th>Upload</th>          
                    </tr>
                  </thead>
                
                  <tbody>
                    <?php
                      if ($data_upload) {
                        foreach ($data_upload as $val) { ?>
                        <tr <?php  if ($val->status == 1) { ?>
                          class="table-success"
                      <?php  }else{ ?>
                          class="table-danger"
                      <?php } ?> >
                          <td><?php echo $val->nama_file ?></td>
                          <td><?php echo $val->rev ?></td>
                          <?php  
                            if ($val->status == 1) { ?>
                              
                              <td><span class="badge badge-success">Tepat</span></td>
                            <?php }else{ ?>
                                <td><span class="badge badge-danger">Terlambat</span></td>
                           <?php }
                          ?>

                          <td><?php echo $val->dibuat ?></td>
                        </tr>
                      <?php }

                        }else{ ?>
                            <tr class="table-danger">
                              <td colspan="4">
                                Belum Upload Soal
                              </td>
                            </tr>
                        <?php }
                    ?>
                  </tbody>
                
                </table>  
          
    </div>
  </div>
  <div class="row">
    
        <div class="col-md-12">
    <?php foreach ($data_tugas as $val) { ?>
   

      <textarea class="" cols="80" id="editor1" name="editor1" rows="10"><?php echo $val->deskripsi ?></textarea>

     
    
       <?php } ?>

    
 
    </div>
  </div>


  



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>


 


$(document).ready(function() {
  var params = window.location.pathname.split("/")
  var kode_tugas = params[params.length - 1]


   CKEDITOR.replace('editor1', {readOnly:true,  height: "400px"});




  



    
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
        "dataSrc": "data_tugas",
        "url": "http://localhost/gostudy/siswa/S_tugas/ambil_detail_tugas", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_materi" }, // Tampilkan nis
        { "data": "nama_file" },
        { "data": "size" },

        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('siswa/S_materi/aksi_download/')?>'+ row.nama_file +'"> Download </a> ';

            return html
          }
        },
    

      ],
    });
    
}); 



// FileInput
  $('.form-file-simple .inputFileVisible').click(function() {
    $(this).siblings('.inputFileHidden').trigger('click');
  });

  $('.form-file-simple .inputFileHidden').change(function() {
    var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
    $(this).siblings('.inputFileVisible').val(filename);
  });

  $('.form-file-multiple .inputFileVisible, .form-file-multiple .input-group-btn').click(function() {
    $(this).parent().parent().find('.inputFileHidden').trigger('click');
    $(this).parent().parent().addClass('is-focused');
  });

  $('.form-file-multiple .inputFileHidden').change(function() {
    var names = '';
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
      if (i < $(this).get(0).files.length - 1) {
        names += $(this).get(0).files.item(i).name + ',';
      } else {
        names += $(this).get(0).files.item(i).name;
      }
    }
    $(this).siblings('.input-group').find('.inputFileVisible').val(names);
  });

  $('.form-file-multiple .btn').on('focus', function() {
    $(this).parent().siblings().trigger('focus');
  });

  $('.form-file-multiple .btn').on('focusout', function() {
    $(this).parent().siblings().trigger('focusout');
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









