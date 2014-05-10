<?

$name  = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];

$data = $name . ", " . $email . ", " . $major . "\n";
file_put_contents("../../soar.txt", $data);

echo "Form submitted! <a href='http://cse-club.com/soar'>Go back to the form</a>.";
