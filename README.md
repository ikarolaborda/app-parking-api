# Car Parking Management API

This is a simple API for managing a car parking. For study purposes only. It was developed using the following technologies:
* [PHP](https://php.com)
* [Laravel](https://laravel.com/)
* [MySQL](https://www.mysql.com/)
* [Docker](https://www.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Swagger](https://swagger.io/)

## Installation

Warning: To properly run the application, you must have installed [Docker](https://www.docker.com/) e o [Docker Compose](https://docs.docker.com/compose/).

1 - In order to setup the project, clone this repository and run the commands below:

```bash
    make build
    make dci
```

This will create the necessary containers to run the app.

2 - Next, run the command below to setup the database:

```bash
    make mig
```

### Test and Documentation
This project uses [Swagger](https://swagger.io/) for documentation. To access the documentation, just use the following link:
```bash
        http://localhost:8000/docs
```
To run the tests, use the command below:
```bash
    make test
```
