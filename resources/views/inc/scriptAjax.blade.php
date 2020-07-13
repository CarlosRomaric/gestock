 <script>
        $('#sample_id').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Valider')
            {
                $.ajax({
                    url:"{{ route('cotisationMensuelle.store') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = ''; 
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }  
                            html +='</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#example2').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);


                    }
                })
            }
        });
    </script>