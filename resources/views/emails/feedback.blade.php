<!DOCTYPE html>
<html>
<head>
    <title>Feedback Email</title>
</head>
<body>
    <div>
        <h2>Feedback from {{ $name }}</h2>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $messageContent }}</p>
    </div>
</body>
</html>