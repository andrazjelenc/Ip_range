#How to use

Add lists into /txt folder, then run join.php from / with command: php join.php > joined.txt



After that open created file and check if there are no extra words (check top and bottom of the file)

Now run work.php in / with command: php work.php > ordered.txt





work.php will check if there are any overlapping in the ip ranges and join them. Example:

192.168.1.10-192.168.1.20

192.168.1.15-192-168-1-30

result will be:
192.168.1.10-192.168.30


It also join ranges that are together but no overlapped:
192.168.1.50-192.168.1.255

192.168.2.0-192.168.2.10

result will be:
192.168.1.50-192.168.2.10
