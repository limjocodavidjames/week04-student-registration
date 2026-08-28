@extends('layouts.app')
@section('title', 'Student Registration')
@section('content')

@if($errors->any())
<div class="alert-error">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="2" style="flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <div>
        <p style="font-size:13px;font-weight:600;color:#f87171;margin:0 0 4px;">Fix the following before submitting:</p>
        <ul style="margin:0;padding-left:16px;">
            @foreach($errors->all() as $e)
                <li style="font-size:12px;color:#fca5a5;margin-bottom:2px;">{{ $e }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div style="display:flex;gap:22px;align-items:flex-start;">

    {{-- Stepper --}}
    <div class="stepper-sidebar">
        <div class="glass" style="padding:20px;">
            <p style="font-size:10px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin:0 0 16px;">Enrollment steps</p>

            <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                <div class="step-dot dot-active">1</div>
                <div>
                    <p style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.85);margin:0;">Academic</p>
                    <p style="font-size:10px;color:rgba(255,255,255,0.3);margin:0;">ID and program</p>
                </div>
            </div>
            <div class="step-line"></div>
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                <div class="step-dot dot-idle">2</div>
                <div>
                    <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Personal</p>
                    <p style="font-size:10px;color:rgba(255,255,255,0.2);margin:0;">Name and birth</p>
                </div>
            </div>
            <div class="step-line"></div>
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                <div class="step-dot dot-idle">3</div>
                <div>
                    <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Contact</p>
                    <p style="font-size:10px;color:rgba(255,255,255,0.2);margin:0;">Email and address</p>
                </div>
            </div>
            <div class="step-line"></div>
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="step-dot dot-idle">4</div>
                <div>
                    <p style="font-size:12px;color:rgba(255,255,255,0.4);margin:0;">Photo</p>
                    <p style="font-size:10px;color:rgba(255,255,255,0.2);margin:0;">Profile image</p>
                </div>
            </div>

            <div style="margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.06);">
                <div style="height:5px;background:rgba(255,255,255,0.08);border-radius:4px;">
                    <div style="height:5px;background:linear-gradient(90deg,#7c3aed,#4f46e5);border-radius:4px;transition:width 0.4s;" id="progress-bar" style="width:0%"></div>
                </div>
                <p style="font-size:10px;color:rgba(255,255,255,0.25);margin:6px 0 0;" id="progress-text">0% complete</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div style="flex:1;min-width:0;">
        <div style="margin-bottom:24px;">
            <span class="badge-violet">New enrollment</span>
            <h1 style="font-size:30px;font-weight:700;color:#fff;line-height:1.2;margin:0 0 6px;">Student Registration</h1>
            <p style="font-size:13px;color:rgba(255,255,255,0.4);margin:0;">Complete all sections to create your enrollment record.</p>
        </div>

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" id="reg-form">
            @csrf

            {{-- Academic --}}
            <div class="glass" style="padding:22px;margin-bottom:14px;">
                <p class="section-label">Academic information</p>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;">
                    <div>
                        <label class="field-label">Student ID <span style="color:#f87171;">*</span></label>
                        <input type="text" name="student_id" value="{{ old('student_id') }}" placeholder="2024-00001"
                            class="glass-input {{ $errors->has('student_id') ? 'has-error' : '' }}">
                        @error('student_id')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label">Program <span style="color:#f87171;">*</span></label>
                        <select name="program" class="glass-select {{ $errors->has('program') ? 'has-error' : '' }}">
                            <option value="">Select program</option>
                            @foreach(['BSIT','BSCS','BSIS','BSCE','BSCpE','BSEE','BSME','BSECE'] as $p)
                                <option value="{{ $p }}" {{ old('program') == $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        </select>
                        @error('program')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label">Year level <span style="color:#f87171;">*</span></label>
                        <select name="year_level" class="glass-select {{ $errors->has('year_level') ? 'has-error' : '' }}">
                            <option value="">Select year</option>
                            @foreach(['1st Year','2nd Year','3rd Year','4th Year'] as $y)
                                <option value="{{ $y }}" {{ old('year_level') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        @error('year_level')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Personal --}}
            <div class="glass" style="padding:22px;margin-bottom:14px;">
                <p class="section-label">Personal information</p>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:14px;">
                    <div>
                        <label class="field-label">First name <span style="color:#f87171;">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Juan"
                            class="glass-input {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label">Middle name <span style="color:rgba(255,255,255,0.2);font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Santos" class="glass-input">
                    </div>
                    <div>
                        <label class="field-label">Last name <span style="color:#f87171;">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Dela Cruz"
                            class="glass-input {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="field-label">Date of birth <span style="color:#f87171;">*</span></label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="glass-input {{ $errors->has('date_of_birth') ? 'has-error' : '' }}"
                            style="color-scheme:dark;">
                        @error('date_of_birth')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label">Gender <span style="color:#f87171;">*</span></label>
                        <select name="gender" class="glass-select {{ $errors->has('gender') ? 'has-error' : '' }}">
                            <option value="">Select gender</option>
                            @foreach(['Male','Female','Non-binary','Prefer not to say'] as $g)
                                <option value="{{ $g }}" {{ old('gender') == $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('gender')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Contact --}}
            <div class="glass" style="padding:22px;margin-bottom:14px;">
                <p class="section-label">Contact information</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                    <div>
                        <label class="field-label">Email address <span style="color:#f87171;">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="juan@email.com"
                            class="glass-input {{ $errors->has('email') ? 'has-error' : '' }}">
                        @error('email')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="field-label">Mobile number <span style="color:#f87171;">*</span></label>
                        <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="09XXXXXXXXX"
                            class="glass-input {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
                        @error('mobile_number')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="field-label">Home address <span style="color:#f87171;">*</span></label>
                    <textarea name="address" rows="2" placeholder="Street, Barangay, City, Province"
                        class="glass-textarea {{ $errors->has('address') ? 'has-error' : '' }}">{{ old('address') }}</textarea>
                    @error('address')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Photo --}}
            <div class="glass" style="padding:22px;margin-bottom:16px;">
                <p class="section-label">Profile photo</p>
                <div style="display:flex;gap:14px;align-items:center;">
                    <div id="preview-wrap" style="width:70px;height:70px;border-radius:12px;border:2px dashed rgba(255,255,255,0.15);overflow:hidden;display:flex;align-items:center;justify-content:center;background:rgba(139,92,246,0.1);flex-shrink:0;transition:border-color 0.2s;">
                        <img id="img-preview" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
                        <svg id="img-placeholder" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(167,139,250,0.6)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div style="flex:1;">
                        <label for="profile_picture" style="cursor:pointer;display:block;">
                            <div id="upload-zone" style="border:1.5px dashed rgba(255,255,255,0.15);border-radius:12px;padding:16px;text-align:center;background:rgba(255,255,255,0.04);transition:all 0.2s;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.35)" stroke-width="1.5" style="display:block;margin:0 auto 6px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <p style="font-size:13px;color:rgba(255,255,255,0.55);font-weight:500;margin:0 0 2px;">Click to upload photo</p>
                                <p style="font-size:11px;color:rgba(255,255,255,0.25);margin:0;">JPG, JPEG or PNG · Max 2MB</p>
                            </div>
                        </label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display:none;" onchange="previewImage(event)">
                        @error('profile_picture')<p class="field-error" style="margin-top:6px;">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <p style="font-size:12px;color:rgba(255,255,255,0.25);margin:0;"><span style="color:#f87171;">*</span> Required fields</p>
                <button type="submit" class="btn-primary">Register student →</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('img-preview');
        const placeholder = document.getElementById('img-placeholder');
        const wrap = document.getElementById('preview-wrap');
        img.src = e.target.result;
        img.style.display = 'block';
        placeholder.style.display = 'none';
        wrap.style.borderColor = 'rgba(139,92,246,0.6)';
        wrap.style.borderStyle = 'solid';
        document.getElementById('upload-zone').style.borderColor = 'rgba(139,92,246,0.4)';
        document.getElementById('upload-zone').style.background = 'rgba(139,92,246,0.08)';
    };
    reader.readAsDataURL(file);
}

