@extends('layouts.alternative')

@section('canonical', '')

@section('additional_head')
@endsection

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 6rem;
            margin: 0;
            color: #333;
        }
        p {
            font-size: 1.5rem;
            color: #666;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .lang {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! Page not found.</p>
        <p>The page you're looking for doesn't exist or has been moved.</p>
        <p><a href="/">Go back to homepage</a></p>

        <div class="lang">
            <h2>404</h2>
            <p>Упс! Страница не найдена.</p>
            <p>Что то пошло не так или ссылка по которой вы перешли больше не существует.</p>
            <p><a href="/">Вернуться на главную страницу</a></p>
        </div>

        <div class="lang">
            <h2>404</h2>
            <p>عفوا! الصفحة غير موجودة.</p>
            <p>الصفحة التي تبحث عنها غير موجودة أو تم نقلها.</p>
            <p><a href="/">العودة إلى الصفحة الرئيسية</a></p>
        </div>
    </div>
</body>
</html>