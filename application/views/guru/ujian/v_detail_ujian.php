

<style>
  img{
    max-height: 300px;
    max-width:100%;
  }
</style>
<div class="modal fade modal_bankload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url('guru_usr_clx/G_ujian/save_soal') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
      

         <div class="row"> 
            <div class="col-md-12">
              <table id="example5" class="table table-hover" style="width:100%">
                <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Ujian</th>
                      <th>Mapel</th>
                      <th>Kelas</th>
                      <th>Nama Guru</th>
                      <th>Aksi</th>
                      
                  </tr>
                </thead>
                <tbody>
                      
                </tbody>
                <tfoot>
                    <tr>
                       <th>No</th>
                      <th>Nama Ujian</th>
                      <th>Mapel</th>
                      <th>Kelas</th>
                      <th>Nama Guru</th>
                      <th>Aksi</th>
                  </tr>
                </tfoot>
                </table>
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



<div class="modal fade bank_soal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content" style="width: 1200px; margin-left: -350px">
      <form action="<?php echo base_url('guru_usr_clx/G_ujian/save_soal') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
      

         
              <table id="table_bank_soal" class="table table-hover" style="width:100%">
                <thead>
                  <tr>
                      <th>No Soal</th>
                      <th>Soal</th>
                      <th>Ambil Soal</th>
                      
                  </tr>
                </thead>
                <tbody>
                      
                </tbody>
              
                </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade modal_tambah_soal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url('guru_usr_clx/G_ujian/save_soal') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
      

         <div class="row"> 
            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control">Input Soal</label>
                <textarea name="soal" id="ckeditor" required></textarea>
              </div>
                
            </div>

            <div class="col-md-12">
              <div class="form-group">
                  <label>Pilihan / Option</label>
                  <br>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Option A</label>
                    <textarea name="optA" id="ckeditor1" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Option B</label>
                    <textarea name="optB" id="ckeditor2" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Option C</label>
                    <textarea name="optC" id="ckeditor3" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Option D</label>
                    <textarea name="optD" id="ckeditor4" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Option E</label>
                    <textarea name="optE" id="ckeditor5" required></textarea>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Masukkan Jawaban</label>
          
                    <div class="radio" >
                      <label style="margin-right: 35px"><input type="radio" name="jwb" value="A">A</label>
                      <label style="margin-right: 35px"><input type="radio" name="jwb" value="B" >B</label>
                      <label style="margin-right: 35px"><input type="radio" name="jwb" value="C" >C</label>
                      <label style="margin-right: 35px"><input type="radio" name="jwb" value="D" >D</label>
                      <label style="margin-right: 35px"><input type="radio" name="jwb" value="E" >E</label>
                    </div>
                    
                  </div>

                </div>
                    
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




<div class="modal fade modal_edit_soal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_ujian/tambah_ujian') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Ujian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row"> 
            <div class="col-md-12">
              <div class="form-group">
                <h4 class="label-control">Input Soal</h4>
                <textarea name="soal" id="eckeditor" class="soal_edit" required></textarea>
              </div>
                
            </div>

            <div class="col-md-12">
              <div class="form-group">
              <br>
                  <h4>Pilihan / Option</h4>
                  <br>

                  <input type="hidden" id="hidden_kode">

                    <label class="bmd-label-floating">Masukkan Option A</label>
                  <div class="form-group">
                    <textarea class="form-control" id="eckeditor1"></textarea>
                  </div>
                    <label class="bmd-label-floating">Masukkan Option B</label>
                  <div class="form-group">
                    <textarea class="form-control" id="eckeditor2"></textarea>
                  </div>
                    <label class="bmd-label-floating">Masukkan Option C</label>
                  <div class="form-group">
                     <textarea class="form-control" id="eckeditor3"></textarea>
                  </div>
                    <label class="bmd-label-floating">Masukkan Option D</label>
                  <div class="form-group">
                     <textarea class="form-control" id="eckeditor4"></textarea>
                  </div>
                    <label class="bmd-label-floating">Masukkan Option E</label>
                  <div class="form-group">
                    <textarea class="form-control" id="eckeditor5"></textarea>
                  </div>

                  <br>
                  <div class="form-group">
                    <label class="label-control">Masukkan Jawaban</label>
                    <br>
                    <div class="radio" >
                      <label style="margin-right: 35px"><input type="radio" name="optradioe" value="A">A</label>
                      <label style="margin-right: 35px"><input type="radio" name="optradioe" value="B" >B</label>
                      <label style="margin-right: 35px"><input type="radio" name="optradioe" value="C" >C</label>
                      <label style="margin-right: 35px"><input type="radio" name="optradioe" value="D" >D</label>
                       <label style="margin-right: 35px"><input type="radio" name="optradioe" value="E" >E</label>
                    </div>
                    
                  </div>
                  <input type="hidden" id="kode_soal">
                  <input type="hidden" id="kode_ujian">

                </div>
                    
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-danger pull-right" onClick="hapus_soal()">Hapus Soal</button>
          <input type="button" class="btn btn-primary" onClick="aksi_edit_soal()" value="Edit">
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_ujian/form') ?>" method="POST"  enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Soal</h5>
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

      

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="preview" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>




