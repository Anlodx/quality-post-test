<?php
require_once '../model/DataModel.php';


class DataController
{
    private $dataModel;

    public function __construct()
    {
        $this->dataModel = new DataModel();
    }

    public function handleFormData($name, $address, $age)
    {
        // podremos realizar validaciones adicionales antes de guardar los datos.
        return $this->dataModel->saveData($name, $address, $age);
    }

    public function handleUpdateData($id, $name, $address, $age)
    {
        // podremos realizar validaciones adicionales antes de actualizar los datos.
        return $this->dataModel->updateData($id, $name, $address, $age);
    }

    public function handleDeleteData($id)
    {
        // podremos realizar validaciones adicionales antes de borrar los datos.
        return $this->dataModel->deleteData($id);
    }

    public function handleGetData()
    {
        // podremos realizar validaciones adicionales antes de obtener los datos.
        $data = $this->dataModel->getData();
        // Aquí retornamos los datos en formato JSON para que el frontend los maneje.
        echo json_encode($data);
    }
}



$globalDataController = new DataController();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $name = $_POST['name'] ?? null;
        $address = $_POST['address'] ?? null;
        $age = $_POST['age'] ?? null;

        if (!$name || !$address || !$age) {
            echo "PARAMETRO NO ENVIADO";
            return;
        }

        if ($globalDataController->handleFormData($name, $address, $age)) {
            echo "¡Datos guardados correctamente POST!";
        } else {
            echo "¡Error al guardar los datos!";
        }
        break;

    case "PUT":
        $putData = file_get_contents("php://input");

        if (!empty($putData)) {
            // Aquí convertimos los datos a un arreglo asociativo.
            parse_str($putData, $putArray);

            // Ahora podemos acceder a los datos recibidos mediante el método PUT
            // a través del arreglo asociativo $putArray.
            $id = $putArray['id'];
            $name = $putArray['name'];
            $address = $putArray['address'];
            $age = $putArray['age'];

            if (!$id || !$name || !$address || !$age) {
                echo "PARAMETRO NO ENVIADO";
                return;
            }

            if ($globalDataController->handleUpdateData($id, $name, $address, $age)) {
                echo "¡Datos guardados correctamente PUT!";
            } else {
                echo "¡Error al guardar los datos!";
            }
        }

        break;

    case "GET":

        $globalDataController->handleGetData();

        break;

    case "DELETE":

        $deleteData = file_get_contents("php://input");

        if (!empty($deleteData)) {
            // Aquí convertimos los datos a un arreglo asociativo.
            parse_str($deleteData, $deleteArray);

            // Ahora puedes acceder a los datos recibidos mediante el método DELETE
            // a través del arreglo asociativo $deleteArray.
            $id = $deleteArray['id'] ?? null;

            if (!$id) {
                echo "PARAMETRO NO ENVIADO";
                return;
            }

            if ($globalDataController->handleDeleteData($id)) {
                echo "¡Datos guardados correctamente DELETE!";
            } else {
                echo "¡Error al guardar los datos!";
            }
        }

        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo "¡Error! Método no permitido.";
        break;
}

?>