@extends('layout.mobile.app')
@section('title', 'Contact')
@section('content')

    <style>
        body {
            padding-top: 64px;
            /* ⬅️ sesuaikan dengan tinggi header */
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 64px;
            display: flex;
            align-items: center;
            background-color: #fff;
            z-index: 999;
            border-bottom: 1px solid #eee;
            border-radius: 0 0 16px 16px;

            /* Transisi halus */
            transition: box-shadow 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
        }

        /* Aktif saat scroll */
        .header.header-scrolled {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }


        .header-container {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 16px;
            position: relative;
        }

        .back-btn-img {
            display: flex;
            align-items: center;
            z-index: 2;
        }

        .back-icon {
            width: 22px;
            height: auto;
        }

        .header-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: 600;
            color: #30445C;
            white-space: nowrap;
        }
    </style>


    <div class="header ">
        <div class="container header-container">
            <a href="{{ route('profilm.show') }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="header-title">Contact OKEEV</div>
        </div>
    </div>


    <div class="container">
        <div class="content pt-5">
            <p class="description">
                Lorem ipsum dolor sit amet consectetur. Id condimentum mauris et elit sagittis senectus feugiat. Congue erat
                sem
                tincidunt nulla sed mattis. Velit at gravida sit.
            </p>

            <!-- Contact Information -->
            <div class="contact-item mb-3">
                <img src="{{ asset('front_end/assets/images/logo/mobile/material-symbols_mail.jpg') }}" alt="Email"
                    class=" contact-icon-img">
                <span class="contact-text mx-2">okeev2025@gmail.com</span>
            </div>

            <div class="contact-item">
                <img src="{{ asset('front_end/assets/images/logo/mobile/ic_baseline-phone.jpg') }}" alt="Phone"
                    class=" contact-icon-img">
                <span class="contact-text mx-2">+62 5889 9546 253</span>
            </div>


            <div class="strip-divider"></div>
            <!-- Follow Us Section -->
            <div class="follow-section">
                <h3 class="contact-text">Follow Us:</h3>

                <div class="contact-item mb-3 pt-3">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/formkit_instagram.jpg') }}" alt="Email"
                        class="  contact-icon-img">
                    <span class="contact-text mx-2">okeev.ig</span>
                </div>
                <div class="contact-item mb-3">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/lineicons_tiktok-alt.jpg') }}" alt="Email"
                        class="  contact-icon-img">
                    <span class="contact-text mx-2">okeev.tiktok</span>
                </div>
                <div class="contact-item mb-3">
                    <img src="{{ asset('front_end/assets/images/logo/mobile/Frame 984.jpg') }}" alt="Email"
                        class="  contact-icon-img">
                    <span class="contact-text mx-2">okeev.x</span>
                </div>

            </div>
        </div>
    </div>

    <section class="okeev-contact-section">
        <div class="container">
            <div class="okeev-contact-wrapper">
                <div class="okeev-contact-card">
                    <form onsubmit="handleSubmit(event)">

                        <div class="okeev-contact-group">
                            <label class="okeev-contact-label">Name</label>
                            <input type="text" class="okeev-contact-input" placeholder="Enter your name" required>
                        </div>

                        <div class="okeev-contact-group">
                            <label class="okeev-contact-label">Email</label>
                            <input type="email" class="okeev-contact-input" placeholder="Enter your email" required>
                        </div>

                        <div class="okeev-contact-group">
                            <label class="okeev-contact-label">Phone</label>
                            <input type="tel" class="okeev-contact-input" placeholder="+62" required>
                        </div>

                        <div class="okeev-contact-group">
                            <label class="okeev-contact-label">Subject</label>
                            <input type="text" class="okeev-contact-input" placeholder="Ex: Career" required>
                        </div>

                        <div class="okeev-contact-group">
                            <label class="okeev-contact-label">Message</label>
                            <textarea class="okeev-contact-textarea" placeholder="Type your message here..." required></textarea>
                        </div>

                        <button type="submit" class="okeev-contact-submit">
                            Send message
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="okeev-map-section" id="okeevMapSection">
        <div class="container">
            <h3 class="okeev-map-title">Our Location</h3>

            <div class="okeev-map-wrapper">
                <iframe id="okeevMapFrame" class="okeev-map-frame" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
                </iframe>
            </div>

            <a href="https://maps.app.goo.gl/Yuc4NHg73CT64dx77" target="_blank" class="btn btn-dark mt-3 w-100">
                Open in Google Maps
            </a>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mapSection = document.getElementById("okeevMapSection");
            const mapFrame = document.getElementById("okeevMapFrame");

            const mapSrc =
                "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.795147842792!2d100.3749!3d-0.2965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd5291d3f6d4b45%3A0x8b2c6d3f6f2c8c1a!2sOKEEV!5e0!3m2!1sen!2sid";

            let mapLoaded = false;

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !mapLoaded) {
                        mapFrame.src = mapSrc;
                        mapLoaded = true;
                        observer.disconnect();
                    }
                });
            }, {
                threshold: 0.3
            });

            observer.observe(mapSection);
        });
    </script>





@endsection
