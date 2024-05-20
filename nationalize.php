<?php

$name = (string)readline("Please enter your name: ");
echo "Choose option:\n";
echo "1. If want to know name nationality\n";
echo "2. If want to know name gender\n";
echo "3. If want to know name age\n";
echo "\n";
$option = (int)readline("Please enter your option: ");

$nameNationality = "https://api.nationalize.io/?name={$name}";
$nameGender = "https://api.genderize.io?name={$name}";
$nameAge = "https://api.agify.io?name={$name}";
$url = "";

if ($option === 1) {
    $url = $nameNationality;
} else if ($option === 2) {
    $url = $nameGender;
} else if ($option === 3) {
    $url = $nameAge;
} else {
    echo "Wrong option\n";
    exit;
}

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($option === 1) {
    foreach ($data['country'] as $country) {
        echo "Country: " . $country['country_id'] . " - Probability: " . round(($country['probability'] * 100), 2) . "%\n";
    }
}

if ($option === 2) {
    echo $name . " is " . $data['gender'] . "\n";
}

if ($option === 3) {
    echo "Name " . $name . " is " . $data['age'] . " years old." . "\n";
}

if ($option < 1 || $option > 3) {
    echo "Wrong option\n";
}