const tracked = ['student_id','program','year_level','first_name','last_name','date_of_birth','gender','email','mobile_number','address'];
const bar = document.getElementById('progress-bar');
const label = document.getElementById('progress-text');

function updateProgress() {
    let filled = 0;
    tracked.forEach(name => {
        const el = document.querySelector(`[name="${name}"]`);
        if (el && el.value.trim()) filled++;
    });
    const pct = Math.round((filled / tracked.length) * 100);
    bar.style.width = pct + '%';
    label.textContent = pct + '% complete';
}

document.querySelectorAll('.glass-input, .glass-select, .glass-textarea').forEach(el => {
    el.addEventListener('input', updateProgress);
    el.addEventListener('change', updateProgress);
});

const uploadZone = document.getElementById('upload-zone');
uploadZone.addEventListener('mouseover', () => {
    uploadZone.style.borderColor = 'rgba(139,92,246,0.4)';
    uploadZone.style.background = 'rgba(139,92,246,0.08)';
});
uploadZone.addEventListener('mouseout', () => {
    if (!document.getElementById('img-preview').style.display || document.getElementById('img-preview').style.display === 'none') {
        uploadZone.style.borderColor = 'rgba(255,255,255,0.15)';
        uploadZone.style.background = 'rgba(255,255,255,0.04)';
    }
});

updateProgress();
</script>
@endpush