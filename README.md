<ol>
<li>git clone https://github.com/dirtyzen/library-app</li>
<li>cd library-app</li>
<li>composer update</li>
<li>
<p>open ".env", update database infos</p>
<p>
DB_DATABASE=<br />
DB_USERNAME=<br />
DB_PASSWORD=
</p>
</li>
<li>php artisan migrate:refresh --seed</li>
<li>php artisan serve</li>
</ol>

<p>P.S.: Each test user's password is "<i>password</i>".</p>
