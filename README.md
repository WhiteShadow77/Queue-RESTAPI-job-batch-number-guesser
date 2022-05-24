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
GET http://localhost:80/api/start

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 17 May 2022 09:30:59 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *

Started,  Args: tries = 100 guessNumber = 51 start = 0 end = 100 chainLength = 2

Response code: 200 (OK); Time: 321ms; Content length: 80 bytes


GET http://localhost:80/api/app/total

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Sat, 14 May 2022 07:50:07 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *

[
  {
    "transaction": 1652514523,
    "guess number": 50,
    "status": "OK",
    "used tries": 45,
    "params": {
      "backoff": 0,
      "tries": 100,
      "guessNumber": 50,
      "range": {
        "start": 0,
        "end": 100
      }
    },
    "start date": "2022-05-14 07:48:43",
    "end date": "2022-05-14 07:48:47",
    "completion time": "00:00:04"
  }
]

Response code: 200 (OK); Time: 356ms; Content length: 255 bytes

GET http://localhost:80/api/result

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 17 May 2022 08:36:39 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 55
Access-Control-Allow-Origin: *

[
  {
    "chain length": "5"
  },
  {
    "transaction": 1652776394,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776395,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776396,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776397,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776398,
    "guess number": 50,
    "status": "OK"
  },
  {
    "chain length": "5"
  },
  {
    "transaction": 1652776478,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776479,
    "guess number": 50,
    "status": "Failed"
  },
  "Aborted",
  "Aborted",
  "Aborted",
  {
    "chain length": "5"
  },
  {
    "transaction": 1652776525,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1652776526,
    "guess number": 50,
    "status": "Failed"
  },
  "Aborted",
  "Aborted",
  "Aborted",
  {
    "chain length": "2"
  },
  {
    "transaction": 1652776570,
    "guess number": 51,
    "status": "OK"
  },
  {
    "transaction": 1652776571,
    "guess number": 51,
    "status": "OK"
  },
  {
    "chain length": "5"
  },
  {
    "transaction": 1652776610,
    "guess number": 32,
    "status": "Failed"
  },
  "Aborted",
  "Aborted",
  "Aborted",
  "Aborted"
]

Response code: 200 (OK); Time: 259ms; Content length: 926 bytes

```
