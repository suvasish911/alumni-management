<div class="profile clearfix">
    <div class="profile_pic">
        @if(Auth::check() && Auth::user()->profile_image)
            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="img-circle profile_img object-cover" style="width: 56px; height: 56px;">
        @else
            <img src="{{ asset('assets/build/images/image.jpg') }}" alt="Default Avatar" class="img-circle profile_img">
        @endif
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ Auth::user()->name ?? 'Guest' }}</h2>
    </div>
</div>