<?php
$line = '';

$f = fopen('/etc/osid/system/progress.info', 'r');
$cursor = -1;

fseek($f, $cursor, SEEK_END);
$char = fgetc($f);

/**
 * Trim trailing newline chars of the file
 */
while ($char === "\n" || $char === "\r") {
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}

/**
 * Read until the start of file or first newline char
 */
while ($char !== false && $char !== "\n" && $char !== "\r") {
    /**
     * Prepend the new char
     */
    $line = $char . $line;
    fseek($f, $cursor--, SEEK_END);
    $char = fgetc($f);
}

//explode returned line into array
$LineArray = explode(" ", $line);

//create percentage integer
$PercentCompleted = str_replace("[", "", $LineArray[0]);
$PercentCompleted = str_replace("%", "", $PercentCompleted);

//create total file size
$TotalFileSize = str_replace("Mb]", "", $LineArray[2]);

//create file size written
$FileSizeWritten = str_replace("(", "", $LineArray[5]);
$FileSizeWritten = str_replace("Mb)", "", $FileSizeWritten);

//create time remaining
$TimeRemaining = $LineArray[7];

//output delimited string
echo $PercentCompleted . "|" . $TotalFileSize . "|" . $FileSizeWritten . "|" . $TimeRemaining;
?>