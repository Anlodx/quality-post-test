<?php
class DataModel
{

    // POR LO REGULAR ACOSTUMBRO USAR PDO PERO NO SE SI PROBABLEMENTE AL MOMENTO DE EJECUTARLO EN OTRO ENTORNO DE ERROR.
    // SIN EMBARGO LO USE PARA ASEGURAR LA EFICIENCIA.

    private $conn; // Variable para almacenar la conexión

    public function __construct()
    {
        // Configuramos los datos de conexión a la base de datos
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'persons';

        // Crea una conexión con PDO
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function saveData($name, $address, $age)
    {
        //Insertar un nuevo registro en la base de datos.
        $query = "INSERT INTO best_users (name, address, age) VALUES (:name, :address, :age)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function updateData($id, $name, $address, $age)
    {
        // Actualizar los datos en la base de datos.
        $query = "UPDATE best_users SET name=:name, address=:address, age=:age WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteData($id)
    {
        // Eliminar los datos de la base de datos.

        $query = "DELETE FROM best_users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getData()
    {

        // Obtener los datos de la base de datos.
        $query = "SELECT * FROM best_users;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}

?>