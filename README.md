# Pasalubong Center - Business Management System (PCBMS)

Pasalubong Center - Business Management System (PCBMS) is a web system written in vanilla PHP, MySQL, and JQuery, utilizing the MVC architectural pattern in its implementation. This demo project is a partial fulfillment for the requirements of CSci 136 - Software Engineering 2.

## Setup

> [!NOTE]
> This setup assumes that you have [XAMPP](https://www.apachefriends.org/) installed, with MySQL and Apache running.

1. Clone the repo with Github's Code > Open with VSCode/GithubDesktop or:

```shell
git clone https://github.com/HanzFelix/pcbms.git
```

2. Navigate to project

```shell
cd pcbms
```

3. Create an empty database with your preferred database name

4. Import the tumulak_pcbms_db.sql file to the empty database

5. Copy .env file from .env.example

```shell
cp .env.example .env
```

6. Modify the .env values according to your database configuration

```shell
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=name_of_created_db
```

7. Start server

```shell
php -S localhost:7000
```

## Usage

Log in using one of the following default user credentials

| Username | Password   | Role        |
| -------- | ---------- | ----------- |
| `user1`  | `password` | `manager`   |
| `user1`  | `password` | `cashier`   |
| `user1`  | `password` | `personnel` |
