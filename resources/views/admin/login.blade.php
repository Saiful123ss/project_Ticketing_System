<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d1117;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 380px;
        }

        .login-card h4 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        input.form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            transform: scale(1.03);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .toggle-password:hover {
            color: #000;
        }

        .footer-text {
            text-align: center;
            margin-top: 1rem;
            color: #666;
            font-size: 0.85rem;
        }

        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
        }
        #stars {
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 483px 450px #FFF , 1995px 525px #FFF , 755px 1459px #FFF , 610px 1246px #FFF , 764px 1850px #FFF , 1274px 1697px #FFF , 1227px 37px #FFF , 1090px 506px #FFF , 341px 1005px #FFF , 1002px 755px #FFF , 693px 1497px #FFF , 1797px 1626px #FFF , 1838px 793px #FFF , 802px 881px #FFF , 1117px 1983px #FFF , 352px 1465px #FFF , 1526px 852px #FFF , 1559px 526px #FFF , 517px 516px #FFF , 1380px 244px #FFF , 662px 1531px #FFF , 1544px 518px #FFF , 253px 879px #FFF , 774px 1629px #FFF , 752px 994px #FFF , 1129px 726px #FFF , 232px 1050px #FFF , 1766px 290px #FFF , 1976px 842px #FFF , 662px 1535px #FFF , 257px 1016px #FFF , 665px 708px #FFF , 1476px 1772px #FFF , 261px 498px #FFF , 719px 1459px #FFF , 469px 438px #FFF , 994px 474px #FFF , 744px 808px #FFF , 1609px 1741px #FFF , 898px 260px #FFF , 1978px 1436px #FFF , 904px 1244px #FFF , 123px 773px #FFF , 6px 923px #FFF , 1973px 1778px #FFF , 1470px 1861px #FFF , 1037px 156px #FFF , 554px 1905px #FFF , 1508px 849px #FFF , 1213px 1603px #FFF , 87px 1907px #FFF , 492px 527px #FFF , 91px 213px #FFF , 492px 15px #FFF , 1357px 1157px #FFF , 637px 240px #FFF , 1515px 281px #FFF , 1757px 682px #FFF , 1035px 1298px #FFF , 1019px 1233px #FFF , 25px 162px #FFF , 262px 884px #FFF , 1328px 965px #FFF , 984px 879px #FFF , 1213px 689px #FFF , 623px 1091px #FFF , 1227px 422px #FFF , 1977px 1025px #FFF , 620px 474px #FFF , 528px 1525px #FFF;
  animation: animStar 50s linear infinite;
}
#stars:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 483px 450px #FFF , 1995px 525px #FFF , 755px 1459px #FFF , 610px 1246px #FFF , 764px 1850px #FFF , 1274px 1697px #FFF , 1227px 37px #FFF , 1090px 506px #FFF , 341px 1005px #FFF , 1002px 755px #FFF , 693px 1497px #FFF , 1797px 1626px #FFF , 1838px 793px #FFF , 802px 881px #FFF , 1117px 1983px #FFF , 352px 1465px #FFF , 1526px 852px #FFF , 1559px 526px #FFF , 517px 516px #FFF , 1380px 244px #FFF , 662px 1531px #FFF , 1544px 518px #FFF , 253px 879px #FFF , 774px 1629px #FFF , 752px 994px #FFF , 1129px 726px #FFF , 232px 1050px #FFF , 1766px 290px #FFF , 1976px 842px #FFF , 662px 1535px #FFF , 257px 1016px #FFF , 665px 708px #FFF , 1476px 1772px #FFF , 261px 498px #FFF , 719px 1459px #FFF , 469px 438px #FFF , 994px 474px #FFF , 744px 808px #FFF , 1609px 1741px #FFF , 898px 260px #FFF , 1978px 1436px #FFF , 904px 1244px #FFF , 123px 773px #FFF , 6px 923px #FFF , 1973px 1778px #FFF , 1470px 1861px #FFF , 1037px 156px #FFF , 554px 1905px #FFF , 1508px 849px #FFF , 1213px 1603px #FFF , 87px 1907px #FFF , 492px 527px #FFF , 91px 213px #FFF , 492px 15px #FFF , 1357px 1157px #FFF , 637px 240px #FFF , 1515px 281px #FFF , 1757px 682px #FFF , 1035px 1298px #FFF , 1019px 1233px #FFF , 25px 162px #FFF , 262px 884px #FFF , 1328px 965px #FFF , 984px 879px #FFF , 1213px 689px #FFF , 623px 1091px #FFF , 1227px 422px #FFF , 1977px 1025px #FFF , 620px 474px #FFF , 528px 1525px #FFF;
}

#stars2 {
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 1585px 315px #FFF , 1750px 858px #FFF , 502px 1184px #FFF , 1482px 150px #FFF , 870px 93px #FFF , 1401px 1976px #FFF , 494px 1549px #FFF , 1607px 1894px #FFF , 1029px 1466px #FFF , 1931px 1390px #FFF , 819px 1431px #FFF , 521px 1062px #FFF , 1754px 574px #FFF , 577px 943px #FFF , 850px 1377px #FFF , 445px 1835px #FFF , 1658px 1675px #FFF , 521px 1144px #FFF , 560px 1624px #FFF , 1329px 1778px #FFF;
  animation: animStar 100s linear infinite;
}
#stars2:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 1585px 315px #FFF , 1750px 858px #FFF , 502px 1184px #FFF , 1482px 150px #FFF , 870px 93px #FFF , 1401px 1976px #FFF , 494px 1549px #FFF , 1607px 1894px #FFF , 1029px 1466px #FFF , 1931px 1390px #FFF , 819px 1431px #FFF , 521px 1062px #FFF , 1754px 574px #FFF , 577px 943px #FFF , 850px 1377px #FFF , 445px 1835px #FFF , 1658px 1675px #FFF , 521px 1144px #FFF , 560px 1624px #FFF , 1329px 1778px #FFF;
}

#stars3 {
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 91px 409px #FFF , 1886px 728px #FFF , 1294px 970px #FFF , 720px 1215px #FFF , 796px 1431px #FFF , 834px 1217px #FFF , 1926px 1164px #FFF , 1803px 310px #FFF , 1532px 1421px #FFF , 1680px 232px #FFF;
  animation: animStar 150s linear infinite;
}
#stars3:after {
  content: " ";
  position: absolute;
  top: 2000px;
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 91px 409px #FFF , 1886px 728px #FFF , 1294px 970px #FFF , 720px 1215px #FFF , 796px 1431px #FFF , 834px 1217px #FFF , 1926px 1164px #FFF , 1803px 310px #FFF , 1532px 1421px #FFF , 1680px 232px #FFF;
}
@keyframes animStar {
  from {
    transform: translateY(0px);
  }
  to {
    transform: translateY(-2000px);
  }
}

    </style>
</head>
<body>
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>

    <div class="login-card">
        <h4>Admin Login</h4>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3 password-wrapper">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
        @endif

        <div class="footer-text mt-3">
            &copy; {{ date('Y') }} Ticket System Reo
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", () => {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            togglePassword.classList.toggle("bi-eye");
            togglePassword.classList.toggle("bi-eye-slash");
        });
    </script>
</body>
</html>
