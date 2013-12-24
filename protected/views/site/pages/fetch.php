<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Fetch';
$this->breadcrumbs=array(
	'Fetch',
);
?>
<h1>Fetch</h1>


<?php
  $url='http://ov-kempten.ov-cms.thw.de/unser-thw-ortsverband/terminkalender/kalender/ics/?type=150&tx_cal_controller%5Bcalendar%5D=20';

  $temp = tempnam('/tmp', 'thw-kempten');

  echo $temp;

  file_put_contents($temp, file_get_contents($url));


  unlink($temp);

?>
<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
