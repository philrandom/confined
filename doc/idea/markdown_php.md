# md to PHP

read line by line php
use of regex 

```regex
/(# ).+		detect title
/(```).+		detect begin code block
/(```)+		end code block
/( _)/g		itallic
/(_ )/g		end intallic
```

ignore text in code block.

```PHP
$handle = fopen("inputfile.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        
        //asymetric balise
        if( preg_match("/(# ).+/", $str)	
        {
        	$str =~ s/(# )/<h1>;/g; 
        	$str = $str . "</h1>";
        }
    }

    fclose($handle);
} else {
    // error opening the file.
} 

//classic balise
$str =~ s/( _)/<i>;/g;
$str =~ s/(_ )/</i>;/g;
```
