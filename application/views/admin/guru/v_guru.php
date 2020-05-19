
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
                <input type="text" class="form-control" name="nip" required>
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
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/A_guru/tambah') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">     
          <div class="form-group">
          <label for="nama_materi">Upload Data Exel</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile">Pilih File</label>
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
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah Guru Excel</button>  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Guru</button>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">Data Guru :</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#guru_aktif" data-toggle="tab">
                  <i class="material-icons">bug_report</i> Daftar Guru Aktif
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#guru_ban" data-toggle="tab">
                  <i class="material-icons">code</i> Daftar Guru Banned
                  <div class="ripple-container"></div>
                </a>
              </li>          
            </ul>
          </div>
        </div>
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
          <div class="tab-pane" id="guru_ban">
          <table id="example2" class="table table-hover" style="width:100%">
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
              html = '<button class="btn btn-primary btn-xs" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )"> Pilih <i class="material-icons">report</i> </button>' // Set laki-laki
            }else{ // Jika bukan 1
              html = '<button class="btn btn-success btn-xs" onClick="aksiTmbMapel(\'' + row.kode_guru + '\' )">  ' +  row.nama_mapel +'   </button>'
            }   
            return html; // Tampilkan jenis kelaminnya
          }
        },
       
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-warning btn-xs" onClick="aksiBanned(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Banned <i class="material-icons">report</i> </button> <button class="btn btn-danger btn-xs" onClick="aksiHapus(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Hapus <i class="material-icons">delete_forever</i> </button>';

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

              
              html = '<button class="btn btn-primary btn-xs" onClick="aksiAktif(\'' + row.kode_guru + '\' , \'' + row.nama_guru + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

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
  confirmButtonText: 'Yes, delete it!'
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
  inputPlaceholder: 'Select a fruit',
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
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}

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



