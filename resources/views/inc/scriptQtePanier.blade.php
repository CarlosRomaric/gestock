<script>
    var selects = document.querySelectorAll('#qty');
    //console.log(selects);
    Array.from(selects).forEach((element) =>{
       element.addEventListener('change', function(){
           var rowId = this.getAttribute('data-id');
           var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
           fetch(
               `/panier/${rowId}`,
               {
                   headers: {
                       "Content-Type": "application/json",
                       "Accept": "application/json, text-plain, */*",
                       "X-Request-With":"XMLHttpRequest",
                       "X-CSRF-TOKEN": token
                   },
                   method: 'put',
                   body: JSON.stringify({
                       qty: this.value
                   })

               }
           ).then((data) => {
               console.log(data);
               location.reload();
           }).catch((error) => {
               console.log(error)
           })
       });
    });
</script>