
# Learn Via Book

Learn Via Book use packt api to fetch data.


## Requirement

**REQ:** PHP 8.1+ ,  Laravel 9+ , Node 16+

## Installation

Download file or clone repo and run below  command

```bash
composer install
```
To generate vite js and css 
```base
npm install && npm run dev
```
For Migration
```base
php artisan migrate
```
Queue Worker to fetch data from api in backend
```base
php artisan queue:work
```

it has cache that store api response from 1 day can be manipulated 


## Required Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`PACKT_TOKEN`

