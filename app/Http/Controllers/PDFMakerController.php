<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sortie;
use App\BonSortie;
use App\Technicien;
use App\User;
use App\Famille;
use App\Fournisseur;
use App\Produit;
use App\Retour;
use App\RetourStock;
use App;
use PDF;

class PDFMakerController extends Controller
{
    public function gen($id)
    {
       /* $pdf = App::make('dompdf.wrapper');
        $data = '<table class="table">';
        $data = $data . '<tr>';
        $data = $data .'<td>Marie</td>';
        $data = $data .'<td>Ville</td>';
        $data = $data .'<td>pays</td>';
        $data = $data .'<td>contacts</td>';
        $data = $data .'</tr>';
        $data = $data .'<tr>';
        $data = $data .'<td>Hamed Bakayoko</td>';
        $data = $data .'<td>Abobo</td>';
        $data = $data .'<td>Abidjan</td>';
        $data = $data .'<td>78546246</td>';
        $data = $data .'</tr>';
        $data = $data .'</table>';

        $pdf->loadHTML($data);
        return $pdf->stream();*/
        $bonSortie = BonSortie::find($id);
        $sorties = Sortie::listeSorties($id);
        $data = [
            'bonSortie'=>$bonSortie,
            'sorties'=>$sorties,
        ];
        $pdf = PDF::loadView('sorties/invoice', $data);
        return $pdf->download('Bon de Sortie N°'.$bonSortie->id.'.pdf');
    }

    /**
     * Liste des Membres du staff
     */
    public function listingTechnicien()
    {
        $techniciens = Technicien::listeTechniciens();

        $data = [
            'techniciens'=>$techniciens
        ];
        $pdf = PDF::loadView('technicien/listingTechnicien', $data);
        return $pdf->download('Liste des membres du staff.pdf');
    }

    public function listingUsers()
    {
        $techniciens = Technicien::listeTechniciens();
        $data = [
            'users'=>User::orderBy('created_at','desc')->get(),
            'techniciens'=>$techniciens
        ];

        $pdf = PDF::loadView('user/listingUsers', $data);
        return $pdf->download('Liste des utilisateurs.pdf');
    }

    public function listingFamilles()
    {
        $familles = Famille::listeFamille();
        $data = [
            'familles'=>$familles
        ];

        $pdf = PDF::loadView('famille/listingFamilles', $data);
        return $pdf->download('Liste des Familles.pdf');
    }

    public function listingFournisseur()
    {
        $fournisseurs = Fournisseur::listeFournisseurs();
        $data = [
            'fournisseurs'=>$fournisseurs
        ];

        $pdf = PDF::loadView('fournisseur/listingFournisseur', $data);
        return $pdf->download('Liste des Fournisseurs.pdf');
    }


    public function listingProduits()
    {
        $produits = Produit::listeProduits();

        $data = [
            'produits'=>$produits,
        ];

        $options = [
            'isRemoteEnabled'=>true,
        ];
        $pdf = PDF::loadView('produits/listingProduits', $data)->setPaper('a4','landscape')->setWarnings(false)->setOptions($options);
        return $pdf->download('Liste des Articles.pdf');
    }

    public function listingRetourStocks($id)
    {
        $retourStock = RetourStock::find($id);
        $retours =  Retour::listeRetoursById($id);
        $options = [
            'isRemoteEnabled' => true,
        ];
        $data = [
            'retourStock'=>$retourStock,
            'retours'=>$retours
        ];
        $pdf = PDF::loadView('retourStocks/listingRetourStocks', $data)->setPaper('a4','landscape')->setOptions([$options]);
        return $pdf->download('Retour en Stock N°'.$retourStock->id.'.pdf');
    }
}
