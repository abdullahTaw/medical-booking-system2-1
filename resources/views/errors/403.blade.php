<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>403 - Access Denied</title>
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
            color: #e74c3c;
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
            background: #e74c3c;
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
            background: #c0392b;
            color: #fff;
            text-decoration: none;
        }

        .btn-back {
            display: inline-block;
            background: #fff;
            color: #e74c3c;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border: 1.5px solid #e74c3c;
            transition: all 0.2s;
            margin: 4px;
        }

        .btn-back:hover {
            background: #e74c3c;
            color: #fff;
            text-decoration: none;
        }

        .divider {
            width: 50px;
            height: 3px;
            background: #e74c3c;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-code">4<span>0</span>3</div>
        <div class="error-icon">🚫</div>
        <div class="divider"></div>
        <h1 class="error-title">Access Denied</h1>
        <p class="error-message">
            Sorry, you don't have permission to access this page.
            Please contact the administrator if you think this is a mistake.
        </p>
        <a href="{{ url('/') }}" class="btn-home">Go to Home</a>
        <a href="javascript:history.back()" class="btn-back">Go Back</a>
    </div>
</body>
</html>
