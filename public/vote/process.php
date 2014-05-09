<?
// Tread carefully, for the horror is real
define("MEMBER_FILE", "../../members.txt");
define("V0TES_FILE",  "../../votes.txt");
foreach($_POST as $k => $v) {
$GLOBALS[$k] = $v;
}
if(defined("MEMBER_FILE") && defined("V0TES_FILE")) {
$GLOBALS["MEmBER_FILE"] = MEMBER_FILE;
$GLOBALS["V0TES_FILE"] = V0TES_FILE;
}
if (empty($_POST['cid']) or empty($_POST['president']) or empty($_POST['vp']) or empty($_POST['treasurer']) or empty($_POST['secretary']) or empty($_POST['info']) or empty($_POST['event']) or empty($_POST['webmaster'])) 
die("Invalid vote. Make sure you filled in your Coyote ID and your vote for each position.");
$GLOBALS["candidates"] = array('president' => array('allbee'), 'vp' => array('swoope', 'brinker', 'sterrett'), 'treasurer' => array('swoope', 'abadines', 'allbee'), 'secretary' => array('legg', 'sterrett'), 'info' => array('swoope', 'brinker', 'sterrett'), 'event' => array('alsibai'), 'webmaster' => array('korcha'));
$GLOBALS["cid"] = ltrim($_POST['cid'], '0');
$GLOBALS["members"] = file($GLOBALS['MEmBER_FILE'], FILE_IGNORE_NEW_LINES);
class Voting {
public function __construct() {
$this->candidates = $GLOBALS['candidates'];
$GLOBALS['error'] = false;
}
public function vote() {
$president = $GLOBALS["president"];
$vp = $GLOBALS["vp"];
$treasurer = $GLOBALS["treasurer"];
$secretary = $GLOBALS["secretary"];
$info = $GLOBALS["info"];
$event = $GLOBALS["event"];
$webmaster = $GLOBALS["webmaster"];
if(!candidate_find('president', $president)) {
$GLOBALS["error"] = true;
}
if(!candidate_find('vp', $vp)) 
$GLOBALS["error"] = true;
if(!candidate_find('treasurer', $treasurer)) {
$GLOBALS["error"] = true;}
if(!candidate_find('secretary', $secretary)) {
$GLOBALS["error"] = true;
}
if(!candidate_find('info', $info)) {
$GLOBALS["error"] = true;
}
if(!candidate_find('event', $event)) $GLOBALS["error"] = true;
if(!candidate_find('webmaster', $webmaster)) {
$GLOBALS["error"] = true;
}
if($GLOBALS["error"]) 
die("Invalid vote. Make sure you filled in a valid candidate for each position.");
$vote = "{$GLOBALS['cid']} - {$president}, {$vp}, {$treasurer}, {$secretary}, {$info}, {$event}, {$webmaster}\n";
file_put_contents($GLOBALS['V0TES_FILE'], $vote, FILE_APPEND | LOCK_EX);
file_put_contents($GLOBALS['MEmBER_FILE'], implode("\n", array_diff($GLOBALS["members"], array($GLOBALS["cid"]))), LOCK_EX);
return true;
}
public static function make() {
return new Voting();
}
}
function candidate_find($position, $name, $iter = 0) {
for($i = $iter; $i < count($GLOBALS["candidates"][$position]); $i++) {
if($GLOBALS["candidates"][$position][$i] == $name) {
return true;
}
}
if($iter < 5)
return candidate_find($position, $name, $iter++);
return false;
}
if(in_array($GLOBALS["cid"], $GLOBALS["members"]) === false) {
die("Either you are not a member, or your vote has already been cast. If you feel this is in error, <strong>please</strong> contact webmaster@cse-club.com and we'll get it sorted out.");
}
if(Voting::make()->vote()) {
echo "Your vote has been cast, thank you!";
}
/*
much php
such globals
what whitespace
wow
░░░░░░░░░▄░░░░░░░░░░░░░░▄░░░░
░░░░░░░░▌▒█░░░░░░░░░░░▄▀▒▌░░░
░░░░░░░░▌▒▒█░░░░░░░░▄▀▒▒▒▐░░░
░░░░░░░▐▄▀▒▒▀▀▀▀▄▄▄▀▒▒▒▒▒▐░░░
░░░░░▄▄▀▒░▒▒▒▒▒▒▒▒▒█▒▒▄█▒▐░░░
░░░▄▀▒▒▒░░░▒▒▒░░░▒▒▒▀██▀▒▌░░░
░░▐▒▒▒▄▄▒▒▒▒░░░▒▒▒▒▒▒▒▀▄▒▒▌░░
░░▌░░▌█▀▒▒▒▒▒▄▀█▄▒▒▒▒▒▒▒█▒▐░░
░▐░░░▒▒▒▒▒▒▒▒▌██▀▒▒░░░▒▒▒▀▄▌░
░▌░▒▄██▄▒▒▒▒▒▒▒▒▒░░░░░░▒▒▒▒▌░
▀▒▀▐▄█▄█▌▄░▀▒▒░░░░░░░░░░▒▒▒▐░
▐▒▒▐▀▐▀▒░▄▄▒▄▒▒▒▒▒▒░▒░▒░▒▒▒▒▌
▐▒▒▒▀▀▄▄▒▒▒▄▒▒▒▒▒▒▒▒░▒░▒░▒▒▐░
░▌▒▒▒▒▒▒▀▀▀▒▒▒▒▒▒░▒░▒░▒░▒▒▒▌░
░▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒░▒░▒░▒▒▄▒▒▐░░
░░▀▄▒▒▒▒▒▒▒▒▒▒▒░▒░▒░▒▄▒▒▒▒▌░░
░░░░▀▄▒▒▒▒▒▒▒▒▒▒▄▄▄▀▒▒▒▒▄▀░░░
░░░░░░▀▄▄▄▄▄▄▀▀▀▒▒▒▒▒▄▄▀░░░░░
░░░░░░░░░▒▒▒▒▒▒▒▒▒▒▀▀░░░░░░░░
*/?>