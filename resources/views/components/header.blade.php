<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('assets/css/alternate.css') }}" rel="stylesheet" />

        
    </head>
    <body class="antialiased">
        <header>
                <div class="logo-main">
                    <div class="hamburger">
                        <span class="icon"></span>
                    </div>
                    <div class="logo">
                        <span>Стройка.com</span>
                    </div>
                    <div class="search">
                        <input type="text" placeholder="Поиск по сайту....">
                    </div>
                </div>
                <nav class="menu">
                    <ul>
                        <li>
                            <a href="#">Вход / Регистрация</a>
                        </li>
                    </ul>
                </nav>
        </header>