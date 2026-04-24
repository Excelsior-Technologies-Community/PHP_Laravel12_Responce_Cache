<!DOCTYPE html>
<html>

<head>
    <title>Cache Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
        }

        .card {
            width: 520px;
            padding: 35px;
            border-radius: 20px;

            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);

            color: white;
            text-align: center;

            position: relative;
            overflow: hidden;
        }

        .icon {
            font-size: 55px;
            margin-bottom: 10px;
            animation: float 2s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        p {
            font-size: 13px;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .success {
            background: rgba(0, 255, 120, 0.15);
            border: 1px solid rgba(0, 255, 120, 0.4);
            color: #7CFF9B;
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        /* STATS GRID */
        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 20px 0;
        }

        .box {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 14px;
            border-radius: 14px;
            font-size: 13px;
            transition: 0.3s;
        }

        .box:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.15);
        }

        .value {
            font-size: 20px;
            font-weight: bold;
            margin-top: 6px;
            color: #00ffcc;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 14px;

            background: linear-gradient(135deg, #ff512f, #dd2476);
            color: white;

            text-decoration: none;
            font-weight: bold;

            box-shadow: 0 10px 30px rgba(221, 36, 118, 0.4);
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .footer {
            margin-top: 18px;
            font-size: 11px;
            opacity: 0.7;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #00ff9d;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0.2;
            }
        }
    </style>
</head>

<body>

    <div class="card">

        <div class="icon">⚡</div>

        <h2>Cache Control Center</h2>
        <p><span class="dot"></span>Live Laravel Performance Dashboard</p>

        {{-- SUCCESS --}}
        @if(session()->has('success'))
            <div class="success" id="msg">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    document.getElementById('msg').style.display = 'none';
                }, 3000);
            </script>
        @endif

        {{-- STATS --}}
        <div class="stats">

            <div class="box">
                📦 Cache Files
                <div class="value">{{ $cacheFiles }}</div>
            </div>

            <div class="box">
                ⚡ Cache Status
                <div class="value">ACTIVE</div>
            </div>

            <div class="box">
                🧠 Laravel
                <div class="value">{{ $laravel }}</div>
            </div>

            <div class="box">
                🐘 PHP
                <div class="value">{{ $php }}</div>
            </div>

        </div>

        <a href="/cache-clear" class="btn">Clear Cache</a>

        <div class="footer">
            Laravel Response Cache • Live System Dashboard
        </div>

    </div>

</body>

</html>