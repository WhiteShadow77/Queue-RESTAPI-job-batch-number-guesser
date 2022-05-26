# Queue-RESTAPI-job-chaning-number-guesser-several-times
Web application tries to guess a number using a chain of jobs in a queue many times by genereting a random number. It equals a genereted number and a number has configured. If number is not guessed the job returns to queue once again and it will be continued for a number of tries has configured.
App uses RESTAPI to: direct it, input parameters, get result info, get log info.
(Used docker configuration info from user 'sagar290', thanks to him).

## Endpoints:
* GET http://localhost:80/api/app/start  
  Starts app with the default settings (from .env). Can receive paramaters(all or their combinations):
    * chain=x, x is number of chain's links
    * tries=x, x is number of tries in all the chain's links
    * guess_number=x, x is number app will try to guess in all the chain's links
    * range[start]=x&range[end]=y, x and y is numbers describes start of the range and end respectively

* GET http://localhost:80/api/app/logs
  Outputs history of trying guess process. Can receive a parameter:
    * transaction=x, where x is number of transaction you want to see.

* GET http://localhost:80/api/total
  Outputs result of the guessing process paramters that has used, time of start, end and time was spend.

* GET http://localhost:80/api/result
  Outputs simple guessing process.

* GET http://localhost:80/api/app/logs/clear
  Clear all the logs
```
Default settings:  
    Chain legth = 2
    Tries = 100
    Guess number = 50
    Range start = 0
    Range end = 100
```
#Possible start instructions:
## Up the services
```
docker-compose up --build -d
```

## Go to the container
```
docker exec -it queue-restapi-job-chaning-number-guesser-several-times-app-1 bash
```

## Run inside the container
```
php artisan migrate  
cp .env.example .env
```

## HTTP requests to direct the app or them combinations:
* Start guessing a number which has configured by default with the others default configurations
```
GET http://localhost:80/api/start
Accept: application/json

###
```

* Start guessing a number and chain's links number
```
GET http://localhost:80/api/start?guess_number=32&chain=5
Accept: application/json

###
```

* Start guessing a number and trial number's range
  from request
```
GET http://localhost:80/api/start?range[start]=0&range[end]=200
Accept: application/json

###
```

* Start guessing a number and trial number's range
```
GET http://localhost:80/api/start?guess_number=32&range[start]=0&range[end]=200
Accept: application/json

###
```

* Start guessing a number with tries, range
```
GET http://localhost:80/api/start?tries=100&guess_number=32&range[start]=0&range[end]=200
Accept: application/json

###
```

* View the logs of all transactions
```
GET http://localhost:80/api/logs
Accept: application/json

###
```

* View the logs of tries for transaction 1652350657
```
GET http://localhost:80/api/logs?transaction=1652350657
Accept: application/json

###
```

* View the totals all transaction
```
GET http://localhost:80/app/total
Accept: application/json

###
```

* View the simple result
```
GET http://localhost:80/api/result
Accept: application/json

###
```

* Clear all the logs
```
GET http://localhost:80/api/logs/clear
Accept: application/json

###
```

## Down services if you are exit
```
docker-compose down
```

## Some demostration:
```
GET http://localhost:80/api/start?jobs=4&tries=10&guess_number=5&range%5Bstart%5D=0&range%5Bend%5D=10

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Thu, 26 May 2022 09:10:27 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=LBsEspiOI33n0GXTyosCAuK806CVGAbVB4kaGhhf; expires=Thu, 26-May-2022 11:10:27 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Started,  Args: tries = 10 guessNumber = 5 start = 0 end = 10 jobs = 4 backoff = 0

Response code: 200 (OK); Time: 503ms; Content length: 82 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/progress

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Thu, 26 May 2022 08:43:48 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=LBsEspiOI33n0GXTyosCAuK806CVGAbVB4kaGhhf; expires=Thu, 26-May-2022 10:43:48 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 6,
    "batch_id": "9663d067-4c62-4dfd-b89c-dfa5fd749aac",
    "progress": 67,
    "jobs": 3,
    "successed": 2,
    "failed": 1,
    "status": "finished"
  },
  {
    "id": 7,
    "batch_id": "9663d117-6ce2-4f8f-9988-855670688300",
    "progress": 25,
    "jobs": 4,
    "successed": 1,
    "failed": 0,
    "status": "not finished"
  }
]

Response code: 200 (OK); Time: 323ms; Content length: 257 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies

```

```
GET http://localhost:80/api/progress

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Thu, 26 May 2022 09:43:06 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=LBsEspiOI33n0GXTyosCAuK806CVGAbVB4kaGhhf; expires=Thu, 26-May-2022 11:43:06 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 5,
    "batch_id": "9663e3dd-6f68-458e-8aee-f0e1c64539ee",
    "progress": 60,
    "jobs": 10,
    "successed": 6,
    "failed": 4,
    "status": "not finished"
  }
]

Response code: 200 (OK); Time: 474ms; Content length: 133 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies

```
