<?php
require('file_dispatcher/main.php');

//CLEAN-----------
echo getcwd();
$z = new dispatcher("../data","java/memory/file/",'c',1);
echo $z->get_h_code();


//$z = new dispatcher("../data","java/memory/file/",'u',1);
$z->new_version();
$z->save_in_file("
<h1>Fichier</h1>
<hr />
<h2>introduction</h2>
<p>Types de fichier ou flux : <code>binaires</code> et <code>texte</code>.</p>
<p>traitement de flux : ouverture -&gt; action -&gt; fermer.</p>
<h2>chemin d'accès</h2>
<p><code>file.Separator</code>.</p>
<p><code>System.getProperty()</code> donne des info sur la localisation de default </p>
<pre><code class=\"Java\">File f = new File(System.getProperty(&quot;user.dir&quot;));
    //user.dir : donne la localisation 

File f2 = new File(&quot;save/1.save&quot;);
File f3 = new File(f,f2);   //concatenation du chemin
</code></pre>

<table>
<thead>
<tr>
<th>fonction</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td>Exists</td>
<td></td>
</tr>
<tr>
<td>isFile</td>
<td></td>
</tr>
<tr>
<td>isDirectory</td>
<td></td>
</tr>
<tr>
<td>canRead</td>
<td></td>
</tr>
<tr>
<td>...</td>
<td></td>
</tr>
<tr>
<td>getParent</td>
<td>dossier au dessus</td>
</tr>
<tr>
<td>getAbsolutePath</td>
<td></td>
</tr>
<tr>
<td>lastModified</td>
<td>TimeMachine</td>
</tr>
<tr>
<td>mkdir</td>
<td></td>
</tr>
<tr>
<td>mkdirs</td>
<td>creer plusieurs dossier en meme temps</td>
</tr>
<tr>
<td>listFile</td>
<td>ls</td>
</tr>
</tbody>
</table>
<p><a href=\"https://docs.oracle.com/javase/7/docs/api/java/io/File.html\">MAN File JAVA</a></p>
<pre><code class=\"Java\">File f = new File(System.getProperty(&quot;user.dir&quot;));
    //user.dir : donne la localisation 

File [] list = f.listFiles();
for(File f : list)  //for each  
//equiv en python for(i in range())  
{
    if(f.isFile()) syso(&quot; fichier: &quot;+ f.getName());
    else syso(&quot;Dossier : &quot; + f.getName())
}
</code></pre>

<p><code>System.getProperty(\"line.separator\")</code> retour à la ligne pour tout os ( <code>\n</code> sous linux et <code>\r\n</code> windows )</p>
<h2>Buffer</h2>
<blockquote>
<p>flux ne lit qu'un seule caractère. buffer charge tout le flux dispo dans en string</p>
</blockquote>
<table>
<thead>
<tr>
<th>func</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td>br.read()</td>
<td></td>
</tr>
<tr>
<td>br.readLine()</td>
<td></td>
</tr>
<tr>
<td>br.skip</td>
<td></td>
</tr>
<tr>
<td>br.close</td>
<td></td>
</tr>
</tbody>
</table>
");


echo $z->read_from_file();
//END CLEAN------







/*
//CLEAN-----------
echo '<br>creation [';
$z = new dispatcher("../data","java/memory/file/",'c',1);
echo 'OK]';
echo $z->get_h_code();
echo '<br>update[';
$z = new dispatcher("../data","java/memory/file",'u',1);
echo 'OK]';
$z->set_version(0);
$z->save_in_file("# INIT");

//END CLEAN------
*/


//$z = new dispatcher("fc1154a11d6d9eaa2706f044e99f80a8",'r');
//echo "[main_test]";
//$z = new dispatcher("C/network/socket/",'r');
//print_r("is_hash=" . $z->is_hash("098f6bcd4621d373cade4e832627b4f6") . ".<br>");
//echo "[creation]";
/*echo getcwd();
$z = new dispatcher("../data","C/memory/memory23/",'c',1);
echo $z->get_h_code();
//$z = new dispatcher("C/memory/pointers/",'u');
//$z->save_in_file("v4");
//echo $z->read_from_file();

$z = new dispatcher("../data","C/memory/memory23/",'u',1);
$z->save_in_file("# INIT");
$z->set_version(3);
$z->save_in_file("# Memory8 v3");
$z->new_version();
$z->save_in_file("# Memory8 vNEW");
echo $z->read_from_file();
$z->rm();
/*$z->new_version();
$z->save_in_file("v2");
echo $z->read_from_file();*/
//print_r($z->getError());
 ?>
