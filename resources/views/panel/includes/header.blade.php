
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('assets/build/images/image.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
<<<<<<< HEAD
                <h2>{{ Auth::user()->name }}</h2>
=======
                <h2>{{ Auth::user()->name ?? 'Guest' }}</h2>
>>>>>>> 94b6e29863c11c24022e708633b5f8159caf365e
              </div>
            </div>
