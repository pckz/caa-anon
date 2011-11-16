$(document).ready(function(){
	/* The following code is executed once the DOM is loaded */
	
	/* This flag will prevent multiple comment submits: */
	var working = false;
	
	/* Listening for the submit event of the form: */
	$('#addCommentForm').submit(function(e){

 		e.preventDefault();
		if(working) return false;
		
		working = true;
		$('#submit').val('Enviando..');
		$('span.error').remove();
		
		/* Sending the form fileds to submit.php: */
		$.post('submit.php',$(this).serialize(),function(msg){

			working = false;
			$('#submit').val('Opinar');
			
			if(msg.status){

				/* 
				/	If the insert was successful, add the comment
				/	below the last one on the page with a slideDown effect
				/*/

				$(msg.html).hide().insertBefore('#comment').slideDown();
				$('#body').val('');
			}
			else {

				/*
				/	If there were errors, loop through the
				/	msg.errors object and display them on the page 
				/*/
				
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},'json');

	});
	
});