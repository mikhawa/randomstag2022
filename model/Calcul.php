<?php

class Calcul
{
    public static function Pourcent($valeur1,$valeur2): string
    {
        $retour = $valeur1." (";
        if(!empty($valeur1)):
            $retour .= (($valeur1/$valeur2)*100)." %)";
        else:
            $retour .= "0 %)";
        endif;
        return $retour;
    }
}