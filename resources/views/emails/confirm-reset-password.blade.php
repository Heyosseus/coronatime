<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="background-color: #f6f6f6; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5em; margin: 0; padding: 0;">

<div style="background-color: #ffffff; margin: 40px auto; max-width: 600px; padding: 20px;">
    <img src="https://i.ibb.co/VwfBMMd/Landing.png" alt="Landing" style="border:0; display:flex; align-items:center; justify-content: center; margin: auto">
    <h1 style="color: #444444; font-size: 24px; font-weight: bold; margin-bottom: 20px; display:flex; align-items:center; justify-content: center; margin-top: 8px;">Confirmation Email</h1>

    <p style="color: #444444; margin-bottom: 20px; text-align: center">click this button to verify your email</p>
    <div style="display:flex; align-items:center; justify-content: center;">
        <a href="{{ route('new_password', $token)}}" style="background-color: #0FBA68; border: none; color: #ffffff; display: inline-block;
    font-size: 16px; margin-bottom: 20px; padding: 12px 20px; text-align: center; text-decoration: none; width: 200px;
    text-transform: uppercase; border-radius: 8px; font-weight:bold; width: 343px;
    ">Verify Email</a>
    </div>

</div>
</body>
</html>
