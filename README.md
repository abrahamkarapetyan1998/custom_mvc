
# My Web Application
This is a simple web application built with PHP and MySQL. It allows users to submit comments with their name, email, title, and description, which are stored in a MySQL database.

# Requirements
To run this application, you will need:

* Docker
* Docker Compose

# Installation


1. Navigate to the project directory
2. Build the Docker images: docker-compose build
3. Start the Docker containers: docker-compose up -d
4. Open your web browser and go to http://localhost
# Usage

Once the application is running, you can submit comments using the form on the home page. The comments will be stored in the MySQL database and displayed on the home page.

You can also access the Adminer interface by going to http://localhost:8080. Use the following credentials to log in:

* System: MySQL
* Server: db
* Username: root
* Password: example
* Database: test
