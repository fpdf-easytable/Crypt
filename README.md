# Crypt
Simple but strong class for cryption

# Quick start

- In the file config.php set a value for the constant PATH,

- Run the script setUp.php via command line,

- Done!

# How to

- send encrypted messages between two servers:

      - generate the key_file.php via setUp.php in server A,
      - set the constant PATH in config.php in server B *without* running the script setUp.php, 
      - upload to server B the key_file.php generated by server A and put it in the path PATH of server B
      - done!
     