<?php include APPPATH.'paginator.class.php'; ?>
<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Ujian</h4>
            <p class="card-category">Detail ujian</p>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <tbody>
            <?php foreach ($data_ujian as $val) { ?>
            <tr>
              <td>Kode ujian</td>
              <td><?php echo $val->kode_ujian; ?></td>
            </tr>
            <tr>
              <td>Nama ujian</td>
              <td><?php echo $val->nama_ujian; ?></td>
           
            </tr>
            <tr>
              <td>Aktif ujian</td>
              <td><?php echo $val->tgl_aktif ?> | <?php echo $val->wkt_aktif ?></td>
              
            </tr>
            <tr>
              <td>Deadline ujian</td>
              <td><?php echo $val->tgl_akhir ?> | <?php echo $val->wkt_akhir ?></td>
            </tr>
            <tr>
              <td>Siswa Mengerjakan</td>
              <td><?php echo $siswa_mengerjakan ?></td>
            </tr>
          </tbody>
        </table>  

        <div class="row">
          <div class="col-md-12">

            <a href="<?php echo site_url('guru_usr_clx/G_ujian/load_hasil_ujian') ?>" class="btn btn-success" style="color : white">Nilai Siswa</a>
           
            <?php 
              if ($siswa_mengerjakan == 0) { ?>
                <?php if ($progress == 100 || $progress == 0) { ?>
                  <button class="btn btn-danger" style="color : white" onClick="hapus_ujian('<?php echo $val->kode_ujian ?>')">Hapus Ujian</button>
                <?php }else{ ?>
                  <span class="d-inline-block" data-toggle="popover" data-content="Tombol hapus disbled ketika ada siswa yg sudah mengerjakan">
                    <button class="btn btn-danger" style="pointer-events: none;" type="button" disabled>Hapus Ujian Disabled</button>
                  </span>

                <?php } ?>
              <?php }else{ ?>
                   <span class="d-inline-block" data-toggle="popover" data-content="Tombol hapus disbled ketika ada siswa yg sudah mengerjakan">
                    <button class="btn btn-danger" style="pointer-events: none;" type="button" disabled>Hapus Ujian Disabled</button>
                  </span>
              <?php }
            ?>
            <a href="<?php echo site_url('guru_usr_clx/G_ujian') ?>" class="btn btn-primary" style="color : white">Kembali</a>
          </div>
        </div>

            <?php } ?>

      </div>

      


    </div>
  </div>
  <div class="col-md-7">
      <div class="card">
          <div class="card-header card-header-primary">
                <h4 class="card-title">Analisis Soal</h4>
                
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                
               
                <?php if ($jml_soal == 0) { ?>
                  
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah Soal Excel</button>
                  <a href="<?php echo site_url('guru_usr_clx/G_ujian/download_template_soal') ?>" class="btn btn-primary pull-right">Download Template</a>
                <?php }else{ ?>
                    <button type="button" class="btn btn-primary pull-right disabled">Tambah Soal Excel Disabled</button>
                
                <?php } ?>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".modal_tambah_soal">Tambah Soal</button>
              
              </div>
            </div>

            <nav aria-label="Page navigation example" style="margin: 20px 0 20px 0">

            <?php 
              if ($analisis_soal) {
                foreach ($analisis_soal as $val) { ?>
                      <button class="btn btn-outline-primary btn-sm" onClick="edit_soal('<?php echo $val->kode_soal ?>')"> <?php  echo $val->no_soal ?> </button>
                <?php } 
              }else{ ?>
                  <p>Belum ada soal</p>
              <?php }
            ?>

            
        
            </nav>
          </div>
          
        </div>
  </div>
