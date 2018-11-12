#package

composer.json
```json
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Matiww/Plugin.git"
        }
    ],
    "require": {
        "Matiww/Plugin": "dev-master"
    }
```

<ul>
<li>composer update</li>
<li>add db url to .env EXAMPLE - ITEMS_DB=http://localhost:8000/api/items</li>
<li>php artisan vendor:publish</li>
<li>php artisan serve or create vhost</li>
<li>http://client_url/items</li>
</ul>