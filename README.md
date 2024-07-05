# Books Managemant System

## Introduction

The system is designed to manage books in a library .


## Technology Used

- Laravel.

## Installation and Usage

### Running the Project

1. Clone the repository to your local machine using `git clone`.
2. To access books system run `cd book-management`.
3. install the required dependencies by running `php composer update`.
4. Create a copy of the `.env.example` file and name it `.env` run`cp .env.example .env`.
5. Generate Laravel application key run `php php artisan key:generate`.
6. Run the migrations and seed the database using `php artisan migrate:fresh --seed`.
7. Run the project using `php artisan serve`.

### Running the Test Cases

1. Run the test cases using `php artisan test`.

# API Documentation

## Create a Book Endpoint

### POST ```/api/books```

Creates a new book in the system.

**Request Body:**

```json
{
    "title": "test",
    "author":"test",
    "isbn":"23432423"
}
```

## List Books Endpoint

### GET ```/api/books```

List Books Of the system.

##  Show a specific Book Endpoint

### GET ```/api/books/{book_id}```
