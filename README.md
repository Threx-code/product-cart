## About the Project

Product-Cart APIs
This application requires PHP ^8.1

IF you have Docker follow the setup below, or clone the repository and run it the best way you could locally

## Installation RUN the commands below in the terminal (Docker is required)
- cd ~/path/to/the/directory/where/you/download/the/project
- cp .env.example .env
- Add the database configuration to the .env file
- composer install
- docker compose build
- docker compose ps -a (To see the list of containers started) 
- docker compose up -d
- docker exec -it productCart_php /bin/sh
- Run the migrations (php artisan migrate)
- Seed the database (php artisan db:seed)

## HOW to use the application
- To access the application base url .........http://0.0.0.0:8005

## USERS ENDPOINTS

- GET all users .........http://0.0.0.0:8005/api/v1/users
- GET a user replace the {userId} with actual user id ............ http://0.0.0.0:8005/api/v1/users/userId

## PRODUCT ENDPOINTS
- GET all product http://0.0.0.0:8005/api/v1/products/
- GET a single product replace with actual {productId} http://0.0.0.0:8005/api/v1/products/productId
- DELETE a product replace with actual {productId} http://0.0.0.0:8005/api/v1/products/10
- POST a product {
  "name":"Pioneer DJ Mixer2",
  "price":699
  } http://0.0.0.0:8005/api/v1/products/

## PRODUCT ENDPOINTS
- GET all products in carts http://0.0.0.0:8005/api/v1/carts
- GET all removed products from carts http://0.0.0.0:8005/api/v1/carts/removed
- GET All products in cart for a specific user replace with actual user id {userId} http://0.0.0.0:8005/api/v1/carts/userId
- GET ALL active products in a cart for a user replace with actual user id {userId} http://0.0.0.0:8005/api/v1/carts/active/userId
- GET ALL products removed in a cart for a user replace with actual user id {userId} http://0.0.0.0:8005/api/v1/carts/removed/3
- PUT remove a product from a cart for a user {
    "user_id" : 355555,
    "cart_id": 3
} http://0.0.0.0:8005/api/v1/carts/
- POST a product to cart {
    "user_id": 3,
    "product_id":55,
    "quantity": 4
} http://0.0.0.0:8005/api/v1/carts/
