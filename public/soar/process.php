<?

$name = $_POST['name'];
$email = $_POST['email'];
$major = $_POST['major'];

$data = $name . ", " . $email . ", " . $major . "\n";

file_put_contents('../../soar.txt', $data);

