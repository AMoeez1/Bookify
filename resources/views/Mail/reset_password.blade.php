<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content }}</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f7f9fc;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f7f9fc; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background-color: #ffffff; border-radius: 5px; overflow: hidden;">
                    <tr>
                        <td style="padding: 20px; text-align: center;">
                            <h1 style="font-size: 34px; color: #333; margin: 0;">Bookify<span
                                    style="font-size: 18px; color: #007bff; font-weight: 500;">Shelves</span></h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: left; color: #555;">
                            <p style="font-size: 16px; line-height: 1.5;">{{ $content }} .</p>
                            <a href="{{url('/forget/password/'. $token)}}"
                            style="background-color: #6c757d; text-decoration:none; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Change Password</a>
                            <p style="margin-top: 20px;">Thanks,<br><strong>Bookify Shelves</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
