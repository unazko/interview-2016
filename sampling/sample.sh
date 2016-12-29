#!/bin/bash
#reading input into an array
input=()
for arg
do
	input+=($arg)
done

#cheking if there is the right count of input arguments
if [ ${#input[@]} -ne 2 ]; then
	echo "Invalid input."
	exit
fi

#reading from the array into the variables
sample_size=${input[0]}
upper=${input[1]}
lower=0
counter=0
declare -a random_numbers

#if sample_size is bigger than upper + 1 than 
#not all values will be unique
if [ $sample_size -gt $(($upper + 1)) ]; then
	echo "Invalid input."
	exit
fi

for ((i=0; i<sample_size;i++))
do	
	#infinite loop creating random value in the given range
	#and checking if that value appears in the random_numbers array
	#if not break else loop until unique value is created
	while :
	do
		flag=0
		new_number=$[($RANDOM % ($[$upper - $lower])) + $lower]
		for var in "${random_numbers[@]}"
		do
			if [ $var -eq $new_number ]; then
			
				let "flag=1"
				break
			fi
		done
		
		if [ $flag -eq 0 ]; then
			break
		fi
	done

	#assigning unique values to the random_numbers array
	random_numbers[$counter]=$new_number
	let "counter++"
done

#creating sorted array with the elemets from random_numbers
sorted=( $( printf "%s\n" "${random_numbers[@]}" | sort -n) )

#prining the sorted array
for var in "${sorted[@]}"
do
	echo $var
done
