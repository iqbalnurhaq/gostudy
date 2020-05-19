
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    
          <table id="example3" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Aksi</th>
                
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Aksi</th>
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


<div class="modal fade bd-example-modal-lg-excel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Murid</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example4" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
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
                <th>Aksi</th>
              
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="simpan_siswa_aktif">Save</button>
        </div>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg-nilai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">    
          <table id="example5" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Nilai</th>
                <th>Aksi</th>
                
            </tr>
          </thead>
          <tbody>
                
          </tbody>
          <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Nilai</th>
                <th>Aksi</th>
            </tr>
          </tfoot>
          </table>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="simpan_nilai_aktif">Save</button>
        </div>
     
    </div>
  </div>
</div>


<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-nilai">Tambah Nilai</button> <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg-excel">Tambah Siswa</button>  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Mapel</button>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">Data kelas :</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#mapel_aktif" data-toggle="tab">
                  <i class="material-icons">bug_report</i> Daftar Mapel Aktif
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#siswa_aktif" data-toggle="tab">
                  <i class="material-icons">code</i> Daftar Siswa Aktif
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#nilai_aktif" data-toggle="tab">
                  <i class="material-icons">code</i> Daftar Nilai Aktif
                  <div class="ripple-container"></div>
                </a>
              </li>             
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="mapel_aktif">
          <table id="example1" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Mapel</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Mapel</th>
                  <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
          </div>
          <div class="tab-pane" id="siswa_aktif">
          <table id="example2" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Aksi</th>
                
              </tr>
            </tfoot>
          </table>
          </div>
          <div class="tab-pane" id="nilai_aktif">
          <table id="example6" class="table table-hover" style="width:100%">
            <thead>
              <tr>
                  <th>No</th>
                
                  <th>Nama Nilai</th>
                  <th>Aksi</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
           
                  <th>Nama Nilai</th>
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
  $('.nav li a[href~="http://localhost/gostudy/go_ciclx_usradmin/A_kelas"]').parents('li').addClass("active");    
    var no =1;
    var noG =1;
    var no_s = 1;
    var no_m = 1;
    var no_n = 1;
    $('#example').DataTable();
    $('#date_time_mask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#example1').DataTable({

      "ajax":
      {
        "dataSrc": "data_mapel",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/data_mapel_aktif", // URL file untuk proses select datanya
        "data" : {"kode_kelas" : localStorage.getItem('kode_kelas')},
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no_m++;
              return html
            }
        },
        { "data": "nama_mapel" }, // Tampilkan nis
        { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
            var html = ""
            
              html = '<button class="btn btn-danger btn-xs" onClick="aksi_hps_mapel_aktif(\'' + row.kode_mapel + '\' )"> Pilih <i class="material-icons">report</i> </button>' // Set laki-laki
            return html; // Tampilkan jenis kelaminnya
          }
        },
       
        
      ],
    });

    tabel2 = $('#example2').DataTable({

        "ajax":
        {
          "dataSrc": "data_siswa",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/data_siswa_aktif", // URL file untuk proses select datanya
          "data" : {"kode_kelas" : localStorage.getItem('kode_kelas')},
          "type": "GET"
        },

        // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
        "columns": [
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no_s++;
              return html
            }
          },
          { "data": "nis" }, // Tampilkan nis
          { "data": "nama_siswa" },  // Tampilkan nama
        
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi

              
              html = '<button class="btn btn-primary btn-xs" onClick="aksiAktif(\'' + row.kode_kelas + '\' , \'' + row.nama_kelas + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

              return html
            }
          },
        ],
        });

        tabel2 = $('#example6').DataTable({

        "ajax":
        {
          "dataSrc": "data_nilai",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/data_nilai_aktif", // URL file untuk proses select datanya
          "data" : {"kode_kelas" : localStorage.getItem('kode_kelas')},
          "type": "GET"
        },

        // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
        "columns": [
          { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no_n++;
              return html
            }
          },
          { "data": "nama_nilai" },  // Tampilkan nama

          { "render": function ( data, type, row ) { // Tampilkan kolom aksi

              
              html = '<button class="btn btn-primary btn-xs" onClick="aksiAktif(\'' + row.kode_kelas + '\' , \'' + row.nama_kelas + '\')"> Aktifkan <i class="material-icons">report</i> </button> ';

              return html
            }
          },
        ],
        });


        // -------------------- Modal ----------------------


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
          { "data": "nama_mapel" }, // Tampilkan nis
          { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
              var html = "";
              var code = noG++;
              html = '<div class="form-check"> <label class="form-check-label" for="customCheck\'' + code + '\'"> <input class="form-check-input" type="checkbox" id="customCheck\'' + code + '\'" name="mapel_aktif" value="'+ row.kode_mapel +'"> <span class="form-check-sign"> <span class="check"></span> </span> </label> </div>'
              return html; // Tampilkan jenis kelaminnya
            }
          },
         

      
        ],
        });

    tabel4 = $('#example4').DataTable({

    "ajax":
    {
      "dataSrc": "data_siswa",
      "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/load_data_siswa", // URL file untuk proses select datanya
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
      { "data": "nama_siswa" },
      { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
          var html = "";
          var code = noG++;
          html = '<div class="form-check"> <label class="form-check-label" for="customCheck\'' + code + '\'"> <input class="form-check-input" type="checkbox" id="customCheck\'' + code + '\'" name="siswa_aktif" value="'+ row.kode_siswa +'"> <span class="form-check-sign"> <span class="check"></span> </span> </label> </div>'
          return html; // Tampilkan jenis kelaminnya
        }
      },

   
    ],
    });

    tabel5 = $('#example5').DataTable({

      "ajax":
      {
      "dataSrc": "data_nilai",
      "url": "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/load_data_nilai", // URL file untuk proses select datanya
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
      { "data": "nama_nilai" },
      { "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
          var html = "";
          var code = noG++;
          html = '<div class="form-check"> <label class="form-check-label" for="customCheck\'' + code + '\'"> <input class="form-check-input" type="checkbox" id="customCheck\'' + code + '\'" name="nilai_aktif" value="'+ row.kode_nilai +'"> <span class="form-check-sign"> <span class="check"></span> </span> </label> </div>'
          return html; // Tampilkan jenis kelaminnya
        }
      },


      ],
      });
    
}); 

