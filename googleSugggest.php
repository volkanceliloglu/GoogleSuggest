<meta charset="UTF-8">
<?php 

function GoogleSuggest($q)
{
    $q = empty($q) ? "???":$q;
    $q = explode(" ", $q);
    $q = implode("+", $q);
    $str = file_get_contents("https://clients1.google.com/complete/search?hl=tr&output=toolbar&q=$q");
    $temp = mb_convert_encoding( $str, "UTF-8", "ISO-8859-9");
    $feed = simplexml_load_string($temp);
    $result = '';
    foreach ($feed->CompleteSuggestion as $key => $value) {
        $datavol = $value->suggestion->attributes()->{'data'};
        $result.=$datavol.',';
    }
    
    return explode(',',rtrim($result,','));
}
$query = $_GET['q'];
print_r(GoogleSuggest($query));
?>
