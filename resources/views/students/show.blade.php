@extends('layouts.app')
@section('title', 'Student Profile')
@section('content')

<style>
@keyframes slideDown { from{opacity:0;transform:translateY(-12px);}to{opacity:1;transform:translateY(0);} }
@keyframes fadeUp { from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);} }
.fade-up { animation: fadeUp 0.5s ease forwards; }
.flash-bar { animation: slideDown 0.4s ease forwards; }
</style>

{{-- Flash Message --}}
@if(session('success'))
<div class="flash-bar" style="
    background: rgba(16,185,129,0.12);
    border: 1px solid rgba(16,185,129,0.3);
    border-radius: 14px;
    padding: 14px 20px;
    margin-bottom: 28px;
    display: flex; align-items: center; gap: 14px;
    backdrop-filter: blur(12px);
">
    <div style="width:38px;height:38px;border-radius:50%;background:rgba(16,185,129,0.18);border:1.5px solid rgba(16,185,129,0.35);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div>
        <p style="font-size:15px;font-weight:700;color:#34d399;margin:0 0 1px;">Student registered successfully!</p>
        <p style="font-size:12px;color:rgba(52,211,153,0.55);margin:0;">The enrollment record has been saved to the database.</p>
    </div>
    <div style="margin-left:auto;font-size:11px;color:rgba(52,211,153,0.4);">{{ now()->format('h:i A') }}</div>
</div>
@endif

<div style="margin-bottom:22px;display:flex;align-items:center;justify-content:space-between;">
    <a href="{{ route('students.create') }}"
        style="font-size:13px;color:rgba(255,255,255,0.38);text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;"
        onmouseover="this.style.color='rgba(255,255,255,0.8)'"
        onmouseout="this.style.color='rgba(255,255,255,0.38)'">
        ← Register another student
    </a>
    <span style="font-size:11px;color:rgba(255,255,255,0.2);background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:4px 12px;">
        Record #{{ str_pad($student->id, 6, '0', STR_PAD_LEFT) }}
    </span>
</div>

