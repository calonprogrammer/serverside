<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        #container{
            margin: 0 auto;
            background-color: #27ad27;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #content{
            margin: 0 auto;
            position: relative;
            width: 50%;
            background-color: white;
            box-shadow:
                    0 1px 1px rgba(0,0,0,0.15),
                    0 10px 0 -5px #eee,
                    0 10px 1px -4px rgba(0,0,0,0.15),
                    0 20px 0 -10px #eee,
                    0 20px 1px -9px rgba(0,0,0,0.15);
        }
        h1{
            text-align: center;
        }
        h4{
            text-align: center;
        }
        #content table{
            margin: 30px auto;
            background-color: whitesmoke;

        }
        #name{
            text-align: right;
        }
        #logo{
            position: absolute;
            right: 0;
        }
        #logo img{
            width: 150px;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="content">
        <div id="logo">
            <img src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg">
        </div>
        <h1>Invoice Premium Transaction</h1>
        <span id='name'><i>Dear Mr(s). {{$data['user_name']}}</i></span>
        <h4>Detail Transaction</h4>
        <table>
            <tr>
                <td>Premium Name</td>
                <td>: {{$data['name']}}</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>: {{$data['duration']}} day(s)</td>
            </tr>
            <tr>
                <td>Valid Date</td>
                <td>: {{$data['start_date']}} - {{$data['end_date']}}</td>
            </tr>
        </table>
        <h1><i>Thank you</i></h1>
    </div>
</div>
</body>
</html>