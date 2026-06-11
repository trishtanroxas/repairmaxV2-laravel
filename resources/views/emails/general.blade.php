<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $subject }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAFC;
            color: #212529;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .email-wrapper {
            width: 100%;
            background-color: #F8FAFC;
            padding: 40px 0;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #E9ECEF;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #212529;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .body {
            padding: 40px;
        }

        .body p {
            color: #495057;
            font-size: 16px;
            margin-bottom: 24px;
        }

        .footer {
            background-color: #F8F9FA;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #E9ECEF;
        }

        .footer p {
            color: #6C757D;
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <h1>Repairmax.</h1>
            </div>

            <div class="body">
                {!! nl2br(e($bodyContent)) !!}
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
