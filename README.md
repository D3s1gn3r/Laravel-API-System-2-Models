<h2>Laravel API System</h2>

<h3>Main steps</h3>
<ul>
    <li>php artisan migrate:fresh</li>
    <li>php artisan serve (db required)</li>
</ul>

<h3>Two users available for testing (login required):</h3>

<h4>log:pass</h4>
<p>admin@admin.com:12345678</p>
<p>user@user.com:87654321</p>

<h3>Routes list</h3>

<ol>
    <li>
        <span>POST /user/token/create</span><br>
        <span>params:</span>
        <ul>
            <li>email</li>
            <li>password</li>
            <li>token_name (optional)</li>
        </ul>
    </li>
    <h3>Bearer token required starting from here</h3>
    <li>
        <span>GET /user/tokens/logout</span><br>
    </li>
    <h4>User Model</h4>
    <li>
        <span>GET /user/{?users:id}</span><br>
    </li>
    <li>
        <span>POST|PATCH /user{users:id}</span><br>
        <span>params:</span>
        <ul>
            <li>name</li>
            <li>email</li>
            <li>password</li>
        </ul>
    </li>
    <li>
        <span>DELETE /user/{users:id}</span><br>
    </li>
    <hr>
    <h4>Vehicle Model</h4>
    <li>
        <span>GET /vehicle/{?vehicles:id}</span><br>
    </li>
    <li>
        <span>POST|PATCH /vehicle{vehicles:id}</span><br>
        <span>params:</span>
        <ul>
            <li>name</li>
            <li>model</li>
            <li>vin</li>
        </ul>
    </li>
    <li>
        <span>DELETE /vehicle/{vehicles:id}</span><br>
    </li>
</ol>
