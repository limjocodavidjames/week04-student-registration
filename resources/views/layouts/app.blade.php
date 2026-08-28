<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CIT Student Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a0533 0%, #0d1b4b 35%, #0a3d2e 70%, #1a0533 100%);
            background-attachment: fixed;
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139,92,246,0.2) 0%, transparent 70%);
            top: -150px; left: -150px;
            pointer-events: none; z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, transparent 70%);
            bottom: -200px; right: -200px;
            pointer-events: none; z-index: 0;
        }

        .orb-mid {
            position: fixed;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 70%);
            top: 40%; left: 55%;
            pointer-events: none; z-index: 0;
        }

        /* Nav */
        .top-nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 32px;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .nav-pill {
            font-size: 11px; color: rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px; padding: 4px 14px;
        }

        /* Glass card */
        .glass {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
        }
        .glass-dark {
            background: rgba(0,0,0,0.2);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
        }

        /* Stepper */
        .stepper-sidebar {
            width: 210px; flex-shrink: 0;
            position: sticky; top: 80px;
            align-self: flex-start;
        }
        .step-dot {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; flex-shrink: 0;
            transition: all 0.3s;
        }
        .dot-done { background: rgba(16,185,129,0.2); border: 1.5px solid rgba(16,185,129,0.5); color: #34d399; }
        .dot-active { background: rgba(139,92,246,0.35); border: 1.5px solid rgba(139,92,246,0.7); color: #c4b5fd; }
        .dot-idle { background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.25); }
        .step-line { width: 1px; height: 20px; margin-left: 13px; background: rgba(255,255,255,0.08); }

        /* Form inputs */
        .field-label {
            display: block;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.07em; text-transform: uppercase;
            color: rgba(255,255,255,0.38);
            margin-bottom: 6px;
        }
        .glass-input {
            width: 100%; height: 40px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            padding: 0 13px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: rgba(255,255,255,0.9);
            outline: none;
            transition: all 0.2s;
        }
        .glass-input::placeholder { color: rgba(255,255,255,0.2); }
        .glass-input:focus {
            border-color: rgba(139,92,246,0.6);
            background: rgba(139,92,246,0.1);
            box-shadow: 0 0 0 3px rgba(139,92,246,0.15);
        }
        .glass-input.has-error {
            border-color: rgba(239,68,68,0.6);
            background: rgba(239,68,68,0.08);
        }
        .glass-select {
            width: 100%; height: 40px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            padding: 0 13px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: rgba(255,255,255,0.9);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.3)' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            transition: all 0.2s;
            cursor: pointer;
        }
        .glass-select option { background: #1e1b4b; color: #fff; }
        .glass-select:focus {
            border-color: rgba(139,92,246,0.6);
            background-color: rgba(139,92,246,0.1);
            box-shadow: 0 0 0 3px rgba(139,92,246,0.15);
        }
        .glass-select.has-error { border-color: rgba(239,68,68,0.6); background-color: rgba(239,68,68,0.08); }
        .glass-textarea {
            width: 100%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            padding: 10px 13px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: rgba(255,255,255,0.9);
            outline: none; resize: none;
            transition: all 0.2s;
        }
        .glass-textarea::placeholder { color: rgba(255,255,255,0.2); }
        .glass-textarea:focus {
            border-color: rgba(139,92,246,0.6);
            background: rgba(139,92,246,0.1);
            box-shadow: 0 0 0 3px rgba(139,92,246,0.15);
        }
        .glass-textarea.has-error { border-color: rgba(239,68,68,0.6); }
        .field-error { font-size: 11px; color: #f87171; margin-top: 4px; }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #fff; border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-size: 14px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(124,58,237,0.4);
            transition: all 0.2s;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 24px rgba(124,58,237,0.5); }
        .btn-primary:active { transform: scale(0.98); }
        .btn-ghost {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 14px; font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.12); }

        /* Alerts */
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
            display: flex; gap: 12px;
            backdrop-filter: blur(10px);
        }
        .alert-success {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.3);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex; gap: 12px; align-items: center;
            backdrop-filter: blur(10px);
        }

        /* Section label */
        .section-label {
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.09em; text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin: 0 0 16px;
        }

        /* Badge */
        .badge-violet {
            display: inline-block;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.06em; text-transform: uppercase;
            padding: 4px 12px; border-radius: 20px;
            background: rgba(139,92,246,0.2);
            border: 1px solid rgba(139,92,246,0.35);
            color: #c4b5fd;
            margin-bottom: 10px;
        }
        .badge-green {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 700;
            padding: 5px 12px; border-radius: 20px;
            background: rgba(16,185,129,0.15);
            border: 1px solid rgba(16,185,129,0.35);
            color: #34d399;
        }

        /* Profile page */
        .profile-banner {
            height: 170px;
            background: linear-gradient(135deg, rgba(124,58,237,0.6), rgba(79,70,229,0.5), rgba(16,185,129,0.3));
            border-radius: 18px 18px 0 0;
            position: relative;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .profile-avatar {
            width: 90px; height: 90px;
            border-radius: 14px;
            border: 3px solid rgba(255,255,255,0.2);
            object-fit: cover;
            position: absolute;
            bottom: -45px; left: 28px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .detail-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 13px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-key { color: rgba(255,255,255,0.38); font-size: 12px; }
        .detail-val { color: rgba(255,255,255,0.9); font-weight: 500; font-size: 13px; }
    </style>
    @stack('styles')
</head>
<body>
<div class="orb-mid"></div>

<nav class="top-nav">
    <div style="display:flex;align-items:center;gap:12px;position:relative;z-index:1;">
        <div class="nav-logo">CIT</div>
        <div>
            <p style="font-size:13px;font-weight:600;color:rgba(255,255,255,0.9);margin:0;line-height:1.3;">College of Information Technology</p>
            <p style="font-size:10px;color:rgba(255,255,255,0.35);margin:0;">Student Enrollment Portal</p>
        </div>
    </div>
    <div class="nav-pill">AY 2025–2026</div>
</nav>

<div style="max-width:980px;margin:0 auto;padding:36px 24px;position:relative;z-index:1;">
    @yield('content')
</div>

<footer style="position:relative;z-index:1;text-align:center;padding:28px;font-size:11px;color:rgba(255,255,255,0.2);border-top:1px solid rgba(255,255,255,0.05);margin-top:40px;">
    © {{ date('Y') }} College of Information Technology &nbsp;·&nbsp; Student Registration System
</footer>

@stack('scripts')
</body>
</html>