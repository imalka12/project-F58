<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />

    <style>
        @import url(https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&display=swap);

        body {
            font-family: Ubuntu, sans-serif;
            font-size: 18px;
        }

        #wrapper {
            width: 600px;
            margin: 0px auto;
            color: #333333;
            text-align: center;
            padding: 15px auto;
        }

        #wrapper #header {
            background: #5274d9;
            color: #fff;
        }

        #wrapper p {
            text-align: justify;
        }

        #wrapper h1 {
            font-size: 3em;
            padding: 15px;
        }

        #wrapper h4 {
            font-size: 1.75em;
        }

        #wrapper .link-block {
            margin: 3em;
        }

        #wrapper .link {
            color: #fff;
            width: 200px;
            background-color: #5274d9;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 2em;
        }

        #wrapper .email-link {
            background-color: #eee;
            padding: 15px;
            text-align: left;
            font-size: 16px;
            color: #5274d9;
        }

        #wrapper .email-link pre {
            font-size: small;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        #wrapper #footer {
            margin-top: 30px;
            padding: 5px;
            font-size: small;
        }

        #wrapper #footer p {
            text-align: center;
            line-height: 1.2em;
        }

        #wrapper .disclaimer {
            font-size: small;
        }

        @media(max-width: 480px) {
            #wrapper {
                width: 100%;
                font-size: 13px;
            }
        }

    </style>
</head>

<body>
    <div id="wrapper">
        @yield('disclaimer')
        <div id=" header">
            <h1>Quick Ads</h1>
        </div>
        <div id="contents">
            @yield('contents')
        </div>
        <div id="footer">
            <p>&copy; 2021 - Quick Ads</p>
            <p>
                <strong>Quick Ads Inc.</strong><br />Puttalam Road, Kurunegala, Sri Lanka.
            </p>
            <p>Telephone: +94371234578 / +94371234579</p>
            <p>Email: info@quickads.test</p>
            <p>
                This is an automatically generated email. Please do not respond to this
                email.
            </p>
        </div>
    </div>
</body>

</html>
