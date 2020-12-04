
<style>
  img{
    max-height: 300px;
    max-width:100%;
  }
</style>

<div class="content">
  <div class="container">


<div class="card" style="margin-top: 70px">
  <div class="card-header card-header-danger">
    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
          <h2 class="countdown"></h2>
        </div>
        <div class="col-sm-5"></div>
      </div>
    </div>
</div>
  
  
  <?php foreach ($soal as $val) { ?>
    
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
             
                <h4><span class="badge badge-pill badge-primary"><?php echo $val->no_soal; ?></span></h4>
                <?php echo $val->pertanyaan ?>
            
                <hr>

                <div class="row">
                  <div class="col-md-6">

                  <div class="form-check form-check-radio">
                
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios<?php echo $val->no_soal ?>" id="exampleRadios<?php echo $val->no_soal ?>" value="<?php echo $val->kode_soal ?>-A" >
                         A. <?php echo $val->op_a; ?>
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                         
                      </label>
                  </div>
                  
                    
                  </div>

                  <div class="col-md-6">
                  

                         <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios<?php echo $val->no_soal ?>" id="exampleRadios<?php echo $val->no_soal ?>" value="<?php echo $val->kode_soal ?>-D" >
                         D. <?php echo $val->op_d; ?>
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                         
                      </label>
                  </div>


                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  

                         <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios<?php echo $val->no_soal ?>" id="exampleRadios<?php echo $val->no_soal ?>" value="<?php echo $val->kode_soal ?>-B" >
                         B. <?php echo $val->op_b; ?>
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                         
                      </label>
                  </div>


                  </div>

                  <div class="col-md-6">
                    

                       <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios<?php echo $val->no_soal ?>" id="exampleRadios<?php echo $val->no_soal ?>" value="<?php echo $val->kode_soal ?>-E" >
                         E. <?php echo $val->op_e; ?>
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                         
                      </label>
                  </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                  
                
                       <div class="form-check form-check-radio">
                      <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadios<?php echo $val->no_soal ?>" id="exampleRadios<?php echo $val->no_soal ?>" value="<?php echo $val->kode_soal ?>-C" >
                         C. <?php echo $val->op_c; ?>
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                         
                      </label>
                  </div>


                  </div>
                </div>
                

                
            </div>
            
        </div>
    </div>
  </div>

   

  <?php } ?>


  <div class="card">
     <div class="card-body text-center">
            <button type="button" class="btn btn-primary" id="savechecklist" name="button">SELESAI</button>

          </div>
  </div>
  <!-- ------------------------------- ///// ------------------ -->
    
    
  </div>
</div>

      <?php $this->load->view('guru/footer'); ?>



<script>

$(document).ready(function() {


  $.ajax({
    url : 'http://localhost/gostudy/siswa/S_ujian/durasi',
    method: 'POST',
    dataType: 'json',
    contentType: 'application/x-www-form-urlencoded',
    data: {},
    success: function(data){
    
      console.log(data)

      var timer2 = data.a;
      var interval = setInterval(function() {


        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        if (minutes == 10 && seconds == 00) {
          Swal.fire({
              icon: 'info',
              title: 'Informasi',
              text: 'Waktu mengerjakan anda tinggal 10 menit!',
              type: 'warning',
            })
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }else if(minutes == 05 && seconds == 00){
          Swal.fire({
              icon: 'warning',
              title: 'Peringatan!!!',
              text: 'Waktu mengerjakan anda tinggal 5 menit!!!',
              type: 'warning',
            })
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }else if(minutes == 01 && seconds == 00){
          Swal.fire({
              icon: 'warning',
              title: 'Peringatan!!!',
              text: 'Segera tekan tombol selesai!!!',
              type: 'warning',
            })
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }else if(minutes == 0 && seconds == 00){
          
            var pilGan;
            pilGan = getChecklistItems();
            $.ajax({
              url : 'http://localhost/gostudy/siswa/S_ujian/kirimJwb',
              method: 'POST',
              dataType: 'json',
              contentType: 'application/x-www-form-urlencoded',
              data: {pilGan : pilGan},
              success: function(data){   
                window.location.href = "<?php echo base_url('siswa/S_ujian/hasil_ujian/'); ?>" + data.kode_ujian;
              },
              error: function( errorThrown ){
                console.log(errorThrown)
              }
            });
          
        }else if(minutes < 0 ){
          var pilGan;
            pilGan = getChecklistItems();
            $.ajax({
              url : 'http://localhost/gostudy/siswa/S_ujian/kirimJwb',
              method: 'POST',
              dataType: 'json',
              contentType: 'application/x-www-form-urlencoded',
              data: {pilGan : pilGan},
              success: function(data){   
                window.location.href = "<?php echo base_url('siswa/S_ujian/hasil_ujian/'); ?>" + data.kode_ujian;
              },
              error: function( errorThrown ){
                console.log(errorThrown)
              }
            });
        }else{
          $('.countdown').html(minutes + ':' + seconds);
          timer2 = minutes + ':' + seconds;

        }
      }, 1000);


    },
    error: function( errorThrown ){
      console.log(errorThrown)
    }
  });


}); 


$('#savechecklist').click(function() {
  Swal.fire({
  title: 'Are you sure?',
  text: "Apakah anda yakin sudah mengerjakan semua soal?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Selesai!'
  }).then((result) => {
    if (result.value) {
      var pilGan;
      pilGan = getChecklistItems();
        $.ajax({
          url : 'http://localhost/gostudy/siswa/S_ujian/kirimJwb',
          method: 'POST',
          dataType: 'json',
          contentType: 'application/x-www-form-urlencoded',
          data: {pilGan : pilGan},
          success: function(data){   
            window.location.href = "<?php echo base_url('siswa/S_ujian/hasil_ujian/'); ?>"+ data.kode_ujian;
          },
          error: function( errorThrown ){
            console.log(errorThrown)
          }
        });
      }
    });
});


function getChecklistItems() {
    var result =
        $("input:radio:checked").get();

    var columns = $.map(result, function(element) {
        return $(element).attr("value");
    });

    return columns.join("|");
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
          message: "<?php echo $this->session->flashdata('message') ?>"
  
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









