<?php

class Calcul
{
    public static function Pourcent($valeur1, $valeur2): string
    {
        $retour = $valeur1 . " (";
        if (!empty($valeur1)):
            $retour .= round((($valeur1 / $valeur2) * 100), 2) . " %)";
        else:
            $retour .= "0 %)";
        endif;
        return $retour;
    }

    public static function laDate(int $days):string{

        $date = time() - ($days*60*60*24);
        return date("Y-m-d H:i:s",$date);
    }

    public static function calculPoints(array $ori):array{
        $new =$ori;
        $i=0;
        foreach($new as $key => $valeur){

            $new[$key]['points'] = ($valeur['vgood']*2)+($valeur['good'])-($valeur['nogood'])-($valeur['absent']);
            $i++;
        }
        return $new;
    }
}