{{-- Main layout --}}
<div class="fade-up" style="display:grid;grid-template-columns:320px 1fr;gap:20px;align-items:start;">

    {{-- LEFT PROFILE CARD --}}
    <div style="background:rgba(255,255,255,0.06);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border:1px solid rgba(255,255,255,0.12);border-radius:22px;overflow:hidden;">

        {{-- Banner --}}
        <div style="height:150px;background:linear-gradient(135deg,#3b0764 0%,#6d28d9 40%,#2563eb 75%,#0d9488 100%);position:relative;overflow:hidden;">
            <div style="position:absolute;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.07);top:-60px;right:-40px;"></div>
            <div style="position:absolute;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,0.05);bottom:-30px;left:60px;"></div>
            <div style="position:absolute;width:50px;height:50px;border-radius:50%;background:rgba(255,255,255,0.08);top:20px;left:20px;"></div>
        </div>

        {{-- Avatar --}}
        <div style="position:relative;margin-top:-55px;padding:0 24px;">
            <div style="width:110px;height:110px;border-radius:18px;border:3.5px solid rgba(15,15,40,0.8);overflow:hidden;box-shadow:0 12px 40px rgba(0,0,0,0.6);background:#1a1040;">
                <img src="{{ asset('storage/' . $student->profile_picture) }}"
                    alt="{{ $student->first_name }}"
                    style="width:100%;height:100%;object-fit:cover;display:block;">
            </div>
        </div>

        {{-- Name & Info --}}
        <div style="padding:14px 24px 26px;">
            <h1 style="font-size:20px;font-weight:700;color:#fff;margin:0 0 3px;line-height:1.3;">
                {{ $student->first_name }}
                @if($student->middle_name) {{ $student->middle_name }} @endif
                {{ $student->last_name }}
            </h1>
            <p style="font-size:13px;color:#a78bfa;font-weight:600;margin:0 0 14px;letter-spacing:0.03em;">
                {{ $student->student_id }}
            </p>

            <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(16,185,129,0.14);border:1px solid rgba(16,185,129,0.28);border-radius:20px;padding:5px 13px;">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                <span style="font-size:11px;font-weight:700;color:#34d399;letter-spacing:0.04em;">Enrolled</span>
            </span>

            <div style="margin:20px 0 0;border-top:1px solid rgba(255,255,255,0.07);padding-top:16px;display:flex;flex-direction:column;gap:0;">
                @foreach([
                    ['Program', $student->program],
                    ['Year level', $student->year_level],
                    ['Gender', $student->gender],
                    ['Date of birth', \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y')],
                ] as [$k, $v])
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                    <span style="font-size:12px;color:rgba(255,255,255,0.32);">{{ $k }}</span>
                    <span style="font-size:13px;font-weight:600;color:rgba(255,255,255,0.9);">{{ $v }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- RIGHT CARDS --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Contact --}}
        <div style="background:rgba(255,255,255,0.06);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border:1px solid rgba(255,255,255,0.12);border-radius:22px;padding:24px 28px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                <div style="width:28px;height:28px;border-radius:8px;background:rgba(139,92,246,0.2);border:1px solid rgba(139,92,246,0.3);display:flex;align-items:center;justify-content:center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.7A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.05a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 15z"/></svg>
                </div>
                <p style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin:0;">Contact information</p>
            </div>
            @foreach([
                ['Email address', $student->email, '#a78bfa'],
                ['Mobile number', $student->mobile_number, 'rgba(255,255,255,0.88)'],
                ['Home address', $student->address, 'rgba(255,255,255,0.88)'],
            ] as [$label, $value, $color])
            <div style="display:flex;justify-content:space-between;align-items:{{ strlen($value) > 35 ? 'flex-start' : 'center' }};padding:11px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                <span style="font-size:12px;color:rgba(255,255,255,0.32);flex-shrink:0;padding-right:16px;">{{ $label }}</span>
                <span style="font-size:13px;font-weight:500;color:{{ $color }};text-align:right;">{{ $value }}</span>
            </div>
            @endforeach
        </div>

        {{-- Registration Details --}}
        <div style="background:rgba(255,255,255,0.06);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border:1px solid rgba(255,255,255,0.12);border-radius:22px;padding:24px 28px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                <div style="width:28px;height:28px;border-radius:8px;background:rgba(59,130,246,0.2);border:1px solid rgba(59,130,246,0.3);display:flex;align-items:center;justify-content:center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <p style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin:0;">Registration details</p>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:11px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                <span style="font-size:12px;color:rgba(255,255,255,0.32);">Registered on</span>
                <span style="font-size:13px;font-weight:500;color:rgba(255,255,255,0.88);">{{ $student->created_at->format('F d, Y · h:i A') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:11px 0;">
                <span style="font-size:12px;color:rgba(255,255,255,0.32);">Record ID</span>
                <span style="font-size:15px;font-weight:700;color:#a78bfa;">#{{ str_pad($student->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        {{-- CTA --}}
        <div style="background:linear-gradient(135deg,rgba(109,40,217,0.25),rgba(79,70,229,0.2));border:1px solid rgba(139,92,246,0.22);border-radius:22px;padding:20px 28px;display:flex;align-items:center;justify-content:space-between;gap:16px;">
            <div>
                <p style="font-size:15px;font-weight:700;color:rgba(255,255,255,0.88);margin:0 0 3px;">Register another student?</p>
                <p style="font-size:12px;color:rgba(255,255,255,0.32);margin:0;">Return to the enrollment form to add a new record.</p>
            </div>
            <a href="{{ route('students.create') }}"
                style="display:inline-block;background:linear-gradient(135deg,#7c3aed,#4f46e5);color:#fff;text-decoration:none;border-radius:11px;padding:11px 22px;font-size:13px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;box-shadow:0 4px 20px rgba(124,58,237,0.45);white-space:nowrap;transition:all 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 28px rgba(124,58,237,0.55)'"
                onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(124,58,237,0.45)'">
                New registration →
            </a>
        </div>

    </div>
</div>

@endsection