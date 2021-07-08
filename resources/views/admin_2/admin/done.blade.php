
@extends('admin_2.layouts.default_2')
@section('content')
@if(!empty($file_name))
<h3>Uploaded ...</h3>	
<ul id="files">
    <li>
        <div class="file">
            <div id="fname" class="file-title">   
                {{ $file_name }}
            </div>           
        </div>
    </li>    
</ul> 

<button onclick="myFunction()">Copy File Name</button>
<button onclick="myFunction2()">Close Window</button>

<script>
function myFunction() {
   
	var emailLink = document.querySelector('#fname');  
	var range = document.createRange();  
	range.selectNode(emailLink);  
	window.getSelection().addRange(range);

	try {  
    // Now that we've selected the anchor text, execute the copy command  
		var successful = document.execCommand('copy');  
		var msg = successful ? 'successful' : 'unsuccessful';  
    console.log('Copy email command was ' + msg);  
	} catch(err) {  
		console.log('Oops, unable to copy');  
	}

	// Remove the selections - NOTE: Should use
	// removeRange(range) when it is supported  
	window.getSelection().removeAllRanges();  
  
  /*
	//document.querySelector('#fname').select();
	document.execCommand('copy');
	 
	var fn = document.getElementById("fname").innerHTML ;
	alert ( fn );
	*/
}
function myFunction2() {
	window.close();
}
</script>
@else
No results for your query: {{ $query }}
   
@endif
@stop