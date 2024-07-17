<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Appointment Summary Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            max-width: 800px;
            /* Limit width for better readability */
            margin: 0 auto;
            /* Center align */
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            /* Bottom border for separation */
        }

        .logo {
            width: 100px;
            /* Adjust size as needed */
            height: auto;
            margin-right: 20px;
            /* Space between logo and clinic info */
        }

        .clinic-info {
            flex: 1;
            /* Take remaining space */
        }

        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            /* Darker color for clinic name */
        }

        .clinic-address {
            font-size: 14px;
            color: #666;
            /* Lighter color for address */
            margin-bottom: 5px;
        }

        .clinic-contact {
            font-size: 14px;
            color: #666;
            /* Lighter color for contact info */
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .report-info {
            text-align: center;
            font-size: 18px;
            color: #666;
            /* Slightly darker color for report info */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            /* White background for table */
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #555;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/icons/new-icons/logo.png'))) }}"
            class="logo" alt="Logo" />
        <div class="clinic-info">
            <div class="clinic-name">Hatton Consultation Centre</div>
            <div class="clinic-address">No.271, Colombo Road, Dimbulla Rd, Hatton</div>
            <div class="clinic-contact">Phone: 0512 223 218</div>
        </div>
    </div>

    <h1>Apoitment Summary Report</h1>
    <p class="report-info">From: {{ $startDate->format('Y-m-d') }} To: {{ $endDate->format('Y-m-d') }}</p>

    <h5 class="mt-4">Daily Appointments</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Total Appointments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dailySummary as $date => $doctors)
                @foreach ($doctors as $doctor => $count)
                    <tr>
                        <td>{{ $doctor }}</td>
                        <td>{{ $date }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <h5 class="mt-4">Weekly Appointments</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Week</th>
                <th>Total Appointments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weeklySummary as $week => $doctors)
                @foreach ($doctors as $doctor => $count)
                    <tr>
                        <td>{{ $doctor }}</td>
                        <td>{{ $week }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <h5 class="mt-4">Monthly Appointments</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Month</th>
                <th>Total Appointments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlySummary as $month => $doctors)
                @foreach ($doctors as $doctor => $count)
                    <tr>
                        <td>{{ $doctor }}</td>
                        <td>{{ $month }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }}
    </div>
</body>

</html>
