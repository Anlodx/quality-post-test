<!DOCTYPE html>
<html>

<head>
    <title>Quality Post - AGHH</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="./jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-container">

        <div class="logo-container">
            <div class="logo-img">
                <img src="./qualitypost logo sin fondo.png" alt="">
            </div>
        </div>

        <form id="data-form">

            <h1>CRUD con Ajax - Quality Post</h1>
            <h5 class="whoami">participante: aghh.oficial@gmail.com</h5>
            <!-- <input type="hidden" id="data-id" name="id"> -->

            <label for="id">id:</label>
            <input type="text" id="id" name="id">


            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address">
            <br>
            <label for="age">Edad:</label>
            <input type="number" id="age" name="age">
            <br>
            <div class="buttons">
                <!-- POST -->
                <input type="submit" value="Guardar">
                <!-- UPDATE -->
                <button type="button" id="update-button">Actualizar</button>
                <!-- DELETE -->
                <button type="button" id="delete-button">Eliminar</button>
                <!-- GET -->
                <button type="button" id="get-all-button">OBTENER TODOS</button>
            </div>
        </form>

        <div id="message">MENSAJE</div>

        <div id="list">

        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Al enviar el formulario, se realiza la inserción.
            //POST
            $('#data-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                console.log({
                    formularioSubmit: formData
                });

                $.ajax({
                    url: 'controller/DataController.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#message').html(response);
                        $('#data-form')[0].reset();
                    }
                });
            });

            //Al hacer clic en el botón "Actualizar", se carga el registro en el formulario.
            //UPDATE
            $('#update-button').click(function(e) {
                // var id = $('#data-id').val();

                e.preventDefault();
                var formData = $("#data-form").serialize();
                console.log({
                    formulario: formData
                });
                // return;
                $.ajax({
                    url: 'controller/DataController.php',
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#message').html(response);
                        $('#data-form')[0].reset();
                    }
                });
            });

            // Al hacer clic en el botón "Eliminar", se envía la petición para eliminar el registro.
            //DELETE
            $('#delete-button').click(function(e) {
                e.preventDefault();
                var formData = $("#data-form").serialize();
                console.log({
                    formulario: formData
                });
                $.ajax({
                    url: 'controller/DataController.php',
                    type: 'DELETE',
                    data: formData,
                    success: function(response) {
                        $('#message').html(response);
                        $('#data-form')[0].reset();
                    }
                });
            });

            //GET
            $('#get-all-button').click(function() {
                $.ajax({
                    url: 'controller/DataController.php',
                    type: 'GET',
                    success: function(response) {
                        let arrayFromServer = [];

                        if (!response) {
                            alert("SIN DATOS")
                            return null;
                        }
                        arrayFromServer = JSON.parse(response);

                        console.log({
                            arrayFromServer
                        });
                        if (!arrayFromServer) {
                            alert("SIN DATOS")
                            return null;
                        }

                        let $mapOfElements = arrayFromServer?.map((item) =>
                            (`
                            <div class="item">
                                <span>id: <span class="value"> ${item?.id} </span> </span>
                                <span>nombre: <span class="value"> ${item?.name} </span> </span>
                                <span>Direccion: <span class="value"> ${item?.address} </span> </span>
                                <span>edad: <span class="value"> ${item?.age} </span> </span>
                            </div>
                            `)
                        )

                        $('#message').html("Los Mejores Usuarios son:");
                        $('#list').html($mapOfElements);
                        $('#data-form')[0].reset();
                    }
                });
            });

        });
    </script>
</body>

</html>