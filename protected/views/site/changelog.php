<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Changelog</h1>

<h3>v1.7</h3>
<ul>
    <li>new: add page for display changelog</li>
</ul>

<h3>v1.6</h3>
<ul>
    <li>fix: move fetching of ICS-events to new thw kalendar url</li>
    <li>fix: move fetching of ICS content from file_get_contents to curl</li>
</ul>
