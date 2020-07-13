#!/bin/bash
echo "Press [CTRL+C] to stop.."

while true
do
	val=`./artisan hash:fetch`
    echo $val
done


