
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_hasil">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form" action="<?php echo base_url('guru_usr_clx/G_tugas/tambah_tugas') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tugas</h5>
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
  <div class="col-md-12">
  <div class="card">
      <div class="card-header card-header-primary">
            <h4 class="card-title">Materi</h4>
            <p class="card-category">New employees on 15th September, 2016</p>
      </div>
      <div class="card-body table-responsive">
        <table id="data_hasil_siswa" class="table table-hover" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Lihat Tugas</th>
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
                            <td> <button type="button" class="btn btn-primary" onClick="aksi_lihat_tugas('<?php echo $val->kode_siswa ?>')">Lihat</button></td>
                           <?php if ($val->nilai) { ?>
                           <td><button type="button" class="btn btn-primary" onClick="aksiInput('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">
                              Input Nilai 
                             
                              <span class="badge badge-light"><?php echo $val->nilai  ?></span>
                            </button></td>
                              <?php }else{ ?>
                              <td><button type="button" class="btn btn-danger" onClick="aksiInput('<?php echo $val->kode_siswa ?>', '<?php echo $val->nama_siswa ?>')">
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
        Swal.fire('Deleted!', 'Berhasil Merubah', 'success');
        setTimeout(function(){
            window.location.href = "<?php echo base_url('guru_usr_clx/G_tugas/hasil_siswa/Tg_HH17EGZ'); ?>";
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









