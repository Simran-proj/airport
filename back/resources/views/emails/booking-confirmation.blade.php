<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation - Heathrow Air Park</title>
    <style>
        /* Reset & Base Styles */
        body {
            font-family: 'Arial', 'Helvetica Neue', Helvetica, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8f9ff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(78, 86, 192, 0.12);
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #4E56C0 0%, #9B5DE0 100%);
            color: white;
            padding: 50px 35px;
            text-align: center;
            position: relative;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: #ffffff;
            border-radius: 50% 50% 0 0;
        }
        
        .header h1 {
            margin: 0 0 20px 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header .badge {
            display: inline-block;
            background: linear-gradient(135deg, #FDCFFA 0%, #D78FEE 100%);
            color: #4E56C0;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(155, 93, 224, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .reference-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 20px 30px;
            display: inline-block;
            margin-top: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Content */
        .content {
            padding: 45px 40px;
            position: relative;
            top: -20px;
        }
        
        .greeting {
            margin-bottom: 35px;
        }
        
        .greeting h2 {
            color: #4E56C0;
            margin: 0 0 15px 0;
            font-size: 26px;
            font-weight: 600;
            background: linear-gradient(135deg, #4E56C0, #9B5DE0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .greeting p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }
        
        /* Info Cards */
        .info-card {
            background: #ffffff;
            border: 2px solid #F0F2FF;
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 28px;
            box-shadow: 0 4px 20px rgba(78, 86, 192, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, #4E56C0, #9B5DE0);
            border-radius: 6px 0 0 6px;
        }
        
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(78, 86, 192, 0.15);
            border-color: #D78FEE;
        }
        
        .info-card h3 {
            color: #4E56C0;
            margin: 0 0 25px 0;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-left: 15px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #F0F2FF;
            transition: all 0.2s ease;
        }
        
        .detail-row:hover {
            background: #FCFAFF;
            border-radius: 8px;
            padding: 14px 12px;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #666;
            font-weight: 500;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .detail-label::before {
            content: '•';
            color: #9B5DE0;
            font-size: 20px;
        }
        
        .detail-value {
            color: #4E56C0;
            font-weight: 700;
            font-size: 16px;
            text-align: right;
        }
        
        /* Price Box */
        .price-card {
            background: linear-gradient(135deg, #FDCFFA 0%, #D78FEE 100%);
            border: none;
            border-radius: 16px;
            padding: 35px 30px;
            text-align: center;
            margin: 35px 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(215, 143, 238, 0.3);
        }
        
        .price-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        .price-amount {
            font-size: 48px;
            font-weight: 800;
            color: #4E56C0;
            margin: 15px 0;
            line-height: 1;
            text-shadow: 0 2px 4px rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 1;
        }
        
        .price-label {
            color: #9B5DE0;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }
        
        /* Instructions */
        .instructions {
            background: linear-gradient(135deg, rgba(253, 207, 250, 0.15) 0%, rgba(215, 143, 238, 0.15) 100%);
            border-left: 6px solid #9B5DE0;
            padding: 25px 30px;
            margin: 35px 0;
            border-radius: 0 12px 12px 0;
            position: relative;
            overflow: hidden;
        }
        
        .instructions::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(155, 93, 224, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .instructions h3 {
            color: #4E56C0;
            margin: 0 0 20px 0;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
        }
        
        .instructions ul {
            margin: 0;
            padding-left: 20px;
            position: relative;
            z-index: 1;
        }
        
        .instructions li {
            color: #555;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.5;
            padding-left: 8px;
        }
        
        .instructions li::marker {
            color: #9B5DE0;
            font-size: 1.2em;
        }
        
        /* Contact Info */
        .contact-info {
            background: linear-gradient(135deg, rgba(78, 86, 192, 0.05) 0%, rgba(155, 93, 224, 0.05) 100%);
            border: 2px solid rgba(78, 86, 192, 0.1);
            border-radius: 16px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
        }
        
        .contact-info h3 {
            color: #4E56C0;
            margin: 0 0 25px 0;
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #4E56C0, #9B5DE0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .contact-details {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(78, 86, 192, 0.1);
            transition: all 0.3s ease;
            min-width: 140px;
        }
        
        .contact-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(78, 86, 192, 0.15);
            background: linear-gradient(135deg, #F8F9FF 0%, #F0F2FF 100%);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4E56C0, #9B5DE0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            box-shadow: 0 4px 10px rgba(78, 86, 192, 0.3);
        }
        
        .contact-text {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }
        
        .contact-link {
            color: #4E56C0;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.2s ease;
        }
        
        .contact-link:hover {
            color: #9B5DE0;
            text-decoration: underline;
        }
        
        /* Closing Section */
        .closing-section {
            text-align: center;
            margin-top: 45px;
            padding: 30px;
            background: linear-gradient(135deg, rgba(253, 207, 250, 0.1) 0%, rgba(215, 143, 238, 0.1) 100%);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(78, 86, 192, 0.1);
        }
        
        .closing-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(155, 93, 224, 0.05) 0%, transparent 70%);
        }
        
        .closing-section p:first-child {
            margin: 0;
            color: #4E56C0;
            font-size: 20px;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        .closing-section p:last-child {
            margin: 15px 0 0 0;
            color: #9B5DE0;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #4E56C0 0%, #9B5DE0 100%);
            color: rgba(255, 255, 255, 0.9);
            padding: 40px 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,100 L100,0 L100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }
        
        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }
        
        .footer-info {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 25px;
            font-size: 13px;
            position: relative;
            z-index: 1;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s ease;
            padding: 5px 10px;
            border-radius: 6px;
        }
        
        .footer-links a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .copyright {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 25px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .content {
                padding: 35px 25px;
            }
            
            .header {
                padding: 40px 25px;
            }
            
            .header h1 {
                font-size: 28px;
            }
            
            .price-amount {
                font-size: 42px;
            }
            
            .contact-details {
                flex-direction: column;
                gap: 20px;
            }
            
            .contact-item {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
                padding: 12px 0;
            }
            
            .detail-value {
                text-align: left;
                padding-left: 20px;
            }
            
            .footer-links {
                flex-wrap: wrap;
                gap: 15px;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .info-card, .price-card, .instructions, .contact-info {
            animation: fadeIn 0.6s ease-out;
        }
        
        .price-card {
            animation-delay: 0.2s;
        }
        
        .instructions {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="badge">BOOKING CONFIRMED</div>
            <h1>Your Reservation is Ready</h1>
            <div class="reference-box">
                <span style="font-size: 16px; opacity: 0.9; font-weight: 500;">Booking Reference:</span>
                <span style="font-size: 28px; font-weight: 800; letter-spacing: 1px; margin-left: 10px;">#{{ $reserva->numero_reserva }}</span>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                <h2>Dear {{ $reserva->cliente->nombre }},</h2>
                <p>Thank you for choosing Heathrow Air Park for your airport parking. Your booking has been successfully processed and confirmed. Below are all the details of your reservation.</p>
            </div>
            
            <!-- Booking Details Card -->
            <div class="info-card">
                <h3>Booking Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Booking Reference</span>
                    <span class="detail-value">#{{ $reserva->numero_reserva }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Booking Status</span>
                    <span class="detail-value" style="background: linear-gradient(135deg, #FDCFFA, #D78FEE); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; padding: 4px 12px; border-radius: 20px; font-weight: 700;">{{ ucfirst($reserva->estado) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Service Type</span>
                    <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $reserva->service_type)) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Booking Date</span>
                    <span class="detail-value">{{ date('F j, Y', strtotime($reserva->created_at)) }}</span>
                </div>
            </div>
            
            <!-- Travel Details Card -->
            <div class="info-card">
                <h3>Travel Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Drop-off Date & Time</span>
                    <span class="detail-value">{{ date('l, F j, Y', strtotime($reserva->fecha_hora_llegada)) }} at {{ date('g:i A', strtotime($reserva->fecha_hora_llegada)) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Pick-up Date & Time</span>
                    <span class="detail-value">{{ date('l, F j, Y', strtotime($reserva->fecha_hora_recogida)) }} at {{ date('g:i A', strtotime($reserva->fecha_hora_recogida)) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Terminal</span>
                    <span class="detail-value">Terminal {{ $reserva->terminal }}</span>
                </div>
                @if($reserva->vuelo)
                <div class="detail-row">
                    <span class="detail-label">Flight Number</span>
                    <span class="detail-value">{{ $reserva->vuelo }}</span>
                </div>
                @endif
            </div>
            
            <!-- Price Summary -->
            <div class="price-card">
                <div class="price-label">TOTAL AMOUNT CONFIRMED</div>
                <div class="price-amount">£{{ number_format($reserva->precio, 2) }}</div>
                <div class="price-label">Payment Secured • 24/7 Support • Fully Insured</div>
            </div>
            
            <!-- Important Instructions -->
            <div class="instructions">
                <h3>📍 Important Information & Instructions</h3>
                <ul>
                    <li>Please have your booking reference <strong style="color: #4E56C0;">#{{ $reserva->numero_reserva }}</strong> ready when you arrive</li>
                    <li>Arrive at the specified drop-off time to ensure smooth service</li>
                    <li>Meet our driver at the <strong style="color: #4E56C0;">Terminal {{ $reserva->terminal }} Short Stay car park</strong></li>
                    <li>Keep this email for your records - you may need it for reference</li>
                    <li>For any changes, please contact us at least 24 hours in advance</li>
                </ul>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info">
                <h3>Need Assistance? We're Here to Help</h3>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-text">24/7 Customer Support</div>
                        <a href="tel:02039257797" class="contact-link">0203 925 7797</a>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-text">Email Support</div>
                        <a href="mailto:bookings@heathrow-airpark.com" class="contact-link">bookings@heathrow-airpark.com</a>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div class="contact-text">Visit Our Website</div>
                        <a href="https://heathrow-airpark.com" class="contact-link">heathrow-airpark.com</a>
                    </div>
                </div>
            </div>
            
            <!-- Closing -->
            <div class="closing-section">
                <p>We look forward to serving you at Heathrow Airport!</p>
                <p>Safe travels from the Heathrow Air Park team</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">HEATHROW AIR PARK</div>
            <div class="footer-info">
                Premier Meet & Greet Parking Services at Heathrow Airport<br>
                Dedicated to providing exceptional customer service and convenience
            </div>
            <div class="footer-links">
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact Us</a>
                <a href="#">FAQ</a>
            </div>
            <div class="copyright">
                © {{ date('Y') }} Heathrow Air Park Ltd. All rights reserved.<br>
                Company Number: 12345678 • VAT Number: GB123456789<br>
                <small>This is an automated email. Please do not reply directly to this message.</small>
            </div>
        </div>
    </div>
</body>
</html>