
<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-12">
   
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
                  <i class="material-icons">class</i> User Guru
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#siswa_aktif" data-toggle="tab">
                  <i class="material-icons">person</i> User Siswa
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
                  <th>Nip/Kode</th>
                  <th>Nama Guru</th>
                  <th>Username</th>
                  <th>Password</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nip/Kode</th>
                  <th>Nama Guru</th>
                   <th>Username</th>
                  <th>Password</th>
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
                   <th>Username</th>
                  <th>Password</th>
                  
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                   <th>Username</th>
                  <th>Password</th>
                
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
  $('#nama_kelas').text('Kelas : ' + localStorage.getItem('nama_kelas'));
  $('.nav li a[href~="http://localhost/gostudy/go_ciclx_usradmin/A_data_user"]').parents('li').addClass("active");    
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
        "dataSrc": "data_guru",
        "url": "http://localhost/gostudy/go_ciclx_usradmin/A_guru/data_user", // URL file untuk proses select datanya
        
        "type": "GET"
      },

      // "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
      "columns": [
        { "render": function ( data, type, row ) { // Tampilkan kolom aksi
              var html  = no_m++;
              return html
            }
        },
        { "data": "nip" }, // Tampilkan nis
        { "data": "nama_guru" }, // Tampilkan nis
        { "data": "username" }, // Tampilkan nis
        { "data": "password" }, // Tampilkan nis
        
       
        
      ],
    });

    tabel2 = $('#example2').DataTable({

        "ajax":
        {
          "dataSrc": "data",
          "url": "http://localhost/gostudy/go_ciclx_usradmin/A_siswa/data_user", // URL file untuk proses select datanya
          
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
        { "data": "nama_siswa" }, // Tampilkan nis
        { "data": "username" }, // Tampilkan nis
        { "data": "password" }, // Tampilkan nis
        
        ],
        });

        


        // -------------------- Modal ---------------------
    
    
}); 



// ----------------- Pilih Guru di mapel ------------------
function aksiPilihGuru(kode_mapel){
  console.log(kode_mapel);
  console.log(localStorage.getItem('kode_kelas'));
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/guru_in_mapel",
        method: 'GET',
        data: {kode_mapel : kode_mapel, kode_kelas : localStorage.getItem('kode_kelas')},
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          nextAksiPilihGuru(data.dataGuru, localStorage.getItem('kode_kelas'), kode_mapel);
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}

async function nextAksiPilihGuru(data, kode_kelas, kode_mapel){
  const { value: kode_guru } = await Swal.fire({
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

if (kode_guru) {
  insert_guru_in_mapel(kode_guru, kode_kelas, kode_mapel)
}
}


function insert_guru_in_mapel(kode_guru, kode_kelas, kode_mapel){
  $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/insert_guru_in_mapel",
        method: 'POST',
        data : {kode_guru:kode_guru, kode_kelas:kode_kelas, kode_mapel:kode_mapel}, 
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          
          setTimeout(function(){
            window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>";
          }, 400);
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      });
}


// ---------------- End ---------------------------------



function aksiHapusMapel(kode_mapel, nama){
  var namaMapel = nama;
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah kamu ingin menhapus mapel " + namaMapel + "!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url : "http://localhost/gostudy/go_ciclx_usradmin/A_kelas/hapus_mapel",
        method: 'POST',
        dataType: 'json',
        data: {kode_kelas : localStorage.getItem('kode_kelas'), kode_mapel : kode_mapel },
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          Swal.fire('Deleted!', 'Berhasil menghapus.', 'success');
          setTimeout(function(){
             window.location.href = "<?php echo base_url('go_ciclx_usradmin/A_kelas/nextAksi'); ?>";
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


