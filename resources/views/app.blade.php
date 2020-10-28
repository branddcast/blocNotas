<html>
    <head>
        <title> Bloc de Notas</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('app.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            let token = "{{csrf_token()}}";
        </script>
        <script src="{{asset('responsive_waterfall.js')}}"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{url('/')}}">
                Bloc de Notas
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Inicio</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="{{url('/notes/add')}}">Agregar Nota</a>
                  </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid p-4">
            @yield('content')

            <div style="position: relative">
                <a href="{{url('notes/add')}}">
                    <div style="position: fixed; bottom: 50px; right: 50px; background: cornflowerblue; display: flex; align-items: center; justify-content: center; border-radius: 100%; width: 50px; height: 50px; color: #fff; cursor: pointer; box-shadow: 2px 2px 2px #b2b2b2">
                        <i class="fas fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>
    </body>
    <script>
        function deleteNote(id){
            console.log('_token='+token+'&id='+id);
            swal({
                title: "¿Está seguro que desea eliminar la nota?",
                text: "Una vez eliminada, ésta no se podrá recuperar.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    return new Promise(function(resolve, reject){
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            console.log(this.status);
                            if(this.status == 200){
                                swal('¡Genial!', this.responseText, "success")
                                .then((value) => {
                                    window.location="{{url('/')}}";
                                });
                                resolve(1);
                            }
                        };
                        xhttp.open('post', "{{url('notes/delete')}}/" + id, true);
                        xhttp.setRequestHeader('X-CSRF-TOKEN', token);
                        xhttp.send('_token='+token);
                    });
                } else {
                    swal("¡Cuidado la próxima vez!");
                }
                });
        }
    </script>
</html>