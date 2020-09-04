<?php
include("includes/header.php");
    include("includes/sidenav.php");
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="jquery.js"></script>
<div id="page-wrapper">   
                <div class="row"><div class="col-lg-12" >
                    <h1 class="page-header">EDIT FACULTY DETAILS</h1>
             </div>

	
	<form id="editstaff" name="form1" method="post" action="editstaff1.php" enctype="multipart/form-data">
	<table  id="outer1" align="center" style="padding-top:40px">
    
<?php
	$staffid=$_GET['staffid'];
	$_SESSION['fidd']=$staffid;    
	
	$sql ="select s.fid,s.name,s.email,s.phoneno,s.deptname,s.photo from faculty_details s where fid='$staffid'";
    $result = mysql_query($sql,$con);
	if (mysql_num_rows($result) == 1) {
		while($row = mysql_fetch_assoc($result)) {
?>
               
	<tr>
		<td>Faculty_ID:<span class="required">*</span></td>
   		<td><input required="required" class="form-control" id="Text1" type="text" value="<?php echo $row['fid'];?>" name="fid" style="width: 400px" /></td>
	</tr>
    <tr>
		<td>Name:<span class="required">*</span></td>
		<td><input required="required" class="form-control" id="Text1" type="text" value="<?php echo $row['name'];?>" name="name" style="width: 400px" pattern="[a-zA-Z\s]+"/></td>
	</tr>
    <tr>
   		<td>Department:<span class="required">*</span></td>
        <td><input required="required" class="form-control" id="Text1" type="text" value="<?php echo $row['deptname'];?>" name="deptname" style="width:400px" /></td>
	</tr>
	<tr>
    	<td>Email:<span class="required">*</span></td>
        <td><input required="required" class="form-control" id="Text1" type="email" value="<?php echo $row['email'];?>"  name="email" style="width:400px" /></td>
    </tr>
	<tr>
		<td>Phone No:<span class="required">*</span></td>
		<td><input  required="required" class="form-control" maxlength="10" minlength="10" id="Text1" type="number" value="<?php echo $row['phoneno'];?>" name="phoneno" style="width: 400px;" /></td>
	</tr>
    <tr>
		<td>Photo:</td>
		<td><input id="image" type="file" name="file"></td>
       
		<td id="thumb-output">
            
		<?php 
        if ($row['photo']) {
            
        
			echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"  width="100" height="100"/>';
		}
        ?>
		</td>			
	</tr>
	
	<tr style="padding-top:800px">
    	<td align="center"><input style="width:200px" class="btn btn-primary" id="submit" type="submit" value="SAVE CHANGES" name="submit"/></td>     
    </tr>
 </table>
 
 </form>
<?php include("includes/footer.php");?>

   <script>
	$(document).ready(function(){
    $('#image').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            $('#thumb-output').html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result)
						.width('100px')
           				.height('100px'); //create image element 
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
 }}?>
