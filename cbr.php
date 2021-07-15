<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>My test page</title>
  </head>
  <body>
    <p>Введите дату</p>
    <form method="POST">
      <ul>
    <li>
      <label for="day">Day:</label>
      <input type="number" id="day" name="myDay">
    </li>
    <li>
      <label for="month">Month:</label>
      <input type="number" id="month" name="myMonth">
    </li>
    <li>
      <label for="year">Year:</label>
      <input type="number" id="year" name="myYear">
    </li>
  </ul>
      <button type="submit">Send</button>
    </form>
    

<?php
$day = htmlentities($_POST['myDay']);
$month = htmlentities($_POST['myMonth']);
$year = htmlentities($_POST['myYear']);

if ($day - 1 != 0) {
  $yesDay = $day - 1;
  $yesDay = str_pad($yesDay, 2, "0", STR_PAD_LEFT);
  $yesMonth = $month;
  $yesYear = $year;
}
  else {
    switch ($month) {
      case 1:
        $yesDay = 31;
        $yesMonth = 12;
        $yesYear = $year - 1;
        break;
      case 2:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 3:
        if ($year % 4 != 0 || ($year % 100 == 0 && $year % 400 != 0)){
          $yesDay = 28;
          $yesMonth = $month - 1;
          $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
          $yesYear = $year;
          break;
        }
        
        else {
              $yesDay = 29;
              $yesMonth = $month - 1;
              $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
              $yesYear = $year;
            }
        break;
      case 4:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 5:
        $yesDay = 30;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 6:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 7:
        $yesDay = 30;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 8:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 9:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 10:
        $yesDay = 30;
        $yesMonth = $month - 1;
        $yesMonth = str_pad($yesMonth, 2, "0", STR_PAD_LEFT);
        $yesYear = $year;
        break;
      case 11:
        $yesDay = 31;
        $yesMonth = $month - 1;
        $yesYear = $year;
        break;
      case 12:
        $yesDay = 30;
        $yesMonth = $month - 1;
        $yesYear = $year;
        break;
    }
  }
echo $day . ' ' . $month . ' ' . $year . '<br>';
echo $yesDay . ' ' . $yesMonth . ' ' . $yesYear . '<br>';
class Bank
{
    protected $list = array();
 
    public function load()
    {
        global $day;
        global $month;
        global $year;
        global $url;

        $xml = new DOMDocument();
 
        if (@$xml->load($url))
        {
            $this->list = array(); 
 
            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');
 
            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }
 
            return true;
        } 
        else
            return false;
    }
 
    public function get($cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }
}

$cbr = new Bank();
$url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $day . '/' . $month . '/' . $year;
if ($cbr->load()){
    $usd_curs = $cbr->get('USD');
    $eur_curs = $cbr->get('EUR');
}
$cbr_2 = new Bank();
$url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $yesDay . '/' . $yesMonth . '/' . $yesYear;
if ($cbr->load()){
    $usd_curs_2 = $cbr->get('USD');
    $eur_curs_2 = $cbr->get('EUR');
}
echo $usd_curs . '<br>';
echo $eur_curs . '<br>';
echo $usd_curs_2 . '<br>';
echo $eur_curs_2;
?>

<p>USD <?php if ($usd_curs - $usd_curs_2 >= 0){ ?> &#8593; <?php } else {?> &#8595; <?php } echo (round($usd_curs - $usd_curs_2, 2)) ?></p>
<p>EUR <?php if ($eur_curs - $eur_curs_2 >= 0){ ?> &#8593; <?php } else {?> &#8595; <?php } echo (round($eur_curs - $eur_curs_2, 2)) ?></p>
  </body>
</html>
