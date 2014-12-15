#!/bin/bash


PHP_FCGI_CHILDREN=5
export PHP_FCGI_CHILDREN
exec /usr/local/php5/bin/php-cgi
