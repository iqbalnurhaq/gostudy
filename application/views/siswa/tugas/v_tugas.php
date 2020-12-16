
<div class="content">
  <div class="container-fluid">


<div class="row">
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Tugas</h4>
            
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
        "url": "http://localhost/gostudy/siswa/S_tugas/ambil_data_tugas", // URL file untuk proses select datanya
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
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('siswa/S_tugas/detail_tugas/')?>'+ row.kode_tugas +'"> Lihat </a> ';

            return html
          }
        },
       

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
  }else if($this->session->flashdata('pesan') == 'error'){ ?>
    <script>
    $.notify({
          icon: " ",
          message: "<?php echo $this->session->flashdata('message') ?>"
  
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









