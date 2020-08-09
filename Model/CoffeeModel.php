<?php

require ("Entities/CoffeeEntity.php");

class CoffeeModel {
    //Get all coffee types from database
    function GetCoffeeTypes() {
        require 'Credentials.php';

        //Connect
        $sqli = mysqli_connect($host,$user,$passwd) or die(mysqli_error($sqli));
        mysqli_select_db($sqli, $database);
        $result = mysqli_query($sqli, "SELECT DISTINCT type FROM coffee") or die(mysqli_error($result));
        $types = array();

        //Get data
        while($row = mysqli_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Colse connection
        mysqli_close($sqli);
        return $types;
    }

    function GetCoffeeByType($type) {
        require 'Credentials.php';
        
        //Connect
        $sqli = mysqli_connect($host,$user,$passwd) or die(mysqli_error($sqli));
        mysqli_select_db($sqli, $database);

        $query = "SELECT * FROM coffee WHERE type LIKE '$type'";
        $result = mysqli_query($sqli, $query) or die(mysqli_error($sqli));
        $coffeeArray = array();

        //Get data from database
        while($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $roast = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];
        
            //Create coffee objects and store them in an array
            $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
            array_push($coffeeArray, $coffee);
        }
        //Close connection
        mysqli_close($sqli);
        return $coffeeArray;
    }

    function GetCoffeeById($id) {
        require 'Credentials.php';
        
        //Connect
        $sqli = mysqli_connect($host,$user,$passwd) or die(mysqli_error($sqli));
        mysqli_select_db($sqli, $database);

        $query = "SELECT * FROM coffee WHERE id=$id";
        $result = mysqli_query($sqli, $query) or die(mysqli_error($sqli));

        //Get data from database
        while($row = mysqli_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $roast = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];
        
            //Create coffee object
            $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
        }
        //Close connection
        mysqli_close($sqli);
        return $coffee;
    }

    function InsertCoffee(CoffeeEntity $coffee) {
        $sqli = $this->Connect();

        $query = sprintf("INSERT INTO coffee
                            (name, type, price, roast, country, image, review)
                            VALUES
                            ('%s','%s','%s','%s','%s','%s','%s')",
        mysqli_real_escape_string($sqli, $coffee->name),
        mysqli_real_escape_string($sqli, $coffee->type),
        mysqli_real_escape_string($sqli, $coffee->price),
        mysqli_real_escape_string($sqli, $coffee->roast),
        mysqli_real_escape_string($sqli, $coffee->country),
        mysqli_real_escape_string($sqli, "Images/Coffee/" . $coffee->image),
        mysqli_real_escape_string($sqli, $coffee->review));
        $this->PerformQuery($query, $sqli);
    }
    
    function UpdateCoffee($id, CoffeeEntity $coffee) {
        $sqli = $this->Connect();

        $query = sprintf("UPDATE coffee
                            SET name = '%s', type='%s', price='%s', roast='%s', country='%s', image='%s', review='%s'
                        WHERE id =  $id",
        mysqli_real_escape_string($sqli, $coffee->name),
        mysqli_real_escape_string($sqli, $coffee->type),
        mysqli_real_escape_string($sqli, $coffee->price),
        mysqli_real_escape_string($sqli, $coffee->roast),
        mysqli_real_escape_string($sqli, $coffee->country),
        mysqli_real_escape_string($sqli, "Images/Coffee/" . $coffee->image),
        mysqli_real_escape_string($sqli, $coffee->review));
                        
        $this->PerformQuery($query, $sqli);
    }
    
    function DeleteCoffee($id) {
        $sqli = $this->Connect();
        $query = "DELETE FROM coffee WHERE id=$id";
        $this->PerformQuery($query, $sqli);
    }

    function Connect() {
        require 'Credentials.php';
        
        //Connect
        $sqli = mysqli_connect($host,$user,$passwd) or die(mysqli_error($sqli));
        mysqli_select_db($sqli, $database);

        return $sqli;
    }

    function PerformQuery($query, $sqli) {
        //Execute query and close connection
        mysqli_query($sqli, $query) or die(mysqli_error($sqli));
        mysqli_close($sqli);
    }

}

?>
