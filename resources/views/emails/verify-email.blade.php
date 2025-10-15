<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تحقق من بريدك الإلكتروني</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #000000;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px 20px;
            border-radius: 8px;
            border: 1px solid #cccccc;
        }

        h1 {
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 12px 20px;
            border: 1px dashed #000000;
            border-radius: 6px;
            width: max-content;
            margin: 20px auto;
            letter-spacing: 2px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #555555;
            border-top: 1px solid #cccccc;
            padding-top: 15px;
        }

        a {
            color: #000000;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>التحقق من البريد الإلكتروني</h1>

        <p>مرحبًا {{ $user['email'] }},</p>

        <p>شكرًا لتسجيلك. يرجى استخدام رمز التحقق أدناه لإكمال التسجيل:</p>

        <div class="code">{{ $code }}</div>

        <p>هذا الرمز صالح لفترة محدودة. إذا لم تطلب هذا، يرجى تجاهل هذه الرسالة.</p>

        <div class="footer">
            <p>إذا كنت بحاجة إلى مساعدة، يرجى الاتصال بفريق الدعم لدينا.</p>
            <p>&copy; 2025 <a href="https://aqaviatech.com/">AqaviaTech</a>. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>

</html>
