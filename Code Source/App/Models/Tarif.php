<?php

class Tarif
{
    private $bd;

    public function __construct()
    {
        $this->bd = new Database();
    }

    public function getTarif()
    {
        $this->bd->query('SELECT * From bien');
        $result = $this->bd->getResults();

        return $result;
    }

    public function getTarifbyid($id)
    {
        $this->bd->query("SELECT * From bien where id = '$id'");
        $result = $this->bd->getResults();

        return $result;
    }

    public function update($id, $prix)
    {
        $this->bd->query("UPDATE bien SET prix = '$prix' where id = '$id'");
        $this->bd->execute();
    }

    public function typechambre($typebien, $typechambre = null, $typeVue = null, $typelit = null)
    {
        $this->bd->query("SELECT id, prix From bien where  type = '$typebien' AND (simple IS NULL OR simple = '$typechambre') AND
         ( vue IS NULL OR vue = '$typeVue') AND ( litDouble IS NULL OR litDouble  = '$typelit') ");
        $result = $this->bd->single();

        return $result;
    }

    public function insertReservation($user_id, $bien_id, $startDate, $endDate, $enfant, $pension, $prix_final, $unid)
    {
        $this->bd->query("INSERT INTO reservation(user_id, bien_id, dateArrive, dateSortie, enfants, pension, prix_final,unid) 
         VALUES ('$user_id', '$bien_id','$startDate', '$endDate', '$enfant', '$pension', '$prix_final', '$unid'  ) ");
        $this->bd->execute();
    }
}
