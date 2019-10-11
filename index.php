<?php
require_once 'vendor/autoload.php';
require_once 'vendor/mashape/unirest-php/src/Unirest.php';

Unirest\Request::verifyPeer(false); 
$response = Unirest\Request::get("https://api-football-v1.p.rapidapi.com/v2/fixtures/live?timezone=Europe%2FLondon",
  array(
    "X-RapidAPI-Host" => "api-football-v1.p.rapidapi.com",
    "X-RapidAPI-Key" => "xxxx"
  )
);


$resultat = json_decode(json_encode($response),true);
/*print_r($resultat);*/
?>
<table>
    <tr>
        <td>Heure du match</td>
        <td>Equipe domicile</td>
        <td>Equipe Exterieur</td>
        <td>Temps de Jeu</td>
        <td>Score</td>
    </tr>
<?php
foreach ($response->body->api->fixtures as $match){
    echo '<tr>';
    echo '<td>'.date('d/m/Y', $match->event_timestamp).' à '. date('H:i:s', $match->event_timestamp).'</td>';
    echo '<td>'.$match->homeTeam->team_name.'</td>';
    echo '<td>'.$match->awayTeam->team_name.'</td>';
    echo '<td>'.$match->elapsed.'</td>';
    echo '<td>'.$match->goalsHomeTeam.' - '.$match->goalsAwayTeam.'</td>';
    echo '</tr>';
}

?>
</table>
