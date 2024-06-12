<?php 
include 'header.php';
?>
<script src="http://localhost/suryajaya/assets/js/jquery-3.4.1.min.js"></script>
<script>
  $(document).ready(function(){
    $("#carijpenj").click(function(){   
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      $.ajax({
        type:"POST",
        url:"jpenj.php",
        data: "&bulan="+ bulan +"&tahun="+ tahun,
        success: function(data)
        {
          $(".hasiljpenj").html(data);
        }
      });

    });
  });
</script>
<div class="container-fluid">
    <h1>Jurnal Penjualan</h1>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select class="form-control" id="bulan">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select class="form-control" id="tahun">
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    </select>
                </div>
                <button class="btn btn-primary my-2" name="carijpenj" id="carijpenj">Cari</button>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="hasiljpenj">
        
        </div>
    </section>
    
</div>
<?php
include 'footer.php';
?>