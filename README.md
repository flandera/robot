# ROBOT

Simple php application simulating a cleaning robot.
 
## How to run

- setup port and IP address in docker compose file
- run docker-compose up
- docker exec -it container_name bash  
- cd /var/www/robot
- run Composer install

From CLI run commands:
php Robot.php clean --floor=carpet --area=70 -vvv

##Test
run test from commandline inside container<br/>
`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/`

## License
Robot is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
