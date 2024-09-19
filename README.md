# PHP test

## 1. Installation

  ### 1. Cloning
  - clone the repository, in your shell: "git clone https://github.com/bortsigan/php_scale.git"
  - cd ./to/your/repository
  - in your shell: "composer install"
  - in your shell: "composer dump-autoload"

  ### 2. Setting up the DB
  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  
  ### 3. Test the project
  - you can test the demo script in your shell: "php index.php"
