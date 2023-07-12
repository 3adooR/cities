# CITIES

Simple CRUD for manage cities on Laravel v8 with Breeze, php 7.4.

## Run application
To run you need:
1. Installed Docker;

2. Installed Node + Npm;
```
apt update && apt install nodejs && apt install npm
```

3. Create a configuration file (.env) in the project directory (/www/).
   Use /www/.env.example as a base

4. In the root directory of the project, run the following command in the console:
```
./up.sh
```

# Result
> ./up.sh will automatically raise all necessary containers and the application will be available at **http://localhost:80**

> To enter the container with the project, use the command in the console **docker-compose exec php bash**

> To remove containers, use the command in the console **docker-compose down**
