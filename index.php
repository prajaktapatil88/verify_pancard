<html>
<head>
	<title>Pan Number Verification</title>
	<link rel='stylesheet' id='normalize-css'  href='bootstrap/css/bootstrap.min.css' />
	<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>	
	<script type='text/javascript' src='bootstrap/js/bootstrap.min.js'></script>
	<style type="text/css">
	.show{ display: block;}
	.hide{display: none;}
	</style>	
</head>

<body>
<main class=""class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role = "main">
	<div class="bd-example">

		<h1>Pan Card Verification App</h1>
		<div class="alert alert-warning hide" role="alert">
		</div>
		<form action="" method="post" id="search-pan" name="search-pan">
	  		<div class="form-group">
	    		<label for="pan_number">Enter Your Pancard Number: </label>
	    		<input type="text" class="form-control" name = "pan_number" id="pan_number" placeholder="Enter Pan Number">
	  		</div>
	  		<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<button type="button" class="btn btn-success hide" id = "valid">Valid</button>
		<button type="button" class="btn btn-danger hide" id = "invalid">Invalid</button>
	</div>
</main>
<script type="text/javascript">
		$(document).ready(function($){
                                    /*  This function validates for PAN Card No.*/
		function pan_card(textObj) 
		{
			var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
			/*C - Company 
			P - Person 
			H - HUF(Hindu Undivided Family) 
			F - Firm 
			A - Association of Persons (AOP) 
			T - AOP (Trust) 
			B - Body of Individuals (BOI) 
			L - Local Authority 
			J - Artificial Juridical Person 
			G - Govt.*/
			var code= /([C,P,H,F,A,T,B,L,J,G])/;
			var code_chk=textObj.substring(3,4);
			if (textObj!=="")
			{
				if(regpan.test(textObj) == false)
				{
					return false; 
				}
				if (code.test(code_chk)==false)
				{
					return false;
				}
				return true;
			}
		}
        $('#search-pan').on('submit', function (e) {
          e.preventDefault();
            if($.trim($('#pan_number').val())==''){
                $('.alert').removeClass('hide');
                $('.alert').html("Please Enter Pancard Number!");
                $('#pan_number').focus();
                return false;
            }else{
            	if( pan_card($.trim($('#pan_number').val())) == false ){
            		$('.alert').removeClass('hide');
	                $('.alert').html("Invalid Pan Number.");
	                $('#pan_number').focus();
	                return false;
            	}
            }
            $.ajax({
                url:"pan_verify.php",
                data:$('#search-pan').serialize(),
                type:"post",
                success:function(data){
                	if(data.toLowerCase().indexOf("invalid") >= 0){                		
                		$('#invalid').removeClass('hide');
                		$('#valid').addClass('hide');
                	}else{
                		$('#valid').removeClass('hide');
                		$('#invalid').addClass('hide');
                	}
                }
            })
        return false;
        })
    })
	</script>
</body>
</html>

