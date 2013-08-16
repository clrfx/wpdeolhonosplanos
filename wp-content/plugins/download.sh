#!/bin/bash

wget http://downloads.wordpress.org/plugin/wp-super-cache.1.2.zip
wget http://downloads.wordpress.org/plugin/wp-recaptcha.3.1.6.zip
wget http://downloads.wordpress.org/plugin/attachments.1.6.2.1.zip
wget http://downloads.wordpress.org/plugin/mapbox.1.1.1.zip
wget http://downloads.wordpress.org/plugin/contact-form-7.3.3.1.zip
wget http://downloads.wordpress.org/plugin/import-users-from-csv.0.5.1.zip
wget http://downloads.wordpress.org/plugin/wp-csv.1.3.6.zip
wget http://downloads.wordpress.org/plugin/google-analytics-for-wordpress.4.2.8.zip
wget http://downloads.wordpress.org/plugin/content-slide.zip

unzip wp-super-cache.1.2.zip
unzip wp-recaptcha.3.1.6.zip
unzip attachments.1.6.2.1.zip
unzip mapbox.1.1.1.zip
unzip contact-form-7.3.3.1.zip
unzip import-users-from-csv.0.5.1.zip
unzip wp-csv.1.3.6.zip
unzip google-analytics-for-wordpress.4.2.8.zip
unzip content-slide.zip

rm *.zip
