===========
THW-Heizung
===========

Overwiew
========

This is a Yii-Application controlling the central heater of our THW-OV.

This Application bases on a Raspberry Pi board running as Web-Server for this application and additionally
for reading temperatures over a 1Wire bus and to control a Relays-Board for steering the Heater.

Using a Yii-Command the online ICAL-Calender will be read and put the Data into a Database.

Out of the Database a leading time according to the outside temperature will be calculated, and a Relays will be switched.

Requirements
============

- Raspberry Pi Board for running Application ans to connect 1Wire Sensors ans a Relays-Board
- Linux-Distribution running on the Raspberry Pi (http://www.raspbian.org/)
- A Web-Server with PHP5 support (esp. nginx using php5-fpm as php engine)
- Yii-Framework (http://www.yiiframework.com/)
- A few number of 1Wire Temperature-Sensors, (esp. Dallas 18S20)
- Relays-Board for steering the heater
