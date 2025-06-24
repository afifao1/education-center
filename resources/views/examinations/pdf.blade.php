<!DOCTYPE html>
<html>
<head>
    <title>Examinations PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Examinations</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Exam Date</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examinations as $exam)
                <tr>
                    <td>{{ $exam->id }}</td>
                    <td>{{ $exam->student->first_name ?? '—' }}</td>
                    <td>{{ $exam->subject }}</td>
                    <td>{{ $exam->exam_date }}</td>
                    <td>{{ $exam->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
