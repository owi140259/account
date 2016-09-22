<!DOCTYPE html>
<html>
    <head>
        <title>Account</title>
        <link rel="stylesheet" href="/account/web/style/global.css">
    </head>
    <body>
        <div id="banner">
            ACCOUNT
        </div>
        <header class="well">
            <div class="loggedin">
                <p>You are logged in as User</p>
            </div>
            <nav>
                <ul>
                    <li><a href="/account/web/settings">SETTINGS</a></li>
                    <li><a href="/account/web/friends">FRIENDS</a></li>
                </ul>
            </nav>
        </header>
        <main class="well">
            {% block content %}
            {% endblock %}
        </main>
    </body>
</html>