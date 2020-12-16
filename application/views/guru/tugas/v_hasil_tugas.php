
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_hasil">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_tugas/tambah_tugas') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Upload Tugas Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div id="slcTgs">
          
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


<div class="content">
  <div class="container-fluid">

<div class="row">
  <div class="col-md-4">
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
          </tbody>
        </table>  

        <div class="row">
        <div class="col-md-12">
         <?php 

        if ($backup == 1) { ?>
           <button class="btn btn-info pull-right disabled" style="">Backup Nilai Disabled</button>
        <?php }else{ 
            if ($progress == 100) { ?>
            
            <button class="btn btn-info pull-right" style="" onClick="backup_nilai()">Backup Nilai</button>
          <?php } else { ?>
            <button class="btn btn-info pull-right disabled" style="">Backup Nilai Disabled</button>
          <?php }
         }
          
          
        ?>  
          `<a href="<?php echo base_url("guru_usr_clx/G_tugas/detail_tugas/").$val->kode_tugas ?>" class="btn btn-primary pull-right">Kembali</a>`
             
        </div>
            <?php } ?>
      </div>


      </div>

      


    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Input Nilai Siswa</h4>
            <p class="card-category"></p>
      </div>
      <div class="card-body table-responsive">
      <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: <?php echo $progress ?>%;" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progress ?>%</div>
        </div>
        <table id="data_hasil_siswa" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Upload Tugas Siswa</th>
                <th>Input Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
                <?php 
               
               
                    foreach ($daftar_siswa as $val) { ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $val->nis ?></td>
                            <td><?php echo $val->nama_siswa ?></td>
                            <td> <button type="button" class="btn btn-primary btn-sm" onClick="aksi_lihat_tugas('<?php echo $val->kode_siswa ?>')">Lihat</button></td>
                           <?php if ($val->nilai != null) { ?>
                           <td><button type="button" class="btn btn-primary btn-sm" onClick="aksiInput('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">
                              Input Nilai 
                             
                              <span class="badge badge-light"><?php echo $val->nilai  ?></span>
                            </button></td>
                              <?php }else{ ?>
                              <td><button type="button" class="btn btn-danger btn-sm" onClick="aksiInput('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">
                              Input Nilai 
                             
                                <span class="badge badge-light">--</span>
                            </button></td>
                              
                             <?php  } ?>
                            
                        </tr>
                   <?php }
                ?>
          </tbody>
      
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
  // -------------NAVBAR ---------
  $('.nav li a[href~="http://localhost/gostudy/guru_usr_clx/G_tugas"]').parents('li').addClass("active");    
  $('.nav li a').click(function(){
        $('.nav li').removeClass("active");
        $('.nav li a[href~="' + location.href + '"]').parents('li').addClass("active");    
    });
    //------------- END -----------


    var no =1;
    $('#example').DataTable();
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tabel = $('#data_hasil_siswa').DataTable();
    
}); 


function aksi_lihat_tugas(kode_siswa){
  var table = '';
 
   $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_tugas/load_hasil_siswa",
        method: 'POST',
        dataType: 'json',
        data: {kode_siswa : kode_siswa},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          
          table += '<table class="table table-hover" style="width: 100%">';
          table += '<thead>';
          table += '<tr>';
          table += '<th scope="col">Revisi</th>';
          table += '<th scope="col">Nama File</th>';
          table += '<th scope="col">Status</th>';
          table += '<th scope="col">Download</th>';
          table += '</tr>';
          table += '</thead>';
          table += '<tbody>';
              
          if (data.hasil.length > 0) {  
            $.each(data.hasil, function(idx, obj){
              table += '<tr>';
              table += '<td>' + obj.rev + '</td>';
              table += '<td>' + obj.nama_file + '</td>';
              if (obj.status == 1) {
              table += '<td><span class="badge badge-pill badge-success">Tepat</span></td>';    
                
              }else{
              table += '<td><span class="badge badge-pill badge-danger">Terlambat</span></td>';    

              }    
              table += '<td> <a class="btn btn-outline-primary btn-sm" href="<?php echo site_url('guru_usr_clx/G_tugas/aksi_download/')?>'+ obj.nama_file +'"> Download </a></td>';
              table += '</tr>';
            });
          }else{
              table += '<tr>';
              table += '<td colspan="4"> <span class="badge badge-pill badge-danger">belum upload tugas</span></td>';
              table += '</tr>';
          }
          table += '</tbody>';
          table +=  '</table>';
          

          $("#slcTgs").html(table)
          $('#modal_hasil').modal('show');
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);

        }

      })


// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }
}

async function aksiInput(kode_siswa, nama_siswa){
          const { value: formValues } = Swal.fire({

            title: nama_siswa,
            html: '<label style="float: left">Nilai</label>' +
          '<input type="number" class="form-control" name="nilai_tugas" pattern="[0-9]+" id="swal-input1" min=0 max=100>',
            focusConfirm: false,
            preConfirm: () => {
              
              var nilai_tugas = document.getElementById('swal-input1').value;
              if(nilai_tugas < 0){
                console.log("err")
              }else if(nilai_tugas > 100){
                console.log("err")
              }else{
                input_tugas(nilai_tugas, kode_siswa);
              }
            }
          })
          
    




// if (formValues) {
//   Swal.fire(JSON.stringify(formValues))
// }
}


function input_tugas(nilai, kode_siswa){
  $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_tugas/input_nilai_tugas",
      method: 'POST',
      dataType: 'json',
      data: {nilai:nilai, kode_siswa:kode_siswa},
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        console.log(data)
        Swal.fire('Berhasil!', 'Berhasil Menambahkan Nilai', 'success');
        setTimeout(function(){
            window.location.href = "<?php echo base_url('guru_usr_clx/G_tugas/hasil_siswa/'); ?>"+data.kode_tugas;
        }, 1100);

      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
}


function backup_nilai(){

   $.ajax({
      url : "http://localhost/gostudy/guru_usr_clx/G_ujian/ambil_nilai",
      method: 'GET',
      dataType: 'json',
      contentType: 'application/x-www-form-urlencoded',
      success: function(data){
        console.log(data);
        aksiPilih(data.nilai);
      },
      error: function( errorThrown ){
        console.log( errorThrown);

      }

    });
   
}

async function aksiPilih(data, kode_guru){
  const { value: fruit } = await Swal.fire({
  title: 'Select field validation',
  input: 'select',
  inputOptions: data,
  inputPlaceholder: 'Pilih Nilai',
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
      resolve()
    })
  }
})

if (fruit) {
  aksi_backup_nilai(fruit)
}
}

function aksi_backup_nilai(kode_nilai){
  $.ajax({
        url : "http://localhost/gostudy/guru_usr_clx/G_tugas/aksi_backup_nilai",
        method: 'POST',
        data : {kode_nilai:kode_nilai}, 
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        success: function(data){
          console.log(data);
          Swal.fire('Berhasil!', 'Berhasil Backup', 'success');
          setTimeout(function(){
              window.location.href = "<?php echo base_url('guru_usr_clx/G_tugas/hasil_siswa/'); ?>"+data.kode_tugas;
          }, 1100);
          
        },
        error: function( errorThrown ){
          console.log( errorThrown);
          
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









