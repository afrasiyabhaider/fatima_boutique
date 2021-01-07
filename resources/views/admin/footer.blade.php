
		
	
	<div class="row-fluid">
  <div id="footer" class="span12"> Copyright &copy; <?php echo date('Y');?>  </div>
</div>
     
     

{!!Html::script('local/resources/views/admin/theme/js/excanvas.min.js')!!}     

{!!Html::script('local/resources/views/admin/theme/js/fullcalendar.min.js')!!}      
{!!Html::script('local/resources/views/admin/theme/js/avigher.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/avigher.dashboard.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/jquery.gritter.min.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/avigher.interface.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/avigher.chat.js')!!}

{!!Html::script('local/resources/views/admin/theme/js/jquery.ui.custom.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/jquery.flot.min.js')!!}      
{!!Html::script('local/resources/views/admin/theme/js/jquery.flot.resize.min.js')!!}      
{!!Html::script('local/resources/views/admin/theme/js/jquery.peity.min.js')!!}      
{!!Html::script('local/resources/views/admin/theme/js/jquery.validate.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/avigher.form_validation.js')!!}
{!!Html::script('local/resources/views/admin/theme/js/select2.min.js')!!} 


{!!Html::script('local/resources/views/admin/theme/js/jquery.wizard.js')!!}      
{!!Html::script('local/resources/views/admin/theme/js/jquery.uniform.js')!!}      
     
{!!Html::script('local/resources/views/admin/theme/js/avigher.popover.js')!!}  
{!!Html::script('local/resources/views/admin/theme/js/jquery.dataTables.min.js')!!}   
     
 {!!Html::script('local/resources/views/admin/theme/js/bootstrap.min.js')!!}
 
 
   
    
<script type="text/javascript">


  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}


function showDiv(elem){
	
	  
   if(elem.value == "image")
   {
      document.getElementById('mediaurl').style.display = "none";
	  document.getElementById('mediaimg').style.display = "block";
	   document.getElementById('mediamp3').style.display = "none";
   }
   if(elem.value == "video")
   {
      document.getElementById('mediaurl').style.display = "block";
	  document.getElementById('mediaimg').style.display = "none";
	   document.getElementById('mediamp3').style.display = "none";
   }
   if(elem.value == "mp3")
   {
      document.getElementById('mediaurl').style.display = "none";
	  document.getElementById('mediaimg').style.display = "none";
	   document.getElementById('mediamp3').style.display = "block";
   }
   
   
}



$(document).ready( function() {
    $('#datatable-responsive').dataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
})

</script>

    

     
     
     
     
     
     
     