<!doctype html>
<html lang="en">
  <head>
    <title> Chat Test </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        Chat Room
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" id="name">
                        </div>
                        <div class="form-group" id="data-message">

                        </div>
                            <div class="form-group">
                                <textarea id="message" class="form-control" placeholder="message">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block primary">Kirim</button>
                            </div>
                    </div>
                </div>    
            </div> 
        </div>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ url('js/app.js')}}"></script>
    <script>
        $(function(){
            const Http = window.axios;
            const Echo = window.Echo;
            const name = $("#name");
            const message = $('#messsage');

            $("input, textarea").keyup(function(){
                $(this).removeClass('is-invalid');
            });

            $('button').click(function(){
                if (name.val() == ''){
                    name.addClass('tidak valid');
                } else if (message.val() == ''){
                    message.addClass('tidak valid');
                } else {
                    Http.post("{{ url ('Kirim') }}",{
                        'name': name.val(),
                        'message': message.val(),
                    
                    }).then(() => {
                        message.val('')
                    })

                }
            });

            let channel = Echo.channel('channel-chat')
            channel.listen('Gempita', function(data) {
                $('data-message')
                .append('<stong> $(data.message.name) </stong>:$(data.message.message)<br>');
            })

        })
    </script>
  </body>
</html>