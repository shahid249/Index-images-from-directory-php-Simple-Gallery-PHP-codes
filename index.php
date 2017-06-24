<?php
/**
 * @author SHAHID
 */
//function for finding images in directory and prepare for indexing
function DirectoryImages($directory, array $exts = array(
    'jpeg',
    'jpg',
    'gif',
    'png'))
{
    if (substr($directory, -1) == '/')
    {$directory = substr($directory, 0, -1);}
    $html = '';
    if (is_readable($directory) && (file_exists($directory) || is_dir($directory)))
    {$directorylist = opendir($directory);while ($file = readdir($directorylist))
    {if ($file != '.' && $file != '..')
    {$path = $directory . '/' . $file;if (is_readable($path))
    {if (is_dir($path))
    {return scanDirectoryImages($path, $exts);}
    if (is_file($path) && in_array(end(explode('.', end(explode('/', $path)))), $exts))
    {$html .= '<a href="' . $path . '"><img src="' . $path .'" style="max-height:300px;max-width:300px" /> </a>';}
     }}}closedir($directorylist);}
    return $html;
}

//put your directory location by replacing 'images'
$images = DirectoryImages("images");
//call by echo
/** echo $images; */

?>

<!doctype html>
<head>
	<meta charset="UTF-8">
	<title>My Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .home { 
        height: 100%;
        background: #444;
        }
    .logo {
        text-align: center;
        color: white;
    }
    .galleryview {
        max-width: 91%;
        margin: auto;
    }
    .footer {
        height: 70px;
        padding-top: 0px;
        background-color: rgba(51, 51, 51, 0.26);
        border-radius: 50px;
        width: 22em;
        margin: 0 auto;
    }
    .copyright {
        text-align: center;
        margin: 26px;
        padding: 7px;
        color: white;

    }
    </style>
</head>
<body class="home">
<header>
<div class="logo">
<h1>MY GALLERY</h1>
</div>
</header>
<div class="galleryview">
<?php echo $images; ?>
</div>
<footer class="footer">
<div class="copyright">
<p>Copyright <?php echo date('Y') ?> <a>My Gallery</a></p>
</div>
</footer>
</body>
</html>