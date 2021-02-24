@component('mail::message')
# Notification de validation de Bon de Sortie

@if ($bonSortie->status == 1 )
    Le Bon se sortie N° {{ $bonSortie->id }} a bien été validé.
    Voici la Remarque {{ $bonSortie->remarque }}
@else
    Le Bon se sortie N° {{ $bonSortie->id }} a  été Réjeté.
    Voici la Remarque {{ $bonSortie->remarque }}
@endif

@component('mail::button', ['url' => 'http://stock.lollita.net'])
Retour sur Gestion des Stocks
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