</div>

    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>

$(document).ready(function() {

  tabel5 = $('#example5').DataTable({

      "ajax":
      {
      "dataSrc": "ujian",
      "url": "http://localhost/gostudy/guru_usr_clx/G_ujian/load_data_backup", // URL file untuk proses select datanya
      "data" : {},
      "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
      { "render": function ( data, type, row ) { // Tampilkan kolom aksi
          var html  = no++;
          return html
        }
      },
      { "data": "nama_ujian" },
      { "data": "mapel" },
      { "data": "kelas" },
      { "data": "guru" },
      { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
          var html = "";
         
          html = '<a class="btn btn-primary btn-sm" style="color : white" onClick="load_bank_soal(' + row.id +')">Lihat</a>';
          return html; // Tampilkan jenis kelaminnya
        }
      },


      ],
      });

    // -------------NAVBAR ---------
  $('.nav li a[href~="http://localhost/gostudy/guru_usr_clx/G_ujian"]').parents('li').addClass("active");    
  $('.nav li a').click(function(){
        $('.nav li').removeClass("active");
        $('.nav li a[href~="' + location.href + '"]').parents('li').addClass("active");    
    });
    //------------- END -----------

  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor', {

      height: "200px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      
    });
  });

  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor1', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor2', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor3', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor4', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('ckeditor5', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });



  // ---------------------------------  Edit -------------------------------
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor', {

      height: "200px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor1', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor2', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor3', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor4', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
  $(function () {
    CKEDITOR.config.image_previewText = 'Image Preview';
    CKEDITOR.replace('eckeditor5', {

      height: "100px",
      uploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json');?>',

      filebrowserBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html');?>',
      filebrowserImageBrowseUrl: '<?php echo base_url('assets/ckfinder/ckfinder.html?type=Images');?>',
      filebrowserUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
      filebrowserImageUploadUrl: '<?php echo base_url('assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',      

      
    });
  });
 
  


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
        "dataSrc": "data_ujian",
        "url": "http://localhost/gostudy/guru_usr_clx/G_ujian/ambil_data_ujian", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nama_ujian" }, // Tampilkan nis
        { "data": "tgl_dibuat"},
        { "data": "tgl_aktif"},
        { "data": "tgl_akhir"},
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            
            html = '<a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_ujian/detail_ujian/')?>'+ row.kode_ujian +'"> Lihat </a> ';

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


// function aksi_tmb_soal(kode_ujian){

//   var radios = document.getElementsByName('optradio');
//   var jwb;
//   for (var i = 0, length = radios.length; i < length; i++) {
//     if (radios[i].checked) {
//       // do whatever you want with the checked radio
//       jwb = radios[i].value;


//       // only one radio can be logically checked, don't check the rest
//       break;
//     }
//   }


//   var optA = $('#optA').val() 
//   var optB = $('#optB').val() 
//   var optC = $('#optC').val() 
//   var optD = $('#optD').val() 
//   var optE = $('#optE').val()

//   $.ajax({
//       url : "http://localhost/gostudy/guru_usr_clx/G_ujian/save_soal",
//       method: 'POST',
//       dataType: 'json',
//       data: {soal : editor2.getData(), optA : optA, optB : optB, optC : optC, optD : optD, optE : optE, jwb : jwb},
//       contentType: 'application/x-www-form-urlencoded',
//       success: function(data){
        
//         setTimeout(function(){
//             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/detail_ujian/'.$this->session->userdata('kode_ujian')); ?>";
//         }, 1100);

//       },
//       error: function( errorThrown ){
//         console.log( errorThrown);

//       }

//     });
// }

