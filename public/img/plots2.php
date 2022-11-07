<?php

require_once "../../vendor/autoload.php";

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;
// Create the Pie Graph.
$graph = new Graph\Graph(1200, 400,'auto');
$graph->SetScale("textlin");


$nb = count($_GET)/2;
for ($i=1;$i<=$nb;$i++){
    $label[]=substr($_GET["n$i"],0,8);
    $datay[]=$_GET["p$i"];
}

$graph->SetBox(false);

$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($label);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);


// Create the bar plots
$b1plot = new Plot\BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);

$b1plot->SetColor("white","blue");
$b1plot->SetWidth(30);
$graph->title->Set("Top de la classe");

// Display the graph
$graph->Stroke();
