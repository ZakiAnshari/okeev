@extends('layout.mobile.app')
@section('title', 'Detail')
@section('content')
    <style>
        :root {
            --primary-blue: #213A94;
            --dark-bg: #30445C;
            --light-green: #35F5C6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: white;
            min-height: 100vh;
            padding-top: 0px !important;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 16px;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
            padding: 8px;
            margin-right: 16px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .article-content {
            padding: 20px;
        }

        .article-title {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            line-height: 1.4;
            margin-bottom: 16px;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #666;
        }

        .author-link {
            color: var(--light-green);
            text-decoration: none;
            font-weight: 500;
        }

        .author-link:hover {
            text-decoration: underline;
        }

        .article-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .article-body {
            font-size: 15px;
            line-height: 1.8;
            color: #333;
        }

        .article-body p {
            margin-bottom: 16px;
        }

        .article-body h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-top: 24px;
            margin-bottom: 12px;
        }

        .article-body ul {
            /* margin-left: 20px; */
            margin-bottom: 16px;
        }

        .article-body li {
            margin-bottom: 8px;
        }

        .highlight-text {
            color: var(--light-green);
            font-weight: 600;
        }

        .link-text {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .link-text:hover {
            text-decoration: underline;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 200;
        }

        .bottom-nav-container {
            max-width: 480px;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
            /* padding: 12px 0; */
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #999;
        }

        .nav-item:hover {
            color: var(--light-green);
        }

        .nav-item.active {
            color: var(--light-green);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .nav-label {
            font-size: 11px;
        }

        .action-buttons {
            display: flex;
            gap: 16px;
        }

        .btn-action {
            width: 140px;
            height: 48px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-action:hover {
            background-color: #e0e0e0;
        }

        .btn-action:active {
            transform: scale(0.97);
        }

        .btn-action i {
            font-size: 22px;
            color: #9e9e9e;
        }

        .header {
            height: 56px;
            /* tinggi header */
        }

        .absolute-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-weight: 600;
        }
    </style>
    <div class="container">
        <div class="header">
            <a href="{{ route('newss.show') }}" class="back-btn">←</a>

            <div class="header-title absolute-center">Detail News</div>
        </div>

        <div class="article-content">
            <h1 class="article-title">2026 Rivian R1T Quad Motor Is the Quickest Truck We've Tested</h1>
            <div class="article-meta">
                <span>By <a href="#" class="author-link">Mike Sutton</a></span>
                <span>•</span>
                <span>Published: Nov 28, 2025</span>
            </div>
            <div class="action-buttons mb-3">
                <button class="btn-action">
                    <i class="bx bx-like"></i>
                </button>

                <button class="btn-action">
                    <i class="bx bx-share-alt"></i>
                </button>
            </div>






            <img src="{{ asset('front_end/assets/images/logo/mobile/blue-crossover-autumn-bend-car-motion 1.jpg') }}"
                alt="Rivian R1T" class="article-image">

            <div class="article-body">
                <ul class="news-list">
                    <li>
                        Rivian's updated R1T model is not only intensely quick for a pickup but was also quicker than the
                        <span class="highlight-text">60 mph in only 2.6 seconds</span> and covers the quarter-mile in 11.2
                        seconds
                        at 117 mph.
                    </li>

                    <li>
                        While the <a href="#" class="link-text">Tesla Cybertruck Beast</a> matches the Rivian's
                        zero-to-60-mph time,
                        the R1T bested it around our test track at 1:06.5, about three-tenths behind by 100 mph.
                    </li>

                    <li>
                        The quad-motor electric pickup we've tested, a
                        <a href="#" class="link-text">2024 Ford F-150 Lightning</a>,
                        needs a comparatively tepid 4.0 seconds to hit 60.
                    </li>
                </ul>


                <h3>Performance Highlights</h3>
                <p>Welcome to Car and Driver's <a href="#" class="link-text">Testing Hub</a>, where we've been
                    chronicling vehicle performance since 1956 to provide objective data to inform your purchase decisions.
                    During a recent spate of vehicle launches, some exotic cars that otherwise fly under the radar now stand
                    out as they set new records for acceleration capability.</p>

                <p>Electric vehicles have redefined what we consider performance. The quad-motor R1T sets the benchmark
                    among electric trucks, posting standout numbers on both the drag strip and road course. The R1T does 60
                    mph in a scant around 60 mph times of the 700-plus-horsepower <a href="#" class="link-text">Ram
                        1500 TRX</a> is 3.7 seconds, the 702-hp <a href="#" class="link-text">Ford F-150 Raptor R</a>
                    does it in 3.6 seconds, and the 1012-hp <a href="#" class="link-text">GMC Hummer EV</a> requires
                    more 3 seconds.</p>

                <p>Yet even the pace seems quaint when stacked next to some of the seriously speedy wheel-drive quad-motor
                    R1T recently clobbering the stopwatch at our test track, hitting 60 mph in 2.6 seconds. It tied the <a
                        href="#" class="link-text">GMC Hummer EV</a>.</p>
            </div>
        </div>
    </div>
@endsection
