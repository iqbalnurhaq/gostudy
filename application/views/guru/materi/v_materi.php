
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_materi/tambah_materi') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Materi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    


          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nama Materi</label>
                <input type="text" name="nama_materi" class="form-control" name="nip" required>
              </div>
            </div>
          </div> 

          <div class="row">
            <div class="col-md-12">
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
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="submit" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Materi</button>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Materi</h4>
            <p class="card-category"></p>
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Materi</th>
                <th>Nama File</th>
                <th>Ukuran File</th>
                <th>Format File </th>
                <th>Download </th>
                <th>Hapus </th>
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Materi</th>
                <th>Nama File</th>
                <th>Ukuran File</th>
                <th>Format File </th>
                <th>Download </th>
                <th>Hapus </th>
            </tr>
          </tfoot>
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
    $('#date_time_mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_materi",
        "url": "http://localhost/gostudy/guru_usr_clx/G_materi/ambil_data_materi", // URL file untuk proses select datanya
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
        { "data": "tipe_file" },
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_materi/aksi_download/')?>'+ row.nama_file +'"> Download </a> ';

            return html
          }
        },
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<button class="btn btn-outline-danger btn-sm" onClick="aksiHapus('+ row.id +')"> Hapus </button>';

            return html
          }
        },

      ],
    });
    
}); 

function aksiHapus(data){
  var id = data;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus materi ini ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_materi/hapus_materi",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_materi'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


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









