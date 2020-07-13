<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    

    $( "#close" ).click(function() {
         $(".alert").alert('close');
    });
   
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "language": {
                processing:     "Traitement en cours...",
                search:         "Rechercher&nbsp;:",
                lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix:    "",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable:     "Aucune donnée disponible dans le tableau",
                paginate: {
                    first:      "Premier",
                    previous:   "Pr&eacute;c&eacute;dent",
                    next:       "Suivant",
                    last:       "Dernier"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
      });


//Autoriser que la saisie des chiffres
function chiffres(event) {
        // Compatibilité IE / Firefox
        if(!event&&window.event) {
        event=window.event;
        }
        // IE
        if(event.keyCode < 48 || event.keyCode > 57 || event.keyCode  == 8 || event.keyCode == 127) {
        event.returnValue = false;
        event.cancelBubble = true;
        }
        // DOM
        if(event.which < 48 || event.which > 57 || event.keyCode == 8 || event.keyCode == 127) {
        event.preventDefault();
        event.stopPropagation();
        }
}


     
    </script>

   