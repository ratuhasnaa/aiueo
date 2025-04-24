    <!DOCTYPE html>
    <html>
    <head>
        <title>{{ $details['subject'] }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f9f9;
            }
            .email-container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 20px;
                border: 1px solid #ddd;
            }

            .email-body {
                font-size: 14px;
                line-height: 1.6;
            }
            .email-body h3 {
                margin-bottom: 10px;
            }
            .email-table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            .email-table th, .email-table td {
                padding: 10px;
                border: 1px solid #ddd;
            }
            .email-table th {
                background-color: #f4f4f4;
                text-align: left;
            }
            .email-footer {
                margin-top: 20px;
                text-align: center;
                font-size: 12px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
        

            <!-- Body -->
            <div class="email-body">
                <p>{{ $details['greeting'] }}</p>
                <p>{{ $details['introduction'] }}</p>

                <h3>Your Booking Details</h3>
                <table class="email-table">
                    @foreach ($details['booking_details'] as $key => $value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td><strong>{{ $value }}</strong></td>
                    </tr>
                    @endforeach
                </table>

                <p>{{ $details['closing'] }}</p>
                <p><strong>{{ $details['hotel_name'] }}</strong></p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>&copy; {{ date('Y') }} {{ $details['hotel_name'] }}. AIUEO | All Rights Reserved.</p>
            </div>
        </div>
    </body>
    </html>
