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

    // créer les points par rapport aux logs et remettre le tableau dans l'ordre des points!
    public static function calculPoints(array $ori):array{
        $new =$ori;
        $i=0;
        foreach($new as $key => $valeur){

            $new[$key]['points'] = ($valeur['vgood']*2)+($valeur['good'])-($valeur['nogood'])-($valeur['absent']);
            $i++;
        }

        // sélection de la colonne pour le tri
        $points  = array_column($new, 'points');
        // tri de la colonne
        array_multisort($points,SORT_DESC, $new);

        return $new;
    }

    // créer les % de sorties par rapport aux logs et remettre le tableau dans l'ordre des sorties!
    public static function calculSorties(array $ori):array{
        $new =$ori;

        // sélection de la colonne pour le tri
        $sorties  = array_column($new, 'sorties');
        // tri de la colonne
        array_multisort($sorties,SORT_DESC, $new);

        return $new;
    }
}