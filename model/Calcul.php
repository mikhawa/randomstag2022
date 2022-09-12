<?php

class Calcul
{
    public static function Pourcent($valeur1,$valeur2): string
    {
        $retour = $valeur1." (";
        if(!empty($valeur1)):
            $retour .= round((($valeur1/$valeur2)*100),2)." %)";
        else:
            $retour .= "0 %)";
        endif;
        return $retour;
    }
}