function aksiHapus(data, nama){
  var id = data;
  var namakelas = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus kelas " + namakelas + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/hapus_kelas",
        method: 'POST',
        dataType: 'json',
        data: {id : id},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas'); ?>";
          }, 1100);

        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });

    }
  });

}


async function aksiPilih(data, kode_kelas){
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
  aksi_tambah_pengampu(fruit, kode_kelas)
}
}

function aksiTmbMapel(kode_kelas){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_mapel/data_mapel",
        method: 'GET',
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          aksiPilih(data.dataMapel, kode_kelas);
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}


function aksi_tambah_pengampu(kode_mapel, kode_kelas){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/tambah_pengampu",
        method: 'POST',
        data : {kode_mapel:kode_mapel, kode_kelas:kode_kelas}, 
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


// -------------------------- Aksi Cek ----------
$("#simpan_mapel_aktif").click(function(){
  var code = [];
  $.each($("input[name='mapel_aktif']:checked"), function(){
    code.push($(this).val());
  });
  if (code && code.length > 0) {
    console.log(code);

    $.ajax({
      url : 'http://localhost/gostudy/go_ciclx_usradmin/A_kelas/tambah_mapel_aktif',
      method: 'POST',
      dataType: 'json',
      contentType: 'application/x-www-form-urlencoded',
      data: {kode_mapel : code, kode_kelas : localStorage.getItem('kode_kelas')},
      success: function(data){
        console.log(data);
        setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>";
        }, 400);
           
      },
      error: function( errorThrown ){
        console.log(errorThrown)
      }
    });

  }else{
    Swal.fire({
      title: 'Peringatan!!!',
      text: "Anda belum memilih Mapel, Silahkan pilih mapel terlebih dahulu!",
      type: 'warning',
      })
    }

});



$("#simpan_siswa_aktif").click(function(){
  var code = [];
  $.each($("input[name='siswa_aktif']:checked"), function(){
    code.push($(this).val());
  });
  if (code && code.length > 0) {
    console.log(code);

    $.ajax({
      url : 'http://localhost/gostudy/go_ciclx_usradmin/A_kelas/tambah_siswa_aktif',
      method: 'POST',
      dataType: 'json',
      contentType: 'application/x-www-form-urlencoded',
      data: {kode_siswa : code, kode_kelas : localStorage.getItem('kode_kelas')},
      success: function(data){
        console.log(data);
        setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>";
        }, 400);
           
      },
      error: function( errorThrown ){
        console.log(errorThrown)
      }
    });

  }else{
    Swal.fire({
      title: 'Peringatan!!!',
      text: "Anda belum memilih Mapel, Silahkan pilih mapel terlebih dahulu!",
      type: 'warning',
      })
    }

});


$("#simpan_nilai_aktif").click(function(){
  var code = [];
  $.each($("input[name='nilai_aktif']:checked"), function(){
    code.push($(this).val());
  });
  if (code && code.length > 0) {
    console.log(code);

    $.ajax({
      url : 'http://localhost/gostudy/go_ciclx_usradmin/A_kelas/tambah_nilai_aktif',
      method: 'POST',
      dataType: 'json',
      contentType: 'application/x-www-form-urlencoded',
      data: {kode_nilai : code, kode_kelas : localStorage.getItem('kode_kelas')},
      success: function(data){
        console.log(data);
        setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>";
        }, 400);
           
      },
      error: function( errorThrown ){
        console.log(errorThrown)
      }
    });

  }else{
    Swal.fire({
      title: 'Peringatan!!!',
      text: "Anda belum memilih Mapel, Silahkan pilih nilai terlebih dahulu!",
      type: 'warning',
      })
    }

});


$('.nav .nav-item a').click(function(){
  $(this).parents('li').addClass("active"); 
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


