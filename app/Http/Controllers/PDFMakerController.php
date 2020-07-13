<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sortie;
use App\BonSortie;
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
        return $pdf->download('invoice.pdf');
    }
}
