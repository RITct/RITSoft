<?php
include("includes/header.php");
include("includes/sidenav.php");
?>
<script src="jquery.js"></script>
<script>


  function validate()
  {
   var s1 = document.getElementById('deptname').value;
   if(s1=="--select--"){
     alert("Please select department");
     return false;
   }
   return true;
 } 

</script>
<div id="page-wrapper">   
 <div class="row"><div class="col-lg-12" >
  <h1 class="page-header">Upload Photo</h1>
</div>


<form id="addemp" name="form1" action = "addemp.php" method = "POST" enctype = "multipart/form-data" onsubmit="return validate();">
  <table  id="outer1" align="center" style="padding-top:40px">


    <tr>
     <td>Photo</td>
     <td id="image_par"><input type="file" name="file" id="image" required class=""  accept="image/*" ></td>
     <td id="thumb-output"></td>					
   </tr>

   <tr align="center">
     <td><input style="width:200px" id="submit" class="btn btn-primary" type="submit" value="Upload" name="submit"/></td>

   </tr>
 </table>		
</form>
</body>

<script>
	$(document).ready(function(){
    $(document).on('change','#image', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob){
        $('#thumb-output').html(''); 
          // console.log(this.files[0].size);
          if(this.files[0].size/1024/1024 > 2){
            alert("image size must be less than 2mb"); 
            setTimeout(function() {$('#image_par').html('<input type="file" name="file" id="image" required class=""  accept="image/*" >');}, 1);
            return;

          }


            $('#thumb-output').html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                      return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result)
                        .width('300px')
           				.height('300px'); //create image element 
                        $('#thumb-output').append(img); //append image to output element
                      };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                  }
                });
            
          }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
          }
        });
  });
</script>

<?php 
include("includes/footer.php");
?>

