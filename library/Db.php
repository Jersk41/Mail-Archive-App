<?php

define('BASE', dirname(__FILE__));
/**
 * class koneksi class
 */
class Db
{
    /** @var mysqli $conn mysqli connection */
    protected $conn;

    /** @var string $table name of table */
    public $table;

    /** @var string $primaryKey primary key or specific clause */
    public $primaryKey = "id";

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "pengarsipan_surat");
        $this->conn->set_charset('utf8mb4');
        return $this->conn;
    }

    /**
     * read all data
     *
     * read all data from table
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function read(array $parameter = [])
    {
        $rows = array();

        if (count($parameter) > 0) {
            // read single column/attributes
            if (count($parameter) === 1) {
                $stmt = $this->conn->prepare("SELECT $parameter[0] FROM $this->table");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($data = $result->fetch_assoc()) {
                    $rows[] = $data;
                }
                return $rows;
            }
            $params = implode(",", $parameter);
            $stmt = $this->conn->prepare("SELECT $params FROM $this->table");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc()) {
                $rows[] = $data;
            }
            return $rows;
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM $this->table");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($data = $result->fetch_assoc()) {
                $rows[] = $data;
            }
            return $rows;
            $stmt->close();
        }
    }

    public function search(string $id, $parameter = [])
    {
        $rows = array();
        if (count($parameter) == 0) {
            $result = $this->conn->query("SELECT * FROM $this->table WHERE $this->primaryKey LIKE '%$id%'");
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            $params = implode(",", $parameter);
            $sql = "SELECT $params FROM $this->table WHERE $this->primaryKey LIKE ?";
            if ($stmt = $this->conn->prepare($sql)) {
                $cond =  "'%$id%'";
                // var_dump($stmt);
                $stmt->bind_param("s", $cond);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    var_dump($row);
                    $rows[] = $row;
                }
                return $rows;
            };
            return $this->conn->affected_rows;
        }
    }


    public function add(array $arrValues)
    {
        $values = implode("', '", $arrValues);
        try {
            $stmt = $this->conn->prepare("INSERT INTO $this->table VALUES('$values')");
            if ($stmt->execute() == true) {
                $stmt->close();
            }
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function update(array $param)
    {
        $key = $param['key'];
        $param = $param['parameter'];
        $values = "";
        $keys = array_keys($param);
        $values = array_values($param);
        $a = 0;
        $arr = [];
        while ($a < count($keys)) {
            // echo "$keys[$a] => $values[$a]<br>";
            array_push($arr, " $keys[$a] = '$values[$a]'");
            $a++;
        }
        $values = implode(",", $arr);
        // var_dump((int)$key);
        // var_dump($values);
        try {
            $sql = "UPDATE $this->table SET $values WHERE $this->primaryKey = '$key'";
            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->execute();
            }
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $key)
    {
        // $id = $key;
        $table = $this->table;
        try {
            $sql = "DELETE FROM $table WHERE $this->primaryKey = '$key'";
            $this->conn->query($sql);
            return $this->conn->affected_rows;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function login($account = [])
    {
        $user = array();
        $sql = "SELECT `username`,`password`,`hak` FROM petugas WHERE username =?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param('s', $account['username']);
            $stmt->execute();
            // var_dump($stmt);
            // echo $this->conn->error;
            $result = $stmt->get_result();
            $num = $result->num_rows;
            echo $num;
            if ($num === 1) {
                echo "cek password";
                $row = $result->fetch_assoc();
                echo $account['password'];
                echo $row['password'];
                if ($account['password'] == $row['password']) {
                    echo "password dicek";
                    $hak = $row['hak'];
                    if ($hak == "Admin") {
                        echo $hak;
                        $user = [
                            'login' => true,
                            'username' => $row['username'],
                            'hak' => $row['hak'],
                        ];
                        return $user;
                    } elseif ($hak == "Petugas") {
                        echo $hak;
                        $user = [
                            'login' => true,
                            'username' => $row['username'],
                            'hak' => $row['hak'],
                        ];
                        return $user;
                    }
                }
            }
            $stmt->close();
        }
    }

    public function registration(array $data)
    {
        // pemfilteran data
        $nama_depan = htmlspecialchars($_POST['nama_depan']);
        $nama_belakang = htmlspecialchars($_POST['nama_belakang']);
        $username = strtolower(stripslashes($data['username']));
        $password1 = $data['password1'];
        $password2 = $data['password2'];
        // echo "$password1<br>$password2<br>";
        $hak = htmlspecialchars($_POST['hak']);

        // jika password dan konfirmasi password sama maka ini dijalankan
        if ($password1 != $password2) {
            return "Password tidak sama";
        } else {
            // cek apakah user sudah ada atau belum
            // buat query untuk mengecek username
            $sql1 = "SELECT username FROM petugas WHERE username='$username'";
            $stmt = $this->conn->prepare($sql1);

            // bind parameter username pada query
            // $stmt->bind_param('s', $username);

            // eksekusi query
            $stmt->execute();

            // cek dengan fetch_assoc apakah data sudah ada atau tidak
            if ($stmt->get_result()->fetch_assoc()) {
                // jika ada akan ada menampilkan pesan
                $pesan = "Username sudah terpakai";
                echo "<script>alert('$pesan')</script>";
                return false;
                // tutup statement pertama
                $stmt->close();
            }
            // hashing password
            // $password = password_hash($password1, PASSWORD_DEFAULT);
            // echo $password;
            // rubah data jadi string untuk dimasukkan ke tabel
            $sql2 = "INSERT INTO petugas
            VALUES (NULL,'$nama_depan','$nama_belakang','$username','$password1','$hak')";

            if ($stmt1 = $this->conn->prepare($sql2)) {
                $stmt1->execute();
                $stmt1->close();
            }
            return true;
        }
    }

    public function sql()
    {
        return $this->conn;
    }
}