function aksi_edit_soal(){

  var radios = document.getElementsByName('optradioe');
  var jwb;
  for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
      // do whatever you want with the checked radio
      jwb = radios[i].value;


      // only one radio can be logically checked, don't check the rest
      break;
    }
  }

  var soal = CKEDITOR.instances['eckeditor'].getData();
  var optA = CKEDITOR.instances['eckeditor1'].getData(); 
  var optB = CKEDITOR.instances['eckeditor2'].getData(); 
  var optC = CKEDITOR.instances['eckeditor3'].getData(); 
  var optD = CKEDITOR.instances['eckeditor4'].getData(); 
  var optE = CKEDITOR.instances['eckeditor5'].getData();
  var kode_soal = $('#hidden_kode').val()

  $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_ujian/edit_save_soal",
      method: 'POST',
      dataType: 'json',
      data: {soal : soal, optA : optA, optB : optB, optC : optC, optD : optD, optE : optE, jwb : jwb, kode_soal : kode_soal},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        
        setTimeout(function(){
            window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/detail_ujian/'.$this->session->userdata('kode_ujian')); ?>";
        }, 1100);

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });


}

function hapus_ujian(data){
  var id = data;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus ujain ini ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/hapus_ujian",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian') ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}
function hapus_soal(){
  var id = $("#kode_soal").val();
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus soal ini ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/hapus_soal",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
        
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/detail_ujian/'); ?>"+data.kode_ujian;
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}
function bank_soal(kode_ujian){
  var id = kode_ujian;
  Swal.fire({
  title: 'Upload ke bank soal?',
  text: "Apakah kamu ingin upload ke bank soal?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_ujian/upload_bank_soal",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Berhasil!', 'Berhasil upload ke bank soal.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('guru_usr_clx/G_ujian/detail_ujian/'); ?>"+kode_ujian;
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}
var noG =1;

function load_bank_soal(id){
  tabel5 = $('#table_bank_soal').DataTable({

      "ajax":
      {
      "dataSrc": "soal",
      "url": "http://localhost/gostudy/guru_usr_clx/G_ujian/load_data_bank_soal", // URL file untuk proses select datanya
      "data" : {id : id},
      "type": "POST"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
      { "data": "no_soal" },
      { "data": "pertanyaan" },
      { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
            var html = "";
            var code = noG++;
            html = '<div class="form-check"> <label class="form-check-label" for="customCheck\'' + code + '\'"> <input class="form-check-input" type="checkbox" id="customCheck\'' + code + '\'" name="mapel_aktif" value="'+ row.id +'"> <span class="form-check-sign"> <span class="check"></span> </span> </label> </div>'
            return html; // Tampilkan jenis kelaminnya
          }
        },
         


      ],
      });

      $(".bank_soal").modal('show');


}

function edit_soal(kode_soal){
  $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_ujian/load_edit_soal",
      method: 'POST',
      dataType: 'json',
      data: {kode_soal : kode_soal},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        // $('textarea#optAe').val(data.data_soal.op_a); 
        // $('textarea#optBe').val(data.data_soal.op_b) 
        //  $('textarea#optCe').val(data.data_soal.op_c) 
        //  $('textarea#optDe').val(data.data_soal.op_d) 
        //  $('textarea#optEe').val(data.data_soal.op_e)
        
         $('#hidden_kode').val(data.data_soal.kode_soal)
         CKEDITOR.instances['eckeditor'].setData(data.data_soal.pertanyaan)
         CKEDITOR.instances['eckeditor1'].setData(data.data_soal.op_a)
         CKEDITOR.instances['eckeditor2'].setData(data.data_soal.op_b)
         CKEDITOR.instances['eckeditor3'].setData(data.data_soal.op_c)
         CKEDITOR.instances['eckeditor4'].setData(data.data_soal.op_d)
         CKEDITOR.instances['eckeditor5'].setData(data.data_soal.op_e)
         
         
          var $radios = $('input:radio[name=optradioe]');
          $radios.filter('[value='+ data.data_soal.jwb +']').prop('checked', true);

          $("#kode_soal").val(kode_soal);

         $('.modal_edit_soal').modal('show');
        
      },
      error: function( errorThrown ){
        console.log( errorThrown);

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









