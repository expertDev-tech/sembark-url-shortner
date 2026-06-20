<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invitation</title>
</head>
<body>

    <h2>Invitation to Join</h2>

    <p>
        You have been invited as
        <strong>{{ $invitation->role }}</strong>.
    </p>

    <p>
        Click the link below to accept the invitation:
    </p>

    <p>
        <a href="{{ route('invitations.accept', $invitation->token) }}">
            Accept Invitation
        </a>
    </p>

    <p>
        This invitation expires on:
        {{ $invitation->expires_at->format('d M Y H:i') }}
    </p>

</body>
</html>