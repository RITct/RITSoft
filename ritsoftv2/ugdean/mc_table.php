<?php
require('fpdf.php');
require('htmlparser.inc.php');  
class PDF_HTML extends FPDF
{
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN=''; 
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

/*function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}*/

        function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
        if($tag=='BLOCKQUOTE')
            $this->SetLeftMargin(20);
            //$this->Ln(5);
        if($tag=='PARA')
            $this->SetLeftMargin(20); 
        if($tag=='TAB')
           $this->SetLeftMargin(28);
        if($tag=='TAB2')
           $this->SetLeftMargin(28);            
                                                                             
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    
    //Page footer
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Page number
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    } 
    
    
    function WriteTable($data, $w)
{
    //$this->SetLineWidth(.1);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0);
    //$this->SetFont('Arial','',8);
    foreach($data as $row)
    {
        $nb=0;
        for($i=0;$i<count($row);$i++)
            $nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
        $h=5*$nb;
        $this->CheckPageBreak($h);
        for($i=0;$i<count($row);$i++)
        {
            $x=$this->GetX();
            $y=$this->GetY();
            $this->Rect($x,$y,$w[$i],$h);
            $this->MultiCell($w[$i],5,trim($row[$i]),0,'L');  
            //Put the position to the right of the cell
            $this->SetXY($x+$w[$i],$y);//                    
        }
        $this->Ln($h);

    }
}

function NbLines($w, $txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 && $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function ReplaceHTML($html)
{
    $html = str_replace( '<li>', "\n<br> - " , $html );
    $html = str_replace( '<LI>', "\n - " , $html );
    $html = str_replace( '</ul>', "\n\n" , $html );
    $html = str_replace( '<strong>', "<b>" , $html );
    $html = str_replace( '</strong>', "</b>" , $html );
    $html = str_replace( '&#160;', "\n" , $html );
    $html = str_replace( '&nbsp;', " " , $html );
    $html = str_replace( '&quot;', "\"" , $html ); 
    $html = str_replace( '&#39;', "'" , $html );
    $html = str_replace( '<br>', "\n<br>" , $html );
    $html = str_replace( '<h1>', "</h1>" , $html );
    $html = str_replace( '<center>', "</center>" , $html );
    
    return $html;
}

function ParseTable($Table)
{
    $_var='';
    $htmlText = $Table;
    $parser = new HtmlParser ($htmlText);
    while ($parser->parse())
    {
        if(strtolower($parser->iNodeName)=='table')
        {
            if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
                $_var .='/::';
            else
                $_var .='::';
        }

        if(strtolower($parser->iNodeName)=='tr')
        {
            if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
                $_var .='!-:'; //opening row
            else
                $_var .=':-!'; //closing row
        }
        if(strtolower($parser->iNodeName)=='td' && $parser->iNodeType == NODE_TYPE_ENDELEMENT)
        {
            $_var .='#,#';
        }
        if ($parser->iNodeName=='Text' && isset($parser->iNodeValue))
        {
            $_var .= $parser->iNodeValue;
        }
    }
    $elems = explode(':-!',str_replace('/','',str_replace('::','',str_replace('!-:','',$_var)))); //opening row
    foreach($elems as $key=>$value)
    {
        if(trim($value)!='')
        {
            $elems2 = explode('#,#',$value);
            array_pop($elems2);
            $data[] = $elems2;
        }
    }
    return $data;
}

function WriteHTML2($html)
{
    $html = $this->ReplaceHTML($html);
    //Search for a table
    $start = strpos(strtolower($html),'<table');
    $end = strpos(strtolower($html),'</table');
    if($start!==false && $end!==false)
    {
        $this->WriteHTML2(substr($html,0,$start).'<BR>');

        $tableVar = substr($html,$start,$end-$start);
        $tableData = $this->ParseTable($tableVar);
        for($i=1;$i<=count($tableData[0]);$i++)
        {
            if($this->CurOrientation=='L')
                $w[] = abs(80/(count($tableData[0])-1))+24;  //80 => 120
            else
                $w[] = abs(80/(count($tableData[0])-1))+5;  //80 => 120
        }
        $this->WriteTable($tableData,$w);

        $this->WriteHTML3(substr($html,$end+8,strlen($html)-1).'<BR>');
    }
    else
    {
        $this->WriteHTML3($html);
    }
}

function PDF($orientation='P', $unit='mm', $format='A4')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
}

function WriteHTML3($html)
{
    //HTML parser
    $html=str_replace("\n",' ',$html);
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}
}
?>