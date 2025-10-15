<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #000000;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px 20px;
            border: 1px solid #cccccc;
            border-radius: 6px;
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
            padding: 12px 18px;
            border: 1px dashed #000000;
            border-radius: 6px;
            width: fit-content;
            margin: 20px auto;
            letter-spacing: 2px;
        }

        .button {
            display: block;
            text-align: center;
            font-weight: bold;
            padding: 12px 20px;
            margin: 20px auto;
            text-decoration: none;
            border: 1px solid #000000;
            border-radius: 6px;
            color: #000000;
            width: fit-content;
        }

        .note {
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #555555;
            margin-top: 30px;
            border-top: 1px solid #cccccc;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>طلب إعادة تعيين كلمة المرور</h1>

        <p>مرحبًا،</p>
        <p>لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بك. يرجى استخدام رمز التحقق أدناه للمتابعة:</p>

        <div class="code">{{ $code }}</div>

        <a href="#" class="button">إعادة تعيين كلمة المرور</a>

        <p class="note"><strong>ملاحظة:</strong> هذا الرمز صالح لمدة ساعة واحدة فقط. إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد بأمان.</p>

        <div class="footer">
            <p>إذا كان لديك أي أسئلة، يرجى الاتصال بفريق الدعم لدينا.</p>
            <p>&copy; 2025 <a href="https://aqaviatech.com/">AqaviaTech</a>. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</body>

</html>
