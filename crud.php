<?php


class crud
{

    function conn_to_db() {
        return new mysqli("localhost", "root","", "tmp"); 
    }

    function current_read($query) {
        $conn = $this->conn_to_db();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->fetch_row()[0]; // haal alleen 1 value uit, niet meer dan dat
    }

    function custom_query($sql) {
        $conn = $this->conn_to_db();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->fetch_row()[0]; 
    }

    function read_all($timespan = 24) {

        $latest = $this->latest_read();
        $latest = strtotime($latest);
        $time = $latest - $timespan * 60 * 60;
        $datetime = date("Y-m-d H:i:s", $time);

        $conn = $this->conn_to_db();
        $sql = "SELECT * FROM `temperatuur` where `datum` >= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $datetime);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->fetch_all(MYSQLI_ASSOC); // haal alle data uit van de sql query
    }

    function latest_read() {
        $conn = $this->conn_to_db();
        $sql = "SELECT `datum` FROM `temperatuur` ORDER BY `datum` DESC LIMIT 1 "; // selecteert de onderste/laatste kolom, datum in dit geval, van de database
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->fetch_row()[0]; // haal alleen 1 value uit, niet meer dan dat
    }
}