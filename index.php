<?php
date_default_timezone_set('Europe/Warsaw');
if(empty($_GET['miasto'])){
    $cityId = "Warszawa";
} else {
    $cityId = $_GET['miasto'];
}

$apiKey = "token";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityId . "&lang=pl&units=metric&APPID=" . $apiKey;
$response = file_get_contents($googleApiUrl);
//$ch = curl_init();

//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($ch, CURLOPT_VERBOSE, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//$response = curl_exec($ch);

//curl_close($ch);
$data = json_decode($response);
$currentTime = time();

function date_pl($string)

{

 $string = str_replace('Mon', 'Poniedziałek', $string);
 $string = str_replace('day', '', $string);
 $string = str_replace('Tue', 'Wtorek', $string);
 $string = str_replace('Wed', 'Środa', $string);
 $string = str_replace('Thu', 'Czwartek', $string);
 $string = str_replace('Fri', 'Piątek', $string);
 $string = str_replace('Sat', 'Sobota', $string);
 $string = str_replace('Sun', 'Niedziela', $string);
 $string = str_replace('Jan', 'Styczeń', $string);
 $string = str_replace('Feb', 'Luty', $string);
 $string = str_replace('Mar', 'Marzec', $string);
 $string = str_replace('Apr', 'Kwiecień', $string);
 $string = str_replace('May', 'Maj', $string);
 $string = str_replace('Jun', 'Czerwiec', $string);
 $string = str_replace('Jul', 'Lipiec', $string);
 $string = str_replace('Aug', 'Sierpień', $string);
 $string = str_replace('Sep', 'Wrzesień', $string);
 $string = str_replace('Oct', 'Październik', $string);
 $string = str_replace('Nov', 'Listopad', $string);
 $string = str_replace('Dec', 'Grudzień', $string);
 
 return $string;

}

?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="api.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="manifest.json">
<title>Responsive weather by kubek</title>
</head>
<body>
    <div class="city">
        <h1>Wpisz miejscowość:</h1>
        <form action="">
            <input autocomplete="off" name="miasto" type="text">
            <button>Zatwierdź</button>
        </form>
    </div>
    <?php if(isset($data->name)){
    //     echo '
    
    // <div class="weather-box">
    //     <h1>'.$data->name.'</h1>
    //     <img src="http://openweathermap.org/img/w/'.  $data->weather[0]->icon .'.png" class="weather-icon" />
    //     <div class="weather-icon-text">'.  ucwords($data->weather[0]->description) .'</div>
    //     <span class="weather-temp">'. $data->main->temp.'°C</span>
    //     <span class="weather">'. $data->main->feels_like.'°C</span>
    //     <div class="time">
    //         <div>'.  date_pl(date("D H:i", $currentTime)) .'</div>
    //         <div>'.  date_pl(date("j M, Y",$currentTime)) .'</div>
    //     </div>
    //     <div class="">
    //              <br>Maksymalna temperatura: '. $data->main->temp_max .'°C<br>
    //             <span class="min-temperature">Minimalna temperatura:'. $data->main->temp_min .'°C</span><br>
    //     </div>
    //     <div class="">
    //         <div>Wilgotność:'.  $data->main->humidity  .'%</div>
    //         <div>Wiatr:'.  $data->wind->speed  .'km/h</div>
    //     </div>
    // </div>';
    echo '
    <div class="mobile">
        <h1>'.$data->name.'</h1>
        '; if($data->timezone == '7200'){
            echo '
            <span class="feels-time">'.  date_pl(date("D H:i", $currentTime)) .'</span>
            <span class="feels-time">'.  date_pl(date("j M, Y",$currentTime)) .'</span>
            ';
        }echo '
        <div class="temp">
            <img src="http://openweathermap.org/img/w/'.  $data->weather[0]->icon .'.png" class="temp-icon" />
            <span class="temp-temp">'. $data->main->temp.'°C</span>
        </div>
        <span class="feels--bigger"> '.ucwords($data->weather[0]->description).'</span>
        <span class="feels"> Odczuwalna: '. $data->main->feels_like.'°C</span>
        <span class="feels">Wilgotność:'.  $data->main->humidity  .'%</span>
        <span class="feels">Wiatr:'.  $data->wind->speed  .'km/h</span>
        <span class="feels">Min/max: '.  $data->main->temp_min  .'°C/'.  $data->main->temp_max .' °C</span>
    </div>
    ';
    } else {
        echo '
            <div class="mobile--error">
                <h1>Nie znaleziono takiej miejsowości!</h1>
            </div>
            ';
    } ?>
</body>
</html>
