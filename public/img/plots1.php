<?php

require_once "../../vendor/autoload.php";

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
// Create the Pie Graph.
$graph = new Graph\PieGraph(350, 240);

$graph->SetBox(true);

$data = array((int)$_GET['p1'], (int)$_GET['p4'], (int)$_GET['p3'], (int)$_GET['p2']);
$p1   = new Plot\PiePlot3D($data);
$p1->ShowBorder();
$p1->SetColor('black');

$p1->SetLabels(array("Très bien\n%.1f%%","Absent\n%.1f%%","Pas bien\n%.1f%%","Bien\n%.1f%%"),1);
//$p1->SetLegends(array('G+=2','G++','G--','Absent--'),1);
$p1->SetSliceColors(array('#1E90FF', '#ADFF2F', '#DC143C', '#BA55D3'));


$graph->Add($p1);


$graph->Stroke();

