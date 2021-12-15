<?php
//sürekli gerekli header
echo("
<!-- jQuery 2.2.3 -->
<script src='plugins/jQuery/jquery-2.2.3.min.js'></script>
<!-- Bootstrap 3.3.6 -->
<script src='bootstrap/js/bootstrap.min.js'></script>
<!-- AdminLTE App -->
<script src='dist/js/app.min.js'></script>
"); 
if(isset($_GET["sayfa"])){
    if($_GET["sayfa"]=="index"){echo('
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select2").select2({
      tags: true,
      tokenSeparators: [",", " "]
    })
  });
</script>
            ');
    }elseif($sayfa=="kesfet"){echo('
            <!-- Select2 -->
            <script src="plugins/select2/select2.full.min.js"></script>
            <!-- InputMask -->
            <script src="plugins/input-mask/jquery.inputmask.js"></script>
            <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
            <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
            <!-- SlimScroll 1.3.0 -->
            <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <!-- iCheck 1.0.1 -->
            <script src="plugins/iCheck/icheck.min.js"></script>
            <!-- FastClick -->
            <script src="plugins/fastclick/fastclick.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="dist/js/demo.js"></script>
            <!-- Page script -->
            <script>
              $(function () {
                //Initialize Select2 Elements
                $(".select2").select2();
                $(".select2").select2({
                  tags: true,
                  tokenSeparators: [",", " "]
                })
              });
            </script>
    ');
    }elseif($sayfa=="mesajlar"){echo('
    
    ');
    }elseif($sayfa=="profil"){echo('
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select2").select2({
      tags: true,
      tokenSeparators: [",", " "]
    })
  });
</script>');
    }elseif($sayfa=="ayarlar"){echo('');
    }elseif($sayfa=="adminuye" && yetkilimi($baglanti, $kullID)){echo('
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
    ');
    }elseif($sayfa=="adminpost"){echo('
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $(".select2").select2({
      tags: true,
      tokenSeparators: [",", " "]
    })
  });
</script>
    ');
    }elseif($sayfa=="adminanket"){echo('
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
    ');
    }else{echo('');}
}else{echo('');}
?>