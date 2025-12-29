@extends('layout.mobile.app')
@section('title', 'About')
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
            font-family: 'Oxanium', sans-serif;
            background-color: #fff;
            color: #333;
            padding-top: 0 !important;
        }

        /* Header */
        .header {
            background-color: #fff;
            padding: 16px;
            display: flex;
            align-items: center;
            /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
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
            margin-right: 16px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
        }

        /* Content */
        .content {
            padding-bottom: 40px;
        }

        /* Hero Section */
        .hero-section {
            width: 100%;
            padding: 20px;
        }

        .hero-image {
            width: 100%;
            max-width: 322px;
            height: auto;
            object-fit: cover;
            border-radius: 12px;
            margin: 0 auto 16px;
            display: block;
        }


        .okeev-badge {
            background: linear-gradient(135deg, var(--light-green) 0%, #00b894 100%);
            color: #30445C;
            padding: 3px 18px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .tagline {
            text-align: center;
            margin-bottom: 12px;
        }

        .tagline h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .tagline h3 {
            font-size: 16px;
            font-weight: 600;
        }

        .description {
            text-align: center;
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* BAGIAN ATAS  */

        .header {
            display: flex;
            align-items: center;
            padding: 16px;
            background-color: white;
            /* border-bottom: 1px solid #e0e0e0; */
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .back-btn {
            position: absolute;
            left: 16px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }









        .header {
            position: relative;
            height: 56px;
            display: flex;
            align-items: center;
        }

        .back-btn {
            position: absolute;
            left: 16px;
            font-size: 24px;
            text-decoration: none;
            color: #333;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 600;
        }
    </style>




    <div class="header">
        <a href="" class="back-btn">←</a>

        <div class="header-title">About OKEEV</div>
    </div>


    <div class="content">
        <!-- Hero Section -->
        <div class="hero-section">
            <img src="{{ asset('front_end/assets/images/logo/mobile/Group 1004.png') }}" alt="Electric vehicles"
                class="hero-image">

            <div style="text-align: center;margin-top: -30px;">
                <span class="okeev-badge">OKEEV</span>
            </div>

            <div class="tagline">
                <h2>Customer trust is the reason</h2>
                <h3>we continue to grow.</h3>
            </div>

            <p class="description">
                We are proud to be part of the journey of many customers who have found their dream vehicles & goods here.
            </p>
        </div>
    </div>

@endsection
