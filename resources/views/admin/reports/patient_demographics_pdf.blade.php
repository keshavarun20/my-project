<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Demographics Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            max-width: 800px; /* Limit width for better readability */
            margin: 0 auto; /* Center align */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd; /* Bottom border for separation */
        }
        .logo {
            width: 100px; /* Adjust size as needed */
            height: auto;
            margin-right: 20px; /* Space between logo and clinic info */
        }
        .clinic-info {
            flex: 1; /* Take remaining space */
        }
        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333; /* Darker color for clinic name */
        }
        .clinic-address {
            font-size: 14px;
            color: #666; /* Lighter color for address */
            margin-bottom: 5px;
        }
        .clinic-contact {
            font-size: 14px;
            color: #666; /* Lighter color for contact info */
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .report-info {
            text-align: center;
            font-size: 18px;
            color: #666; /* Slightly darker color for report info */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff; /* White background for table */
        }
        table, th, td {
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
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/icons/new-icons/logo.png'))) }}" class="logo" alt="Logo" />
        <div class="clinic-info">
            <div class="clinic-name">Hatton Consultation Centre</div>
            <div class="clinic-address">No.271, Colombo Road, Dimbulla Rd, Hatton</div>
            <div class="clinic-contact">Phone: 0512 223 218</div>
        </div>
    </div>

    <h1>Patient Demographics Report</h1>
    <p class="report-info">{{ $month }}/{{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->mobile_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }}
    </div>
</body>
</html>
