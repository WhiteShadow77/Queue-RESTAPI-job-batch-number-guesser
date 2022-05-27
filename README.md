## Queue-RESTAPI-batch-job-number-guesser-several-times
The application can help you feel how a batch of jobs in  queue works. Web app runs
a queue on server with a batch of jobs. Jobs are trying to guess a number by equaling
a generated randomly number with a number had input. Data to manage a batch has 
stored in config or can be inputed through a request, there is used RESTAPI. Executing
of the batch does not stop if some job has failed, it continues. App  are able to 
output information by the request about the executing process or cancel the executing.
Having a batch's id user are able to rerun the batch using artisan commands.

## Endpoints:
* GET http://localhost:80/api/start  
  Starts app with the default settings (from .env). Can receive paramaters(all or their combinations):
    * jobs=x, x is number of jobs in the batch
    * tries=x, x is number of tries for all the jobs
    * guess_number=x, x is number app will try to guess in all the jobs
    * range[start]=x&range[end]=y, x and y is numbers describes start of the range and end respectively
    * backoff=x, x is time in seconds which queue waits between the jobs.

* GET http://localhost:80/api/logs
  Outputs history of trying guess process. Can receive a parameter:
    * transaction=x, where x is number of transaction you want to see.

* GET http://localhost:80/api/progress
  Output the current information about the executing process: batch's id, succeeded, failed jobs, common progress level.

* GET http://localhost:80/api/logs/clear
  Clear all the logs
  
* GET http://localhost:80/api/cancel
  Cancels the executing.
```
Default settings:  
    Jobs = 2
    Tries = 100
    Guess number = 50
    Range start = 0
    Range end = 100
    Backoff = 0
```
#Possible start instructions:
## Up the services
```
docker-compose up --build -d
```

## Go to the container
```
docker exec -it queue-restapi-job-batch-number-guesser-app-1 bash
```

## Run inside the container
```
php artisan migrate  
cp .env.example .env
```

## Down services if you are exit
```
docker-compose down
```

## Some demostration:
```
GET http://localhost:80/api/start?jobs=200&tries=10&guess_number=5&range%5Bstart%5D=0&range%5Bend%5D=10

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Fri, 27 May 2022 14:45:24 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:45:24 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Started,  Args: tries = 10 guessNumber = 5 start = 0 end = 10 jobs = 200 backoff = 0

Response code: 200 (OK); Time: 1477ms; Content length: 84 bytes

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
Date: Fri, 27 May 2022 14:43:59 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:43:59 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 3,
    "batch_id": "96665558-91e9-46aa-bacd-b236314fac8c",
    "progress": 14,
    "jobs": 200,
    "successed": 28,
    "failed": 0,
    "status": "in process"
  }
]

Response code: 200 (OK); Time: 385ms; Content length: 133 bytes

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
Date: Fri, 27 May 2022 14:44:46 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:44:46 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 3,
    "batch_id": "96665558-91e9-46aa-bacd-b236314fac8c",
    "progress": 61,
    "jobs": 200,
    "successed": 121,
    "failed": 79,
    "status": [
      "Failed",
      "Batch finished"
    ]
  }
]

Response code: 200 (OK); Time: 271ms; Content length: 150 bytes

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
Date: Fri, 27 May 2022 14:47:53 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:47:53 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 7,
    "batch_id": "966656bd-4f3c-4067-8ab0-b990ed376021",
    "progress": 100,
    "jobs": 2,
    "successed": 2,
    "failed": 0,
    "status": [
      "All OK",
      "Batch finished"
    ]
  }
]

Response code: 200 (OK); Time: 276ms; Content length: 146 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies
```

```
GET http://localhost:80/api/cancel

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Fri, 27 May 2022 14:51:21 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 55
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:51:21 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 10,
    "batch_id": "96665804-bd92-4cce-8d4b-f3086823462f",
    "progress": 4,
    "jobs": 200,
    "successed": 7,
    "failed": 0,
    "status": "canceled"
  }
]

Response code: 200 (OK); Time: 298ms; Content length: 130 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies

```

```
GET http://localhost:80/api/logs/clear

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Fri, 27 May 2022 14:52:13 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=6S7oVQkt7Wn845ynIUq94LKfebzAypbQZmTHSPmE; expires=Fri, 27-May-2022 16:52:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Cleared

Response code: 200 (OK); Time: 326ms; Content length: 7 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-job-batch-number-guesser\.idea\httpRequests\http-client.cookies

```


