<style type="text/css">
  .modal{

        z-index: 2000000;
    background: rgba(0, 0, 0, 0.5);

  }
</style>

<div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
    
     
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Caro <?php echo $_SESSION['name']; ?>,</h4>
        </div>
        <div class="modal-body">
          <?php echo $pop['msg']; ?>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
    $(window).on('load',function(){
        $('#myModals').modal('show');
    });
</script> 
