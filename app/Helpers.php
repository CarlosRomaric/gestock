<?php
use App\Produit;
function getPrice($price)
{
   $price = floatval($price);
   return number_format($price,0,' ',' ').' FCFA';
}

//listing des produits
function getProduits()
{
    return $query = Produit::listeProduits();
}

//liste de produits ayants la quantité en stock inférieur au seuil minimal
function getListeProduitInferieurStock()
{

    return $query = Produit::orderBy('created_at','desc')->where('qteStock','<=','qteMin')->get();
}
//nombre de produits ayants la quantité en stock inférieur au seuil minimal
function nbreProduitsInferieurStock()
{
   $countQteStock= 0;
   foreach (getProduits() as $key => $value) {
       if( $value->qteStock <= $value->qteMin ){
            $countQteStock += 1;
       }
   }
   return $countQteStock;
}