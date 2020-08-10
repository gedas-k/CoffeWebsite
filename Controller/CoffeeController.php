<script>
//Display confirmation box
function showConfirm(id) {
    var c = confirm("Are you sure you wish to delete this item");

    if(c)
        window.location = "CoffeeOverview.php?delete=" + id;
}

</script>

<?php

require ("Model/CoffeeModel.php");

class CoffeeController {
    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Price</b></td>
                    <td><b>Roast</b></td>
                    <td><b>Country</b></td>
                </tr>";

        $coffeeArray = $this->GetCoffeeByType('%');

        foreach ($coffeeArray as $key => $value) {
            $result = $result . 
                        "<tr>
                            <td><a href='CoffeeAdd.php?update=$value->id'>Update</a></td>
                            <td><a href='#' onclick='showConfirm($value->id)'>Delete</a></td>
                            <td>$value->id</td>
                            <td>$value->name</td>
                            <td>$value->type</td>
                            <td>$value->price</td>
                            <td>$value->roast</td>
                            <td>$value->country</td>
                        </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

    function CreateCoffeeDropdownList() {
        $coffeeModel = new CoffeeModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type:
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($coffeeModel->GetCoffeeTypes()) .
                    "</select>
                        <input type = 'submit' value = 'Filter' />
                        </form>";
        
        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }
        return $result;
    }

    function CreateCoffeeTables($types) {
        $coffeeModel = new CoffeeModel();
        $coffeeArray = $coffeeModel->GetCoffeeByType($types);
        $result = "";

        foreach ($coffeeArray as $key => $coffee) {
            $result = $result . 
            "<table class='coffeeTable'>
                <tr>
                    <th rowspan='6' width='150px' ><img runat='server' src='$coffee->image' /></th>
                    <th width='75px' >Name: </th>
                    <td>$coffee->name</td>
                </tr>
                
                <tr>
                    <th>Type: </th>
                    <td>$coffee->type</td>
                </tr>

                <tr>
                    <th>Price: </th>
                    <td>$coffee->price</td>
                </tr>

                <tr>
                    <th>Roast: </th>
                    <td>$coffee->roast</td>
                </tr>

                <tr>
                    <th>Origin: </th>
                    <td>$coffee->country</td>
                </tr>

                <tr>
                    <td colspan='2' >$coffee->review</td>

            </table>";
        }
        return $result;
    }

    //Returns list of files in a folder
    function GetImages() {
        //Select forlder
        $handle = opendir("Images/Coffee");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Execute all filenames where filename lenght > 3
        $imageArray = array();
        foreach ($images as $image) {
            if(strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    //Set methods
    function InsertCoffee() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_FILES["file"]["name"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity(-1, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->InsertCoffee($coffee);
    }

    function UpdateCoffee($id) {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->UpdateCoffee($id, $coffee);
    }

    function DeleteCoffee($id) {
        $coffeeModel = new CoffeeModel();
        $coffeeModel->DeleteImage($id);
        $coffeeModel->DeleteCoffee($id);
    }

    //Get methods
    function GetCoffeeById($id) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeById($id);
    }

    function GetCoffeeByType($type) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeByType($type);
    }

    function GetCoffeeTypes() {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeTypes();
    }
}

?>
