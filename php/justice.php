
 
<?php
//Header.  Load data and get variables
$attr=array('description'=>'Description','keyword'=>'Tags','modified'=>'Last Update',
    'publisher'=>'Publisher','contactPoint'=>'Contact Name','mbox'=>'Contact Email',
    'accessLevel'=>'Public Access Level','identifier'=>'Unique Identifier',
    'accessLevelComment'=>'Access Level Comment','bureauCode'=>'Bureau Code','programCode'=>'Program Code',
    'accessURL'=>'Download URL','webService'=>'Endpoint','format'=>'Format',
    'license'=>'License', 'spatial'=>'Spatial', 'temporal'=>'Temporal','theme'=>'Category',
    'dataDictionary'=>'Data Dictionary URL', 'dataQuality'=>'Data Quality','distribution'=>'Distribution',
    'accrualPeriodicity'=>'Frequency', 'landingPage'=>'Homepage URL', 'language'=>'Language',
    'PrimaryITInvestmentUII'=>'Primary IT Investment UII', 'references'=>'Related Documents',
    'issued'=>'Release Date', 'systemOfRecords'=>'System of Records');
 
$fileContent=file_get_contents('../data.json');
$filejson=json_decode($fileContent,true);
$showPage=1;
$lengthPage=20;
$lastRecord=20;
$value='';
$k=0;
$pagtor=array();
$i=0;
foreach($filejson as $json=>$jvalue){
    if($jvalue['title'] != '') $pagtor[$i]=$jvalue['title'];
    $i+=1;
}
 
natcasesort($pagtor);
if(isset($_GET['page'])){
    $showPage=$_GET['page'];
}
 
$sortedPage=array();
$i=0;
foreach($pagtor as $pos=>$title){
    $sortedPage[$i]=$pos;
    $i+=1;
}
$totalPages=intval(count($pagtor)/$lengthPage);
$totalPages+=(count($pagtor)%$lengthPage==0)?0:1;
 
if($showPage>$totalPages){
    error_log('/data/inventory.php - No current page available.');
    header('HTTP/1.1 500 Internal Server Error');
    exit(0);
}
?>
 
 
 
 
<div>
<?php
//Body.  Display data and pagination
$lastRecord=($showPage*$lengthPage<count($pagtor))?($showPage*$lengthPage):count($pagtor);
echo "<div class=\"pagenav lineunder\" id=\"navtop\">" . "<div  class=\"infonav\">";
echo ($showPage-1)*$lengthPage+1 . " - " . $lastRecord . " of " . count($pagtor) . " projects</div>";
echo paginatorIndex($showPage,$totalPages);
echo "</div>";
 
echo '<div style="clear:both;"></div>';
echo '<div class="elements">';
for($i=($showPage-1)*$lengthPage;$i<($showPage*$lengthPage);++$i){
    $j=0;
    if($filejson[$sortedPage[$i]]['title'] != ''){
        foreach($filejson[$sortedPage[$i]] as $jsonelement=>$jsonelementvalue){
            if($jsonelementvalue == ''){
                $value='no data';
            }
            else{
                if($jsonelement == 'title'){
                    echo '<div class="element" id="e' . $k . '"><span class="jtitle">' . $jsonelementvalue .'</span>';
                    echo '<ul>';
                }elseif($jsonelement == 'accessURL'){
                    $value=$jsonelementvalue;
                    echo '<li><span class="attribute">' . $attr[$jsonelement] . ':</span>';
                    if(preg_match('[.gov|.mil|.fed.us]',$value) === 1){
                        echo '<span class="value"><a href="' . $value . '">' . $value . '</a></span></li>';
                    }else{
                        echo '<span class="value"><a href="javascript:exitWinOpen(\'' . $value .'\');">' . $value . '</a></span></li>';
                    }
                
                }else{
                    $value=$jsonelementvalue;
                    echo '<li><span class="attribute">' . $attr[$jsonelement] . ':</span>';
                    echo '<span class="value">' . $value . '</span></li>';
                }
            }
            $j+=1;
        }
        echo '</ul></div>';
        $k+=1;
    }
}
echo '</div>';

//Pagination function
function paginatorIndex($cur,$total){
$ret="<div  style='text-align: right; width: 65%; float: right;'>";
if($cur>1){
    $ret.="<a href=\"?\"><<< First </a>";
    $ret.="<a href=\"?page=" . ($cur-1) . "\"><< Previous | </a>";
}else{
    $ret.="<<< First << Previous | ";
}
 
$begin=($cur>5)?$cur-5:0;
$end=($begin+10>$total)?$total:$begin+10;
for($i=$begin;$i<$end;++$i){
    if($i+1 == $cur){
        $ret .= "<strong>" . ($i+1) . " </strong>";
    }else{
        $ret .= "<a href=\"?page=" . ($i+1) . "\">" . ($i+1) . "</a>&nbsp;";
    }
 
}
if($cur<$total){
    $ret.="<a href=\"?page=" . ($cur+1) . "\">" . " | Next >> </a>";
    $ret.="<a href=\"?page=" . $total ."\">Last >>></a>";
}else{
    $ret.=" | Next >> Last >>>";
}
 
$ret .= "</div>";
return $ret;
}
?>
</div>
<?php
echo "<div class=\"pagenav lineabove\" id=\"navbottom\">";
echo paginatorIndex($showPage,$totalPages);
echo "</div>";
?>
 


