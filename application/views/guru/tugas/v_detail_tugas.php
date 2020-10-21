
<div class="modal fade bd-upload-siswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Upload Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    
          <table id="example3" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Download</th>

            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Download</th>
            </tr>
          </tfoot>
          </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="simpan_mapel_aktif">Save</button>
        </div>
     
    </div>
  </div>
</div>






<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Tugas</h4>
            <p class="card-category">Detail Tugas</p>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <tbody>
            <?php foreach ($data_tugas as $val) { ?>
            <tr>
              <td>Kode Tugas</td>
              <td><?php echo $val->kode_tugas; ?></td>
            </tr>
            <tr>
              <td>Nama Tugas</td>
              <td><?php echo $val->nama_tugas; ?></td>
           
            </tr>
            <tr>
              <td>Aktif Tugas</td>
              <td><?php echo $val->tgl_aktif ?> ( <?php echo $val->wkt_aktif ?> )</td>
              
            </tr>
            <tr>
              <td>Deadline Tugas</td>
              <td><?php echo $val->tgl_akhir ?>  ( <?php echo $val->wkt_akhir ?> )</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>  

        <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bd-upload-siswa">Upload Siswa</button>
        </div>
      </div>


      </div>

      


    </div>
  </div>
  <div class="col-md-7">
  <?php foreach ($data_tugas as $val) { ?>
    <form action="<?php echo base_url('guru_usr_clx/G_tugas/save_desc') ?>" method="POST">
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-primary pull-right"> Save Deskripsi </button>
      </div>
    </div>
    
    <!-- <div class="document-editor">
      <div class="document-editor__toolbar"></div>
      <div class="document-editor__editable-container">
          <div class="document-editor__editable">
              <div id="desc"></div>
          </div>
      </div>
    </div> -->

      <textarea name="content" id="ckeditor" required><?php echo $val->deskripsi ?></textarea>

      <input type="hidden" name="kode_tugas" value="<?php echo $val->kode_tugas; ?>">
      </form>
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
 
  $(function () {
   

    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor', {

      height: "300px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      stylesSet: [{
          name: 'Narrow image',
          type: 'widget',
          widget: 'image',
          attributes: {
            'class': 'image-narrow'
          }
        },
        {
          name: 'Wide image',
          type: 'widget',
          widget: 'image',
          attributes: {
            'class': 'image-wide'
          }
        }
      ],

      contentsCss: [
        'http://cdn.ckeditor.com/4.15.0/full-all/contents.css',
        'assets/css/widgetstyles.css'
      ],

     
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
      image2_disableResizer: true
    });
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
        { "data": "tgl_aktif"},
        { "data": "tgl_akhir"},
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




    tabel3 = $('#example3').DataTable({

        "ajax":
        {
          "dataSrc": "data_mapel",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/load_data_mapel", // URL file untuk proses select datanya
          "data" : {"kode_kelas" : localStorage.getItem('kode_kelas')},
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
          { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
              var html = "";
              var code = noG++;
              html = '<div class="form-check"> <label class="form-check-label" for="customCheck\'' + code + '\'"> <input class="form-check-input" type="checkbox" id="customCheck\'' + code + '\'" name="mapel_aktif" value="'+ row.kode_mapel +'"> <span class="form-check-sign"> <span class="check"></span> </span> </label> </div>'
              return html; // Tampilkan jenis kelaminnya
            }
          },
         

      
        ],
        });
    
}); 


function aksi_tmb_desc(kode_tugas){

  var i = $('#ckeditor').text()
  alert(i)


  // $.ajax({
  //     url : "http://localhost/gostudy/guru_usr_clx/G_tugas/save_desc",
  //     method: 'POST',
  //     dataType: 'json',
  //     data: {desc : i},
  //     contentType: 'application/x-www-form-urlencoded',
  //     success: function(data){
  //       $.notify({
  //           icon: "done",
  //           message: "Data berhasil disave."
  
  //       },{
  //           type: 'success',
  //           timer: 400,
  //           placement: {
  //               from: 'top',
  //               align: 'center'
  //           }
  //       });
  //       setTimeout(function(){
  //           window.location.href = "<?php echo base_url('guru_usr_clx/G_tugas/detail_tugas/'); ?>" + kode_tugas;
  //       }, 1100);

  //     },
  //     error: function( errorThrown ){
  //       console.log( errorThrown);

  //     }

  //   });
}

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
            message: "Data berhasil disimpan."
  
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









