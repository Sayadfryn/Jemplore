<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tourism Report - {{ date('d M Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #47b6c2;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #47b6c2;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .stat-box h3 {
            margin: 0;
            font-size: 24px;
            color: #47b6c2;
        }
        .stat-box p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #47b6c2;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        .rating {
            color: #fbbf24;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>JEMPLORE - Tourism Report</h1>
        <p>System Report Generated on {{ $stats['generated_at'] }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>{{ $stats['total_tourism'] }}</h3>
            <p>Total Tourism Objects</p>
        </div>
        <div class="stat-box">
            <h3>{{ $stats['total_reviews'] }}</h3>
            <p>Total Ulasan</p>
        </div>
        <div class="stat-box">
            <h3>{{ $stats['avg_rating'] }}</h3>
            <p>Average Rating</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Wisata</th>
                <th style="width: 20%;">Contact Person</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 10%;">Culinary</th>
                <th style="width: 10%;">Rating</th>
                <th style="width: 10%;">Reviews</th>

            </tr>
        </thead>
        <tbody>
            @foreach($tourismObjects as $index => $tourism)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $tourism->name }}</strong></td>
                    <td>{{ $tourism->user->name ?? 'N/A' }}</td>
                    <td>{{ $tourism->user->email ?? 'N/A' }}</td>
                    <td>{{ $tourism->culinaries->count() }}</td>
                    
                    <td class="rating">{{ number_format($tourism->global_rating, 2) }}</td>
                    <td>{{ $tourism->global_review_count }}</td>
                    </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Jemplore - Jember Tourism System. All rights reserved.</p>
        <p>Generated automatically by system on {{ now()->format('d M Y H:i:s') }}</p>
    </div>
</body>
</html>
