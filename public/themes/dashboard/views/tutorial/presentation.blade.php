<div class="row well">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{{Form::open(array('url'=>'/tutorial/edit/'.$tutorialid.'/create-presentation','method'=>'POST','id'=>'presentation'))}}

		<h4 style="display:inline-block;">Title</h4> &nbsp;&nbsp;&nbsp;<input class="form-control" type="text" id="title" style="display:inline-block;" name='title'></div>
		<br>
			<div id="slides">
				<div id="slide1">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<h4>Slide 1</h4>
								<textarea class="form-control" id="slide1content" name="slide1">
									
								</textarea>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Position (X)<input name="data-x" id="slide1_data_x" type="number" class="form-control ">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Position (Y)<input name="data-y" id="slide1_data_y" type="number" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Position (Z)<input name="data-z" id="slide1_data_z" type="number" class="form-control">
							</div>
							<div class="clearfix"></div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Angle (X)<input name="data-rotate-x" id="slide1_data_rotate_x" type="number" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Angle (Y)<input name="data-rotate-y" id="slide1_data_rotate_y" type="number" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 col-md-3">
								Angle (Z)<input name="data-rotate-z" id="slide1_data_rotate_z" type="number" class="form-control">
							</div>
							
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<textarea id="presentationc" name="presentationc" hidden></textarea>
			<a id="add" class="btn btn-success">Add Slide</a>
			{{Form::submit('submit',array('class'=>'btn btn-success'))}}
		</form>
		<input type="hidden" id="slidecount" value="1">
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            CKEDITOR.replace( 'slide1content' , {
            });
        };
    $(document).ready(function(){
    	
    	$('#add').click(function(){
    		var slidecount = $('#slidecount').val();
    		slidecount++;
    		var content = '<div class="slide'+slidecount+'"><div class="container"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h4>Slide '+slidecount+'</h4><textarea class="form-control ckeditor" id="slide'+slidecount+'content" name="slide'+slidecount+'"></textarea></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Position (X)<input name="data-x" id="slide'+slidecount+'_data_x" type="number" class="form-control "></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Position (Y)<input name="data-y" id="slide'+slidecount+'_data_y" type="number" class="form-control"></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Position (Z)<input name="data-z" id="slide'+slidecount+'_data_z" type="number" class="form-control"></div><div class="clearfix"></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Angle (X)<input name="data-rotate-x" id="slide'+slidecount+'_data_rotate_x" type="number" class="form-control"></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Angle (Y)<input name="data-rotate-y" id="slide'+slidecount+'_data_rotate_y" type="number" class="form-control"></div><div class="col-xs-12 col-sm-6 col-md-3 col-md-3">Angle (Z)<input name="data-rotate-z" id="slide'+slidecount+'_data_rotate_z" type="number" class="form-control"></div><div class="clearfix"></div></div></div></div>';
    		
    		$("#slidecount").val(slidecount);
    		$(content).appendTo('#slides');
    		CKEDITOR.replace("slide"+slidecount+"content");
    	});
		$('#presentation').submit(function(){			
    		var slidecount = $('#slidecount').val();
    		var title = $('input#title').val();
    		var contentto ='\<\!doctype HTML\>\<html\>\<head\>\<title\>'+title+'\<\/title\>\<\/head\>\<body\>\<div id\=\"impress\">';
    		for(i=1;i<=slidecount;i++){
    			// var slidecontent = $('#slide'+i+'content.editor').val();

				var slidecontent = CKEDITOR.instances['slide'+i+'content'].getData();
    			var datax = $('#slide'+i+'_data_x').val();
    			var datay = $('#slide'+i+'_data_y').val();
    			var dataz = $('#slide'+i+'_data_z').val();
    			var dataxrotate = $('#slide'+i+'_data_rotate_x').val();
    			var datayrotate = $('#slide'+i+'_data_rotate_y').val();
    			var datazrotate = $('#slide'+i+'_data_rotate_z').val();
    			contentto += '\<div class\=\"step slide\" data-x="'+datax+'"  data-y="'+datay+'"  data-z="'+dataz+'" data-rotate-x="'+dataxrotate+'" data-rotate-z="'+datayrotate+'" data-rotate-z="'+datazrotate+'">';
    			contentto += slidecontent;
    			contentto +='\<\/div>'

    		}
    		contentto +='\<\/div\>\<script src=\"\/lib\/impress\/js\/impress.js\"\>\<\/script\>\<script\>impress\(\).init\(\)\;\<\/script\>\<\/body\>\<\/html\>';
    		$('#presentationc').val(contentto);
		});
    });
    </script>
</div>