<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Accepted</title>
</head>
<body>

    <h2>Congratulations {{ $student_name }}</h2>

    <p>
        Your application <strong>{{ $application_id }}</strong> 
        for the programme <strong>{{ $programme }}</strong> 
        (Intake: {{ $intake }}) has been <strong>ACCEPTED</strong>.
    </p>

    <p>
        We are excited to have you join us. Please check your email regularly for further instructions.
    </p>

    <p>
        <a href="{{ config('app.url') }}/applications/{{ $application_id }}">
            View Application
        </a>
    </p>

    <p>
        Thanks,<br>
        {{ config('app.name') }}
    </p>

</body>
</html>
