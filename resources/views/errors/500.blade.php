<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>500 - Server Error</title>
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
            color: #e67e22;
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
            background: #e67e22;
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
            background: #d35400;
            color: #fff;
            text-decoration: none;
        }

        .btn-retry {
            display: inline-block;
            background: #fff;
            color: #e67e22;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border: 1.5px solid #e67e22;
            transition: all 0.2s;
            margin: 4px;
            cursor: pointer;
        }

        .btn-retry:hover {
            background: #e67e22;
            color: #fff;
            text-decoration: none;
        }

        .divider {
            width: 50px;
            height: 3px;
            background: #e67e22;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-code">5<span>0</span>0</div>
        <div class="error-icon">⚙️</div>
        <div class="divider"></div>
        <h1 class="error-title">Server Error</h1>
        <p class="error-message">
            Oops! Something went wrong on our end.
            We're working to fix it. Please try again in a few moments.
        </p>
        <a href="{{ url('/') }}" class="btn-home">Go to Home</a>
        <a href="javascript:location.reload()" class="btn-retry">Try Again</a>
    </div>
</body>
</html>
