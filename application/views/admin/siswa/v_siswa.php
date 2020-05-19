
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/A_siswa/tambah') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">NIS</label>
                <input type="text" class="form-control" name="nis" required>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nama Siswa</label>
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
      <form class="form" action="<?php echo base_url('go_ciclx_usradmin/A_siswa/tambah') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah siswa</h5>
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
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah siswa Excel</button>  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Siswa</button>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">Data Siswa :</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#siswa_aktif" data-toggle="tab">
                  <i class="material-icons">bug_report</i> Daftar Siswa Aktif
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#siswa_ban" data-toggle="tab">
                  <i class="material-icons">code</i> Daftar Siswa Banned
                  <div class="ripple-container"></div>
                </a>
              </li>          
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="siswa_aktif">
          <table id="example1" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Aksi</th>
                
              </tr>
            </tfoot>
          </table>
          </div>
          <div class="tab-pane" id="siswa_ban">
          <table id="example2" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
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
        "dataSrc": "dataSiswa",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/data_siswa", // URL file untuk proses select datanya
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
        { "data": "nama_siswa" },  // Tampilkan nama
        { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
            var html = ""
            if(row.kode_kelas == null){ // Jika jenis kelaminnya 1
              html += 'Belum ditentukan'
            }else{ // Jika bukan 1
              html += row.nama_kelas
            }
            return html; // Tampilkan jenis kelaminnya
          }
        },
       
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi

            
            html = '<button class="btn btn-warning btn-xs" onClick="aksiBanned(\'' + row.kode_siswa + '\' , \'' + row.nama_siswa + '\')"> Banned <i class="material-icons">report</i> </button> <button class="btn btn-danger btn-xs" onClick="aksiHapus(\'' + row.kode_siswa + '\' , \'' + row.nama_siswa + '\')"> Hapus <i class="material-icons">delete_forever</i> </button>';

            return html
          }
        },
      ],
    });

    tabel2 = $('#example2').DataTable({

        "ajax":
        {
          "dataSrc": "dataSiswa",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/data_siswa_ban", // URL file untuk proses select datanya
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
          { "data": "nama_siswa" },  // Tampilkan nama
          { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
              var html1 = ""
              if(row.kode_kelas == null){ // Jika jenis kelaminnya 1
                html1 += 'Belum ditentukan' // Set laki-laki
              }else{ // Jika bukan 1
                html1 += row.nama_kelas
              }
              return html1; // Tampilkan jenis kelaminnya
            }
          },
        
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi

              
              html = '<button class="btn btn-primary btn-xs" onClick="aksiAktif(\'' + row.kode_siswa + '\' , \'' + row.nama_siswa + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

              return html
            }
          },
        ],
        });
    
}); 

function aksiHapus(data, nama){
  var id = data;
  var namasiswa = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus siswa " + namasiswa + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/hapus_siswa",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_siswa'); ?>";
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
  var namasiswa = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin membekukan siswa " + namasiswa + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/ban_siswa",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_siswa'); ?>";
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
  var namasiswa = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin mengaktifkan siswa " + namasiswa + "?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/aktifkan_siswa",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil membekukan.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_siswa'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}

async function aksiPilih(data){
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
  Swal.fire(`You selected: ${fruit}`)
}
}

function aksiTmbMapel(){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_mapel/data_mapel",
        method: 'GET',
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          aksiPilih(data.dataMapel);
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


