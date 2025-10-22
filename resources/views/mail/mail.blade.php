<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Ticket Has Been Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f9fc; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 10px; padding: 25px;">
        <h2 style="color: #2563eb;">🎫 Support Ticket Created</h2>

        <p>Hi {{ $ticket->client->name ?? 'Customer' }},</p>

        <p>Thank you for submitting your ticket. Here are your ticket details:</p>

        <ul>
            <li><strong>Ticket ID:</strong> {{ $ticket->ticket_id }}</li>
            <li><strong>Title:</strong> {{ $ticket->title }}</li>
            <li><strong>Category:</strong> {{ $ticket->category }}</li>
            <li><strong>Status:</strong> {{ ucfirst($ticket->status) }}</li>
        </ul>

        <p>You can track your ticket anytime using the link below:</p>

        <p>
            <a href="{{ $track_link }}"
               style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px;">
               Track Ticket
            </a>
        </p>

        <p style="font-size: 14px; color: gray;">Or copy this link:</p>
        <p style="word-break: break-all; color: #2563eb;">{{ $track_link }}</p>

        <p style="margin-top: 30px;">Best regards,<br><strong>Pemaju Digital</strong></p>
        <p style="font-size: 12px; color: gray; text-align: center;">This is an automated message. Please do not reply.</p>
    </div>
</body>
</html>
