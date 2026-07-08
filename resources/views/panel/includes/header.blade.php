<style>
    .profile_info_custom {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 25px;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    
    .custom_avatar_wrapper {
        position: relative;
        flex-shrink: 0;
        transition: all 0.3s ease;
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
        transition: all 0.3s ease;
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

    
    body.nav-sm .profile_text_meta {
        display: none !important;
        opacity: 0;
        visibility: hidden;
    }
    
    body.nav-sm .profile_info_custom {
        padding: 15px 0 !important;
        justify-content: center !important;
        border-bottom: none !important;
    }
    
    body.nav-sm .custom_avatar {
        width: 40px !important;
        height: 40px !important;
        margin: 0 auto !important;
    }

    body.nav-sm .main_menu_side .menu_section h3,
    body.nav-sm .side-menu > li > a span,
    body.nav-sm .side-menu > li > a .fa-chevron-down {
        display: none !important;
        opacity: 0 !important;
    }

    body.nav-sm .side-menu > li > a {
        text-align: center !important;
        padding: 15px 0 !important;
        display: block !important;
    }

    body.nav-sm .side-menu > li > a i {
        font-size: 20px !important;
        width: 100% !important;
        margin: 0 !important;
    }
</style>

            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('assets/build/images/image.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name ?? 'Guest' }}</h2>
              </div>
            </div>

<div class="profile_container clearfix">
   <div class="profile profile_info_custom clearfix">

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
