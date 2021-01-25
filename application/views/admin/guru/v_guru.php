
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/A_guru/tambah') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">NIP</label>
                <input type="number" class="form-control" name="nip" pattern="[0-9]+" required>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nama Guru</label>
                <input type="text" class="form-control" name="nama" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Username</label>
                <input type="text" class="form-control" value="Username diambil dari NIP" disabled>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">Password (Random)</label>
                <input type="text" class="form-control" name="password" value="<?php echo $password ?>" readonly>
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


<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/A_guru/form') ?>" method="POST"  enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Guru</h5>
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

<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
    <a href="<?php echo site_url('go_ciclx_usradmin/A_guru/download_template') ?>" class="btn btn-primary pull-right">Download Template</a>
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah Guru Excel</button>  
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Guru</button>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Guru</h4>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="guru_aktif">
          <table id="example1" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Mengampu</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Mengampu</th>
                  <th>Aksi</th>
                
              </tr>
            </tfoot>
          </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>



  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('admin/footer'); ?>



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
        "dataSrc": "dataGuru",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_guru/data_guru", // URL file untuk proses select datanya
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
            var html  = no++;
            return html
          }
        },
        { "data": "nip" }, // Tampilkan nis
        { "data": "nama_guru" },  // Tampilkan nama
        { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
            var html = ""
            if(row.kode_mapel == null){ // Jika jenis kelaminnya 1
              html = '<button class="btn btn-primary btn-sm" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )"> Pilih </button>' // Set laki-laki
            }else{ // Jika bukan 1
              html = '<button class="btn btn-success btn-sm" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )">  ' +  row.nama_mapel +'   </button>'
            }   
            return html; // Tampilkan jenis kelaminnya
          }
        },
       
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-warning btn-sm" onClick="aksiEdit(\'' + row.kode_guru + '\' )"> Edit  </button>   <button class="btn btn-danger btn-sm" onClick="aksiHapus(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Hapus </button>';

            return html
          }
        },
      ],
    });

    tabel2 = $('#example2').DataTable({

        "ajax":
        {
          "dataSrc": "dataGuru",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_guru/data_guru_ban", // URL file untuk proses select datanya
          "type": "GET"
        },

        // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
        "columns": [
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no++;
              return html
            }
          },
          { "data": "nip" }, // Tampilkan nis
          { "data": "nama_guru" },  // Tampilkan nama
          { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
              var html1 = ""
              if(row.kode_mapel == null){ // Jika jenis kelaminnya 1
                html1 += 'Belum ditentukan' // Set laki-laki
              }else{ // Jika bukan 1
                html1 += row.nama_mapel; 
              }
              return html1; // Tampilkan jenis kelaminnya
            }
          },
        
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi

              
              html = '<button class="btn btn-primary btn-sm" onClick="aksiAktif(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

              return html
            }
          },
        ],
        });
    
}); 

function aksiHapus(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus Guru " + namaGuru + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/hapus_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


function aksiBanned(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin membekukan Guru " + namaGuru + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/ban_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

async function aksiEdit(kode_guru){
   $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/load_edit_guru",
        method: 'POST',
        dataType: 'json',
        data: {kode_guru : kode_guru},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          const { value: formValues } = Swal.fire({

            title: 'Edit Guru',
            html: '<label style="float: left">NIP</label>' +
          '<input type="number" class="form-control" name="nip" pattern="[0-9]+" id="swal-input1" value="'+data.data.nip+'">'+
          '<label style="margin-top: 25px; float: left;">Nama Guru</label>' +
          '<input type="text" class="form-control" name="nama" id="swal-input2" value="'+data.data.nama_guru+'">',
            focusConfirm: false,
            preConfirm: () => {
              
              var nip = document.getElementById('swal-input1').value;
              var nama = document.getElementById('swal-input2').value;
              editGuru(nip, nama, kode_guru);
            }
          })
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      })


// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }
}


function aksiAktif(data, nama){
  var id = data;
  var namaGuru = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin mengaktifkan Guru " + namaGuru + "?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/aktifkan_guru",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

async function aksiPilih(data, kode_guru){
  const { value: fruit } = await Swal.fire({
  title: 'Select field validation',
  input: 'select',
  inputOptions: data,
  inputPlaceholder: 'Pilih Guru',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      resolve()
    })
  }
})

if (fruit) {
  aksi_tambah_pengampu(fruit, kode_guru)
}
}

function aksiTmbMapel(kode_guru){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_mapel/data_mapel",
        method: 'GET',
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          aksiPilih(data.dataMapel, kode_guru);
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}


function aksi_tambah_pengampu(kode_mapel, kode_guru){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/tambah_pengampu",
        method: 'POST',
        data : {kode_mapel:kode_mapel, kode_guru:kode_guru}, 
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          Swal.fire('Deleted!', 'Berhasil Merubah', 'success');
          setTimeout(function(){
              window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
          }, 1100);
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);
          
        }

      });
}

function editGuru(nip, nama, kode_guru){
  $.ajax({
      url : "http://localhost/gostudy/go_ciclx_usradmin/A_guru/edit_guru",
      method: 'POST',
      dataType: 'json',
      data: {nip:nip, nama:nama, kode_guru:kode_guru},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        Swal.fire('Deleted!', 'Berhasil Merubah', 'success');
        setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_guru'); ?>";
        }, 1100);

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
}

?>



