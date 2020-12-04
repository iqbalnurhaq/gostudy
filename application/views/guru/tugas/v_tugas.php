
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_tugas/tambah_tugas') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              


          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nama tugas</label>
                <input type="text" name="nama_tugas" class="form-control" required>
              </div>
            </div>
          </div> 



          <br>
         

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control">Masukkan Waktu Aktif tugas</label>
                <input type="text" name="tgl_aktif" class="form-control datetimepicker" required />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                <label for="exampleFormControlSelect1">Pilih Tipe</label>
                <select class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1" name="tipe">
                  <option value="Ontime">ONTIME</option>
                  <option value="Late">LATE</option>
                 
                </select>
              </div>
            </div>
          </div>


          <br>
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
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Tugas</button>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Materi</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Tugas</th>
                <th>Tanggal Dibuat</th>
                <th>Aktif</th>
                <th>Deadline</th>
                <th>Tipe</th>
                <th>Lihat</th>
                <th>Hapus </th>
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
              <th>No</th>
                <th>Nama Tugas</th>
                <th>Tanggal Dibuat</th>
                <th>Aktif</th>
                <th>Deadline</th>
                <th>Tipe</th>
                <th>Lihat</th>
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

  // DecoupledEditor
  //   .create( document.querySelector( '.document-editor__editable' ), {
      
  //   } )
  //   .then( editor => {
  //       const toolbarContainer = document.querySelector( '.document-editor__toolbar' );

  //       toolbarContainer.appendChild( editor.ui.view.toolbar.element );

  //       window.editor = editor;
  //   } )
  //   .catch( err => {
  //       console.error( err );
  //   } );

    $('.datetimepicker').daterangepicker({
      timePicker: true,
      startDate: moment().startOf('hour'),
      endDate: moment().startOf('hour').add(32, 'hour'),
      minDate: new Date(),
      locale: {
        format: 'DD/MM/YYYY  hh:mm A'
      }
    });




    var no =1;
    $('#example').DataTable();
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_tugas",
        "url": "http://localhost/gostudy/guru_usr_clx/G_tugas/ambil_data_tugas", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_tugas" }, // Tampilkan nis
        { "data": "tgl_dibuat"},
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = row.tgl_aktif + ' || ' + row.wkt_aktif;

            return html
          }
        },
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = row.tgl_akhir + ' || ' + row.wkt_akhir;

            return html
          }
        },
        { "data": "tipe"},
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_tugas/detail_tugas/')?>'+ row.kode_tugas +'"> Lihat </a> ';

            return html
          }
        },
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '-';

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
        url : "http://localhost/guru_usr_clx/G_materi/hapus_materi",
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









