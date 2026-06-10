<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>419 - Session Expired</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}"/>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .error-box {
            text-align: center;
            max-width: 520px;
            width: 100%;
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: #e0e0e0;
            line-height: 1;
            letter-spacing: -4px;
        }

        .error-code span {
            color: #9b59b6;
        }

        .error-icon {
            font-size: 60px;
            margin: 10px 0;
        }

        .error-title {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
        }

        .error-message {
            font-size: 15px;
            color: #7f8c8d;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            background: #9b59b6;
            color: #fff;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background 0.2s;
            margin: 4px;
        }

        .btn-home:hover {
            background: #8e44ad;
            color: #fff;
            text-decoration: none;
        }

        .btn-back {
            display: inline-block;
            background: #fff;
            color: #9b59b6;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border: 1.5px solid #9b59b6;
            transition: all 0.2s;
            margin: 4px;
        }

        .btn-back:hover {
            background: #9b59b6;
            color: #fff;
            text-decoration: none;
        }

        .divider {
            width: 50px;
            height: 3px;
            background: #9b59b6;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-code">4<span>1</span>9</div>
        <div class="error-icon">⏰</div>
        <div class="divider"></div>
        <h1 class="error-title">Session Expired</h1>
        <p class="error-message">
            Your session has expired due to inactivity.
            Please go back and refresh the page to continue.
        </p>
        <a href="{{ url('/') }}" class="btn-home">Go to Home</a>
        <a href="javascript:history.back()" class="btn-back">Go Back</a>
    </div>
</body>
</html>
