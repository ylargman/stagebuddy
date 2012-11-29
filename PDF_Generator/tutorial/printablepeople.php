<?php
require('../fpdf.php');

class PDF extends FPDF
{
// Header
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(1);
    // Title
    $this->SetTextColor(190, 0, 0);
    $this->SetFont('Arial', '', 20);
    require('/afs/ir.stanford.edu/users/s/k/skyguy/cgi-bin/stagebuddy_temp/config.php');
	$playID = $_GET['playID'];
			
	$query_i="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	$result_i=mysql_query($query_i);
	$numrows_i=mysql_numrows($result_i);
			
	$name=mysql_result($result_i, '0', "name");
	$title = $name;
	$title .= " - Cast and Crew Information";
    $this->Cell(30,10,$title, 0, 0, 'L');
    // Line break
    $this->Ln(20);
}	

// Load data
function LoadData($file)
{
	// Read file lines
//	$lines = file($file);
//	$data = array();
//	foreach($lines as $line)
//		$data[] = explode(';',trim($line));
//	return $data;
	
	$data = array();
		require('/afs/ir.stanford.edu/users/s/k/skyguy/cgi-bin/stagebuddy_temp/config.php');
		
			$playID = $_GET['playID'];
		
			$query_p="SELECT * FROM PeopleInfo";
			$result_p=mysql_query($query_p);
			$numrows_p=mysql_numrows($result_p);
			
			$i=0;
			while($i < $numrows_p){
				
				$personID=mysql_result($result_p, $i, "personID");
				$name=mysql_result($result_p, $i, "name");
				$email=mysql_result($result_p, $i, "email");
				$phone=mysql_result($result_p, $i, "phone");
				$position=NULL;
				$chars=" - ";
				$numchars = 0;
				
				$query_q="SELECT * FROM PeoplePositions WHERE personID LIKE '{$personID}'";
				$result_q=mysql_query($query_q);
				$numrows_q=mysql_numrows($result_q);
				
				$j=0;
				while($j < $numrows_q){
					$p_playID=mysql_result($result_q, $j, "playID");
					
					if(strcmp($p_playID, $playID) == 0){
						$position=mysql_result($result_q, $j, "position");
						if(strcasecmp($position, "actor") == 0){
							$ncharID=mysql_result($result_q, $j, "characterID");
							
							$query_r="SELECT * FROM CharactersInfo WHERE characterID LIKE '{$ncharID}'";
							$result_r=mysql_query($query_r);
							
							$nchar=mysql_result($result_r, '0', "name");
							
							if($numchars > 0){
								$chars .= ", ";
							}						
							$chars .= $nchar;
							$numchars++;
						}
						
					}
					$j++;
				}
				if($position != NULL){	
					$datastring = "";
					$datastring .= $name;
					$datastring .= ";";
					$datastring .= $position;
					if($numchars > 0){
						$datastring .= $chars;
					}
					$datastring .= ";";
					$datastring .= $email;
					$datastring .= ";";
					$datastring .= $phone;
					
					$data[]= explode(';', trim($datastring));
				}
				$i++;
			}
			return $data;
	
}

// Simple table
function BasicTable($header, $data)
{
	// Header
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

// Better table
function ImprovedTable($header, $data)
{
	// Column widths
	$w = array(40, 35, 40, 45);
	// Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,$row[2],'LR');
		$this->Cell($w[3],6,$row[3],'LR');
		$this->Ln();
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(190,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(190,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(55, 80, 70, 45);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
		$this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Column headings
$header = array('Name', 'Position', 'Email', 'Phone');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage('L', 'Letter');
$pdf->FancyTable($header,$data);
$pdf->Output();
?>