# interview-2016
php and bash problems

* * *

## SplittingLoot
Splitting an array of numbers into subarrays, each with equal sum.

You, and your trusty band of adventurers, have stumbled upon a hidden cache of diamonds! (What luck, eh?) Not all gems are created equal, so you sneak them home and take your time evaluating the stones. The find was an equal effort, and you're all horribly greedy, so you must find a fair system for dividing up the gems.

Your task is to write a program that fairly divides treasures, based on worth.

The first command-line argument to the program will be the number of adventurers. All other arguments are the numerical values of treasures found. You're program should output a fair split of the treasures, if possible, or a warning message if a fair split cannot be found.

### Examples:

~~~~
$ ./looter 3 1 2 3 4
It is not possible to fairly split this treasure 3 ways.
~~~~

~~~~
$ ./looter 2 9 12 14 17 23 32 34 40 42 49
1:  9 12 32 34 49
2:  14 17 23 40 42
~~~~

* * *

## SecretSanta

My friends all play a Secret Santa game around the Christmas time. To choose Santas, we use to draw names out of a hat. This system was tedious, prone to many "Wait, I got myself..." problems.
So, lets help them

Write valid XML file with list of names.
Write a program that takes a list with names from xml file, draws randomly person for each one and print result.
You must print pairs of names and make sure one does not match to itself.

### Example:

~~~~
John - Mary
Peter- Steven
.... - .....
Tom - Elizabeth
~~~~

* * *

## Samples

The challenge is to implement a program called "sample" that takes exactly two integer inputs. The first of those should be the number of members chosen at random you would like included in the sample. The second is the upper boundary (exclusive) of the range of integers members can be selected from. The lower boundary is zero (inclusive).

Your program should output exactly the requested number of members from the defined range to STDOUT, one number per line. Each member must be unique and they should appear in sorted order

### Example outputs:

~~~~
$ ./sample 3 10
0
1
5
~~~~

~~~~
$ ./sample 3 10
1
2
8
~~~~

~~~~
$ ./sample 3 10
2
3
9
~~~~

* * *

## int2binary

Write a function that returns binary string from integer number, for example `int2binary(10)` returns "1010"

* * *

## Fortune

You are to write a web service that returns a different quote every time you visit it. As an additional requirement, if you add a query parameter like "?q=alabala" it should return a random quote that contains the string "alabala". 

You are encouraged to provide one or many sources for quotes like text file, xml file and database.
