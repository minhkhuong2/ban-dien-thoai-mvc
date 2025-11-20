<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - <?php echo SITENAME; ?></title>

    <style>
        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --white-color: #fff;
            --border-color: #ddd;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        body.auth-page {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f7f6;
            /* Nền xám nhạt */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px 0;
            box-sizing: border-box;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            box-sizing: border-box;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-logo h2 {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            font-family: 'Arial', sans-serif;
            /* (Bạn có thể đổi font logo) */
        }

        .auth-card {
            background: var(--white-color);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            border: 1px solid #e0e0e0;
        }

        .auth-card h3 {
            text-align: center;
            font-size: 1.8rem;
            margin: 0 0 10px 0;
            color: var(--dark-color);
        }

        .auth-card .subtext {
            text-align: center;
            margin-bottom: 25px;
            color: #555;
            font-size: 0.95rem;
        }

        .auth-card .subtext a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .error-text {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .form-options a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            color: var(--white-color);
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .divider {
            text-align: center;
            color: #aaa;
            margin: 20px 0;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .social-logins {
            display: flex;
            gap: 15px;
        }

        .social-btn {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.3s;
        }

        .social-btn:hover {
            background: #f9f9f9;
        }

        .terms {
            text-align: center;
            font-size: 0.8rem;
            color: #777;
            margin-top: 30px;
            padding: 0 10px;
            line-height: 1.5;
        }

        .terms a {
            color: #555;
            text-decoration: underline;
        }
    </style>
</head>

<body class="auth-page">
    <div class="auth-container">
        <div class="auth-logo">
            <h2>PhoneStore</h2>
        </div>
        <div class="auth-card">
