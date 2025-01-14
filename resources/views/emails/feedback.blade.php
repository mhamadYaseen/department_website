<!DOCTYPE html>
<html>
<head>
    <title>Feedback Email</title>
</head>
<body>
    <div>
        <h2>Feedback from {{ $feedbackData['name'] }}</h2>
        <p><strong>Email:</strong> {{ $feedbackData['email'] }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $feedbackData['message'] }}</p>
    </div>
</body>
</html>