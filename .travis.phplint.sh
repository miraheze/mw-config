#!/bin/bash
#Author Addshore

composer install --prefer-source --quiet --no-interaction

composer test
