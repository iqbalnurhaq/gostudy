
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_tugas/tambah_tugas') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Materi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              

          <div class="card-body table-responsive">
        <table class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nilai</th>
                <th>Input</th>     
            </tr>
          </thead>
          <tbody>
               
          </tbody>
         
        </table>  
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

<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_nilai/form') ?>" method="POST"  enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Input Nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    

         <div class="form-group form-file-upload form-file-multiple">
            <input type="file" multiple="" class="inputFileHidden" name="file">
            <div class="input-group">
                <input type="text" class="form-control inputFileVisible" placeholder="Single File">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-fab btn-round btn-primary">
                        <i class="material-icons">attach_file</i>
                    </button>
                </span>
            </div>
          </div>

          <input type="hidden" id="kode_nilai" name="kode_nilai">

      
      

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="preview" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



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
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nilai</th>
                <th>Input Nilai</th>
                
            </tr>
          </thead>
          <tbody>
              
          </tbody>
          <tfoot>
              <tr>
             
                <th>No</th>
                <th>NIS</th>
                <th>Input Nilai</th>
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
        "dataSrc": "data_nilai_siswa",
        "url": "http://localhost/gostudy/guru_usr_clx/G_nilai/data_nilai", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_nilai" }, // Tampilkan nis
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            html = '';
            if (row.status == 0) {
              html += ' <button class="btn btn-warning btn-sm" onClick="aksiOpen(\'' + row.kode_nilai + '\' , \'' + row.nama_nilai + '\')"> Open </button>'
              html += '<button class="btn btn-primary btn-sm" onClick="openExcel(\'' + row.kode_nilai + '\')"> Input Excel </button>'
              html += ' <a class="btn btn-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_nilai/export') ?>"> Download Template </a>'
            }else{
              html += '<a class="btn btn-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_nilai/link_nilai/')?>'+ row.kode_nilai +'"> Input Nilai </a>'
              html += '<button class="btn btn-danger btn-sm" onClick="aksiClear(\'' + row.kode_nilai + '\' , \'' + row.nama_nilai + '\')"> Clear </button> ';
            }
            return html
          }
        },

      ],
    });

      
}); 

function inputNilaiModal(kode_siswa){
    $.ajax({
        url : "http://localhost/guru_usr_clx/G_nilai/data_nilai",
        method: 'POST',
        dataType: 'json',
        data: {kode_siswa : kode_siswa},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
            console.log(data)
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}

function aksiOpen(kode_nilai, nama){
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin membuka nilai " + namaGuru + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Open!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_nilai/open",
        method: 'POST',
        dataType: 'json',
        data: {kode_nilai : kode_nilai},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Success!', 'Berhasil Membuka.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_nilai'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

function aksiClear(kode_nilai, nama){
  var namaGuru = nama;
  Swal.fire({
  title: "Apakah kamu ingin membersihkan nilai " + namaGuru + "!",
  text: "Membersihkan nilai akan menghapus semua  nilai siswa pada kategori ini!!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_nilai/clear",
        method: 'POST',
        dataType: 'json',
        data: {kode_nilai : kode_nilai},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Success!', 'Berhasil Membersihkan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_nilai'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

function openExcel(kode_nilai){
  $("#kode_nilai").val(kode_nilai);
  $('.bd-example-modal-lg-excel').modal('show');
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









