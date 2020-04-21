<html>
	<body>
		<h1>USE this script if your post_max_size is 8M</h1>
		<input type='text' id='textbox_id'> </input>
		<button onclick="myFunction()">Click me</button> 
		<p id="demo">..</p>
	</body>

	<script>
	function myFunction(){
		var str = "text="+document.getElementById('textbox_id').value;
		alert(str);
		
	 	var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("demo").innerHTML = this.responseText;
			}
		  };
		 
			/*xhttp.open("POST", "upload.php", true);
			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhttp.send(str); */
			for (var i = 0; i < 9; i++) {
			xhttp.open("POST", "upload.php", true);
			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhttp.send('text=c'+i);
			}
		
	}
	</script>
	
	

</html>


