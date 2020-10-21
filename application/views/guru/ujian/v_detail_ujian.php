

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
                <label class="label-control">Input Soal</label>
                <textarea name="soal" id="eckeditor" class="soal_edit" required></textarea>
              </div>
                
            </div>

            <div class="col-md-12">
              <div class="form-group">
                  <label>Pilihan / Option</label>
                  <br>

                  <input type="hidden" id="hidden_kode">

                  <div class="form-group">
                    <textarea class="form-control" id="eckeditor1"></textarea>
                  </div>
                  <div class="form-group">
                   
                    <textarea class="form-control" id="eckeditor2"></textarea>
                  </div>
                  <div class="form-group">
                    
                     <textarea class="form-control" id="eckeditor3"></textarea>
                  </div>
                  <div class="form-group">
                    
                     <textarea class="form-control" id="eckeditor4"></textarea>
                  </div>
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

                </div>
                    
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="button" class="btn btn-primary" onClick="aksi_edit_soal()" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/G_ujian/form') ?>" method="POST"  enctype="multipart/form-data">
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
            <h4 class="card-title">ujian</h4>
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
              <td><?php echo $val->tgl_aktif ?> / <?php echo $val->wkt_aktif ?></td>
              
            </tr>
            <tr>
              <td>Deadline ujian</td>
              <td><?php echo $val->tgl_akhir ?> / <?php echo $val->wkt_akhir ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>  

        <div class="row">
          <div class="col-md-12">

            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Upload Siswa</button>
            
          </div>
        </div>


      </div>

      


    </div>
  </div>
  <div class="col-md-7">
      <div class="card">
          <div class="card-header card-header-primary">
                <h4 class="card-title">Analisis Soal</h4>
                <p class="card-category">Detail ujian</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".modal_tambah_soal">Tambah Soal</button>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah Soal Excel</button>
              
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









