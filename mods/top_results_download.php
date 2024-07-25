<!--
SOME THINGS TO NOTE:
- DO NOT include <html> or <body> tags!!
- All files MUST have a .php extension (e.g., name_of_file.php - some servers running PHP are not configured to include files with other exensions).
- For the program to use any custom module, its information MUST be added into the database.
  -- The Custom Modules option must be enabled via Website Preferences
  -- The EXACT filename and other info (position, rank, description) must be entered into the database via the Add Custom Modules screen
- The corresponding file should be uploaded to the "mods" sub-folder via secure FTP.
- Custom modules can only be placed above content (just below the main navigation) or below content (just above the footer).
- You can have multiple custom modules. They will be displayed in the rank order you choose.

For assistance with Bootstrap elements, reference the Bootstrap website:
- CSS:        http://getbootstrap.com/css/
- Components: http://getbootstrap.com/components/
- JavaScript: http://getbootstrap.com/javascript/

BCOE&M uses Font Awesome v4.7 icons throughout the core code. To use Font Awesome icons, reference the following:
- Font Awesome icon list:     https://fontawesome.com/v4.7/icons
- Font Awesome icon examples: https://fontawesome.com/v4.7/examples/
-->
<?php 

$dirPath = realpath(__DIR__."/../public/");

$allFiles = scandir($dirPath);
$arrResultFiles = array();
$resultsPrefix = "westgate-stout-extravaganza-results-";

foreach ($allFiles as $file) {
  // look for files in form "westgate-stout-extravaganza-results-YYYY.pdf"
  $filePath = $dirPath . '/' . $file;
  if (is_file($filePath) && substr($file, 0, strlen($resultsPrefix)) === $resultsPrefix) {
    // this apparently pushes an item onto a stack?
    // https://www.php.net/manual/en/function.array-push.php
    $arrResultFiles[] = $file;
  }
}

if (count($arrResultFiles)==0) {
  return;
}

sort($arrResultFiles);
$arrResultFiles = array_reverse($arrResultFiles);

function getYear(string $fileStr): string {
  global $resultsPrefix;
  // explode(string $separator, string $string, int $limit = PHP_INT_MAX): array
  $exp1 = explode($resultsPrefix, $fileStr);
  $exp2 = explode(".", $exp1[1]);
  return $exp2[0];
}

function getLink(string $fileStr): string {
  return "public/" . $fileStr;
}

?>
<div class="jumbotron">
  <h2>Results List</h2>
  <p>Click a below to download an available full results list as a PDF.</p>
  <ul>
  <?php foreach ($arrResultFiles as &$resultFile) { ?>
    <li><a href=<?php print(getLink($resultFile)); ?>  > <?php print(getYear($resultFile)); ?> Results</a></li>
  <?php } ?>
  </ul>
</div>
