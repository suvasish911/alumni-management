<style>
    .profile_container {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 25px;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        margin-bottom: 10px;
    }
    .custom_avatar_wrapper {
        position: relative;
        flex-shrink: 0;
    }
    .custom_avatar {
        width: 46px !important;
        height: 46px !important;
        border-radius: 50% !important;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.15);
    }
    .profile_text_meta {
        display: flex;
        flex-direction: column;
    }
    .profile_text_meta span {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    .profile_text_meta h2 {
        font-size: 0.95rem !important;
        color: #e2e8f0 !important;
        font-weight: 600 !important;
        margin: 2px 0 0 0 !important;
        line-height: 1.2;
    }
</style>

<div class="profile_container clearfix">
    <div class="custom_avatar_wrapper">
        @if(Auth::check() && Auth::user()->profile_image)
            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="custom_avatar">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=475569&color=fff" alt="Default Avatar" class="custom_avatar">
        @endif
    </div>
    <div class="profile_text_meta">
        <span>Welcome,</span>
        <h2>{{ Auth::user()->name ?? 'Guest' }}</h2>
    </div>
</div>