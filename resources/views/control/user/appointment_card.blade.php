<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body
    style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; background-color:rgb(227, 220, 211)">
    <div style="border: grey 2px solid; padding:2rem; position:absolute; left:5%; width:80%; margin-top:20px; height:90%;">
        @
        <h2>Digital Care,</h2>
        <h3>Wishing you sound health and a wonderful life ahead.</h3>
        <div style="border-radius:5px; border:rgb(2, 116, 222) 3px solid; padding:5px">
            Dear '{{$getRA->name}}',
            We are pleased to provide you with your doctor referral document. Please ensure that you bring this document
            with you on the appointed date and time.

            Your health is our priority, and we want to ensure that your visit is as smooth and efficient as possible.
            This referral serves as an important communication tool between our medical team and the specialist you'll
            be seeing.

            If you have any questions or concerns, please don't hesitate to contact our office. We're here to assist you
            every step of the way.

            Thank you for entrusting us with your care. We look forward to seeing you on [{{\Carbon\Carbon::parse($getRA->preferred_date)->format('D-m-Y')}}] at [{{\Carbon\Carbon::parse($getAA->slotTime)->format('H:i')}}]
        </div>
        <div style="border-radius:5px; border:rgb(16, 5, 98) 3px solid; padding:5px; margin-top:10px;">
            <h3>Best regards,</h3>
            <h4>{{$getDoctor->name}},</h4>
            <h4>{{ now()->format('D-m-Y') }},</h4>
            <h4>@DigitalCare</h4>
        </div>
        <div style="border-radius:5px; border:rgb(19, 87, 36) 3px solid; padding:1px; margin-top:4px;">
            <h5>Comments</h5>
            <hr>
            <pre>


            </pre>
        </div>
    </div>
</body>

</html>
