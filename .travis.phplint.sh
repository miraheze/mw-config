#!/bin/bash
#Author Reception123

find ../ -type f -regex '.*\.php\|.*\.php\.j2' -exec php -l {} \; | grep "Errors parsing ";

#Flip the exit code
if [ $? -ne 0 ]
then
	exit 0
else
	exit 1
fi
