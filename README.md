# Courses

## Services
- API
- RabbitMQ
- Mailer

## Installation
#### API
- `make run` to create a `docker-compose.yml` and `.env.local` files and to spin up the containers
- `make prepare` to install dependencies, run migrations and install assets
- Navigate to `http://localhost:260/api/v1/docs` to check OpenAPI documentation

#### RabbitMQ
- `make run` to start the container
- Import default definitions from `rabbitmq/docker/rabbit_config.json`
- Navigate to `http://localhost:15672` to open RabbitMQ Management

#### Mailer
- `make run` to create a `docker-compose.yml` and `.env.local` files and to spin up the containers
- `make prepare` to install dependencies and run migrations
- To consume messages go to the container bash with `make ssh-be` and run `bin/console messenger:consume amqp_user` to consume messages coming from the API

### Collaboration
This project follow Symfony coding standards. Before commit in the API or Mailer service please run: `make code-style`
