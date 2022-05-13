### Link Shrinker


## GET Request

```
url: {domain}/api/top
[{
    "url": "http://jamaicaobserver.com/",
    "tries": 2,
    "title": "Front - Jamaica Observer"
},
{
    "url": "http://facebook.com/",
    "tries": 1,
    "title": "Facebook - log in or sign up"
},
...

]

```

## POST Request

Request

```
url: {domain}/api/shortn
{
  "url":"http://www.msnbc.com/"
}
```

Response

```
{
    "url": "http://www.msnbc.com/",
    "shrunk_url": "K36rH",
    "link": "http://localhost:8000/K36rH",
    "success": "Shorten Link Generated Successfully!"
}
```
    

### Laravel Quick Start

1. Download the latest source code.


2. Download and install `Node.js` from Nodejs. The suggested version to install is `14.16.x LTS`.


3. Start a command prompt window or terminal and change directory to [unpacked path]:


4. Install the latest `NPM`:
   
        npm install --global npm@latest


5. To install `Composer` globally, download the installer from https://getcomposer.org/download/ Verify that Composer in successfully installed, and version of installed Composer will appear:
   
        composer --version


6. Install `Composer` dependencies.
   
        composer install


7. Install `NPM` dependencies.
   
        npm install



9. Copy `.env.example` file and create duplicate. Use `cp` command for Linux or Max user.

        cp .env.example .env

    If you are using `Windows`, use `copy` instead of `cp`.
   
        copy .env.example .env
   

10. Create a table in MySQL database and fill the database details `DB_DATABASE` in `.env` file.


11. Update the details `QUEUE_CONNECTION` in `.env` file from `sync` to `database`.


12. The below command will create tables into database using Laravel migration and seeder.

        php artisan migrate:fresh --seed


13. Generate your application encryption key:

        php artisan key:generate


14. Start the localhost server:
    
        php artisan serve

15. Start the artisan queue (process jobs in the background):
    
        php artisan queue:work
