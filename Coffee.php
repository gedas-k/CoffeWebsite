<?php

require 'Controller/CoffeeController.php';
$coffeeController = new CoffeeController();

if(isset($_POST['types'])) {
    //Fill pages with selected coffies
    $coffeeTables = $coffeeController->CreateCoffeeTables($_POST['types']);
} else {
    //Page is loaded first time. Fetch all types
    $coffeeTables = $coffeeController->CreateCoffeeTables('%');
}

//Output page data
$title = 'Coffee overview';
$content = $coffeeController->CreateCoffeeDropdownList() . $coffeeTables;

include 'template.php';

?>
