
<div class="content">
  <div class="container-fluid">

<div class="row">
  
</div>
<div class="row">
  <div class="col-md-12">
  <div class="card">
      
      <div class="card-body table-responsive">
        <h1 style="text-align : center; font-size: 130px; margin-top: 10px; margin-bottom: 10px"><?php echo $nilai; ?></h1>

        <div class="row">
        <div class="col-sm-5"></div>
            <div class="col-sm-2">
            <table class="table table-hover">
            <tr>
                <td>Jumlah Soal</td>
                <td><?php echo $jumlah_soal ?></td>
            </tr>
            <tr>
                <td>Jawaban Benar</td>
                <td><?php echo $soal_benar ?></td>
            </tr>
            <tr>
                <td>Jawaban Salah</td>
                <td><?php echo $soal_salah ?></td>
            </tr>
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

      <?php $this->load->view('guru/footer'); ?>


<script>
  $(document).ready(function(){
     // -------------NAVBAR ---------
  $('.nav li a[href~="http://localhost/gostudy/siswa/S_ujian"]').parents('li').addClass("active");    
  $('.nav li a').click(function(){
        $('.nav li').removeClass("active");
        $('.nav li a[href~="' + location.href + '"]').parents('li').addClass("active");    
    });
    //------------- END -----------
  })
</script>









